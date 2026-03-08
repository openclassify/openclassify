<?php

namespace App\Livewire;

use App\Support\QuickListingCategorySuggester;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\Listing\Models\ListingCustomField;
use Modules\Listing\Support\ListingCustomFieldSchemaBuilder;
use Modules\Listing\Support\ListingPanelHelper;
use Modules\Location\Models\City;
use Modules\Location\Models\Country;
use Modules\S3\Support\MediaStorage;
use Modules\User\App\Models\Profile;
use Modules\Video\Models\Video;
use Throwable;

class PanelQuickListingForm extends Component
{
    use WithFileUploads;

    private const TOTAL_STEPS = 5;

    public array $photos = [];
    public array $videos = [];
    public array $categories = [];
    public array $countries = [];
    public array $cities = [];
    public array $listingCustomFields = [];
    public array $customFieldValues = [];

    public int $currentStep = 1;
    public string $categorySearch = '';
    public ?int $selectedCategoryId = null;
    public ?int $activeParentCategoryId = null;

    public ?int $detectedCategoryId = null;
    public ?float $detectedConfidence = null;
    public ?string $detectedReason = null;
    public ?string $detectedError = null;
    public array $detectedAlternatives = [];
    public bool $isDetecting = false;

    public string $listingTitle = '';
    public string $price = '';
    public string $description = '';
    public ?int $selectedCountryId = null;
    public ?int $selectedCityId = null;
    public bool $isPublishing = false;

    public function mount(): void
    {
        $this->loadCategories();
        $this->loadLocations();
        $this->hydrateLocationDefaultsFromProfile();
    }

    public function render()
    {
        return view('panel.quick-create');
    }

    public function updatedPhotos(): void
    {
        $this->validatePhotos();
    }

    public function updatedVideos(): void
    {
        $this->validateVideos();
    }

    public function updatedSelectedCountryId(): void
    {
        $this->selectedCityId = null;
    }

    public function removePhoto(int $index): void
    {
        if (! isset($this->photos[$index])) {
            return;
        }

        unset($this->photos[$index]);
        $this->photos = array_values($this->photos);
    }

    public function removeVideo(int $index): void
    {
        if (! isset($this->videos[$index])) {
            return;
        }

        unset($this->videos[$index]);
        $this->videos = array_values($this->videos);
    }

    public function goToStep(int $step): void
    {
        $this->currentStep = max(1, min(self::TOTAL_STEPS, $step));
    }

    public function goToCategoryStep(): void
    {
        $this->validatePhotos();
        $this->validateVideos();
        $this->currentStep = 2;

        if (! $this->isDetecting && ! $this->detectedCategoryId) {
            $this->detectCategoryFromImage();
        }
    }

    public function goToDetailsStep(): void
    {
        $this->validateCategoryStep();
        $this->currentStep = 3;
    }

    public function goToFeaturesStep(): void
    {
        $this->validateCategoryStep();
        $this->validateDetailsStep();
        $this->currentStep = 4;
    }

    public function goToPreviewStep(): void
    {
        $this->validateCategoryStep();
        $this->validateDetailsStep();
        $this->validateCustomFieldsStep();
        $this->currentStep = 5;
    }

    public function detectCategoryFromImage(): void
    {
        if ($this->photos === []) {
            return;
        }

        $this->isDetecting = true;
        $this->detectedError = null;
        $this->detectedReason = null;
        $this->detectedAlternatives = [];

        $result = app(QuickListingCategorySuggester::class)->suggestFromImage($this->photos[0]);

        $this->isDetecting = false;
        $this->detectedCategoryId = $result['category_id'];
        $this->detectedConfidence = $result['confidence'];
        $this->detectedReason = $result['reason'];
        $this->detectedError = $result['error'];
        $this->detectedAlternatives = $result['alternatives'];

        if ($this->detectedCategoryId) {
            $this->selectCategory($this->detectedCategoryId);
        }
    }

    public function enterCategory(int $categoryId): void
    {
        if (! $this->categoryExists($categoryId)) {
            return;
        }

        $this->activeParentCategoryId = $categoryId;
        $this->categorySearch = '';
    }

    public function backToRootCategories(): void
    {
        $this->activeParentCategoryId = null;
        $this->categorySearch = '';
    }

    public function selectCategory(int $categoryId): void
    {
        if (! $this->categoryExists($categoryId)) {
            return;
        }

        $this->selectedCategoryId = $categoryId;
        $this->loadListingCustomFields();
    }

    public function publishListing(): void
    {
        if ($this->isPublishing) {
            return;
        }

        $this->isPublishing = true;

        $this->validatePhotos();
        $this->validateVideos();
        $this->validateCategoryStep();
        $this->validateDetailsStep();
        $this->validateCustomFieldsStep();

        try {
            $listing = $this->createListing();
        } catch (Throwable $exception) {
            report($exception);
            $this->isPublishing = false;
            session()->flash('error', 'The listing could not be created. Please try again.');

            return;
        }

        $this->isPublishing = false;
        session()->flash('success', 'Your listing has been created successfully.');

        if (Route::has('panel.listings.edit')) {
            $this->redirect(route('panel.listings.edit', $listing), navigate: true);

            return;
        }

        $this->redirectRoute('panel.listings.index');
    }

    public function getRootCategoriesProperty(): array
    {
        return collect($this->categories)
            ->whereNull('parent_id')
            ->values()
            ->all();
    }

    public function getCurrentCategoriesProperty(): array
    {
        if (! $this->activeParentCategoryId) {
            return [];
        }

        $search = trim((string) $this->categorySearch);
        $all = collect($this->categories);
        $parent = $all->firstWhere('id', $this->activeParentCategoryId);
        $children = $all->where('parent_id', $this->activeParentCategoryId)->values();

        $combined = collect();

        if (is_array($parent)) {
            $combined->push($parent);
        }

        $combined = $combined->concat($children);

        return $combined
            ->when(
                $search !== '',
                fn (Collection $categories): Collection => $categories->filter(
                    fn (array $category): bool => str_contains(
                        mb_strtolower($category['name']),
                        mb_strtolower($search)
                    )
                )
            )
            ->values()
            ->all();
    }

    public function getCurrentParentNameProperty(): string
    {
        if (! $this->activeParentCategoryId) {
            return 'Category Selection';
        }

        $category = collect($this->categories)->firstWhere('id', $this->activeParentCategoryId);

        return (string) ($category['name'] ?? 'Category Selection');
    }

    public function getCurrentStepTitleProperty(): string
    {
        return match ($this->currentStep) {
            1 => 'Photos',
            2 => 'Category',
            3 => 'Basics',
            4 => 'Details',
            5 => 'Review',
            default => 'New Listing',
        };
    }

    public function getCurrentStepHintProperty(): string
    {
        return match ($this->currentStep) {
            1 => 'Add photos and optional videos first.',
            2 => 'Pick the right category.',
            3 => 'Add the basics.',
            4 => 'Add extra details if needed.',
            5 => 'Check everything before publishing.',
            default => 'Create a new listing.',
        };
    }

    public function getSelectedCategoryNameProperty(): ?string
    {
        if (! $this->selectedCategoryId) {
            return null;
        }

        $category = collect($this->categories)->firstWhere('id', $this->selectedCategoryId);

        return $category['name'] ?? null;
    }

    public function getSelectedCategoryPathProperty(): string
    {
        if (! $this->selectedCategoryId) {
            return '';
        }

        return implode(' › ', $this->categoryPathParts($this->selectedCategoryId));
    }

    public function getDetectedAlternativeNamesProperty(): array
    {
        if ($this->detectedAlternatives === []) {
            return [];
        }

        $categoriesById = collect($this->categories)->keyBy('id');

        return collect($this->detectedAlternatives)
            ->map(fn (int $id): ?string => $categoriesById[$id]['name'] ?? null)
            ->filter()
            ->values()
            ->all();
    }

    public function getAvailableCitiesProperty(): array
    {
        if (! $this->selectedCountryId) {
            return [];
        }

        return collect($this->cities)
            ->where('country_id', $this->selectedCountryId)
            ->values()
            ->all();
    }

    public function getSelectedCountryNameProperty(): ?string
    {
        if (! $this->selectedCountryId) {
            return null;
        }

        $country = collect($this->countries)->firstWhere('id', $this->selectedCountryId);

        return $country['name'] ?? null;
    }

    public function getSelectedCityNameProperty(): ?string
    {
        if (! $this->selectedCityId) {
            return null;
        }

        $city = collect($this->cities)->firstWhere('id', $this->selectedCityId);

        return $city['name'] ?? null;
    }

    public function getPreviewCustomFieldsProperty(): array
    {
        return ListingCustomFieldSchemaBuilder::presentableValues(
            $this->selectedCategoryId,
            $this->sanitizedCustomFieldValues(),
        );
    }

    public function getTitleCharactersProperty(): int
    {
        return mb_strlen($this->listingTitle);
    }

    public function getDescriptionCharactersProperty(): int
    {
        return mb_strlen($this->description);
    }

    public function getCurrentUserNameProperty(): string
    {
        return (string) (auth()->user()?->name ?: 'User');
    }

    public function getCurrentUserInitialProperty(): string
    {
        return Str::upper(Str::substr($this->currentUserName, 0, 1));
    }

    public function categoryIconComponent(?string $icon): string
    {
        return match ($icon) {
            'car' => 'heroicon-o-truck',
            'laptop', 'computer' => 'heroicon-o-computer-desktop',
            'shirt' => 'heroicon-o-swatch',
            'home', 'sofa' => 'heroicon-o-home-modern',
            'briefcase' => 'heroicon-o-briefcase',
            'wrench' => 'heroicon-o-wrench-screwdriver',
            'football' => 'heroicon-o-trophy',
            'phone', 'mobile' => 'heroicon-o-device-phone-mobile',
            default => 'heroicon-o-tag',
        };
    }

    private function validatePhotos(): void
    {
        $this->validate([
            'photos' => [
                'required',
                'array',
                'min:1',
                'max:'.config('quick-listing.max_photo_count', 20),
            ],
            'photos.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png',
                'max:'.config('quick-listing.max_photo_size_kb', 5120),
            ],
        ]);
    }

    private function validateVideos(): void
    {
        $this->validate([
            'videos' => [
                'nullable',
                'array',
                'max:'.config('video.max_listing_videos', 5),
            ],
            'videos.*' => [
                'required',
                'file',
                'mimetypes:video/mp4,video/quicktime,video/webm,video/x-matroska,video/x-msvideo',
                'max:'.config('video.max_upload_size_kb', 102400),
            ],
        ]);
    }

    private function validateCategoryStep(): void
    {
        $this->validate([
            'selectedCategoryId' => [
                'required',
                'integer',
                Rule::in(collect($this->categories)->pluck('id')->all()),
            ],
        ], [
            'selectedCategoryId.required' => 'Please choose a category.',
            'selectedCategoryId.in' => 'Please choose a valid category.',
        ]);
    }

    private function validateDetailsStep(): void
    {
        $this->validate([
            'listingTitle' => ['required', 'string', 'max:70'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string', 'max:1450'],
            'selectedCountryId' => ['required', 'integer', Rule::in(collect($this->countries)->pluck('id')->all())],
            'selectedCityId' => [
                'nullable',
                'integer',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if (is_null($value) || $value === '') {
                        return;
                    }

                    $cityExists = collect($this->availableCities)
                        ->contains(fn (array $city): bool => $city['id'] === (int) $value);

                    if (! $cityExists) {
                        $fail('The selected city does not belong to the chosen country.');
                    }
                },
            ],
        ], [
            'listingTitle.required' => 'A title is required.',
            'listingTitle.max' => 'The title may not exceed 70 characters.',
            'price.required' => 'A price is required.',
            'price.numeric' => 'The price must be numeric.',
            'description.required' => 'A description is required.',
            'description.max' => 'The description may not exceed 1450 characters.',
            'selectedCountryId.required' => 'Please choose a country.',
        ]);
    }

    private function validateCustomFieldsStep(): void
    {
        $rules = [];

        foreach ($this->listingCustomFields as $field) {
            $fieldRules = [];
            $name = $field['name'];
            $statePath = "customFieldValues.{$name}";
            $type = $field['type'];
            $isRequired = (bool) $field['is_required'];

            if ($type === ListingCustomField::TYPE_BOOLEAN) {
                $fieldRules[] = 'nullable';
                $fieldRules[] = 'boolean';
            } else {
                $fieldRules[] = $isRequired ? 'required' : 'nullable';
            }

            $fieldRules = [
                ...$fieldRules,
                ...$this->customFieldTypeRules($type),
            ];

            if ($type === ListingCustomField::TYPE_SELECT) {
                $options = collect($field['options'] ?? [])->map(fn ($option): string => (string) $option)->all();
                $fieldRules[] = Rule::in($options);
            }

            $rules[$statePath] = $fieldRules;
        }

        if ($rules !== []) {
            $this->validate($rules);
        }
    }

    private function customFieldTypeRules(string $type): array
    {
        return match ($type) {
            ListingCustomField::TYPE_TEXT => ['string', 'max:255'],
            ListingCustomField::TYPE_TEXTAREA => ['string', 'max:2000'],
            ListingCustomField::TYPE_NUMBER => ['numeric'],
            ListingCustomField::TYPE_DATE => ['date'],
            default => ['sometimes'],
        };
    }

    private function createListing(): Listing
    {
        $user = auth()->user();

        if (! $user) {
            abort(403);
        }

        $profilePhone = Profile::query()
            ->where('user_id', $user->getKey())
            ->value('phone');

        $payload = [
            'title' => trim($this->listingTitle),
            'description' => trim($this->description),
            'price' => (float) $this->price,
            'currency' => ListingPanelHelper::defaultCurrency(),
            'category_id' => $this->selectedCategoryId,
            'status' => 'pending',
            'custom_fields' => $this->sanitizedCustomFieldValues(),
            'contact_email' => (string) $user->email,
            'contact_phone' => $profilePhone,
            'country' => $this->selectedCountryName,
            'city' => $this->selectedCityName,
        ];

        $listing = Listing::createFromFrontend($payload, $user->getKey());
        $mediaDisk = $this->frontendMediaDisk();

        foreach ($this->photos as $photo) {
            if (! $photo instanceof TemporaryUploadedFile) {
                continue;
            }

            $listing
                ->addMedia($photo->getRealPath())
                ->usingFileName($photo->getClientOriginalName())
                ->toMediaCollection('listing-images', $mediaDisk);
        }

        foreach ($this->videos as $index => $video) {
            if (! $video instanceof TemporaryUploadedFile) {
                continue;
            }

            Video::createFromTemporaryUpload($listing, $video, [
                'disk' => $mediaDisk,
                'sort_order' => $index + 1,
                'title' => pathinfo($video->getClientOriginalName(), PATHINFO_FILENAME),
            ]);
        }

        return $listing;
    }

    private function sanitizedCustomFieldValues(): array
    {
        $fieldsByName = collect($this->listingCustomFields)->keyBy('name');

        return collect($this->customFieldValues)
            ->filter(fn ($value, $key): bool => $fieldsByName->has((string) $key))
            ->map(function ($value, $key) use ($fieldsByName): mixed {
                $field = $fieldsByName->get((string) $key);
                $type = (string) ($field['type'] ?? ListingCustomField::TYPE_TEXT);

                return match ($type) {
                    ListingCustomField::TYPE_NUMBER => is_numeric($value) ? (float) $value : null,
                    ListingCustomField::TYPE_BOOLEAN => (bool) $value,
                    default => is_string($value) ? trim($value) : $value,
                };
            })
            ->filter(function ($value, $key) use ($fieldsByName): bool {
                $field = $fieldsByName->get((string) $key);
                $type = (string) ($field['type'] ?? ListingCustomField::TYPE_TEXT);

                if ($type === ListingCustomField::TYPE_BOOLEAN) {
                    return true;
                }

                return ! is_null($value) && $value !== '';
            })
            ->all();
    }

    private function loadCategories(): void
    {
        $all = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name', 'parent_id', 'icon']);

        $childrenCount = Category::query()
            ->where('is_active', true)
            ->selectRaw('parent_id, count(*) as aggregate')
            ->whereNotNull('parent_id')
            ->groupBy('parent_id')
            ->pluck('aggregate', 'parent_id');

        $this->categories = $all
            ->map(fn (Category $category): array => [
                'id' => (int) $category->id,
                'name' => (string) $category->name,
                'parent_id' => $category->parent_id ? (int) $category->parent_id : null,
                'icon' => $category->icon,
                'has_children' => ((int) ($childrenCount[$category->id] ?? 0)) > 0,
            ])
            ->values()
            ->all();
    }

    private function loadLocations(): void
    {
        $this->countries = Country::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name'])
            ->map(fn (Country $country): array => [
                'id' => (int) $country->id,
                'name' => (string) $country->name,
            ])
            ->all();

        $this->cities = City::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'country_id'])
            ->map(fn (City $city): array => [
                'id' => (int) $city->id,
                'name' => (string) $city->name,
                'country_id' => (int) $city->country_id,
            ])
            ->all();
    }

    private function loadListingCustomFields(): void
    {
        $this->listingCustomFields = ListingCustomField::query()
            ->active()
            ->forCategory($this->selectedCategoryId)
            ->ordered()
            ->get(['name', 'label', 'type', 'is_required', 'placeholder', 'help_text', 'options'])
            ->map(fn (ListingCustomField $field): array => [
                'name' => (string) $field->name,
                'label' => (string) $field->label,
                'type' => (string) $field->type,
                'is_required' => (bool) $field->is_required,
                'placeholder' => $field->placeholder,
                'help_text' => $field->help_text,
                'options' => collect($field->options ?? [])
                    ->map(fn ($option): string => (string) $option)
                    ->values()
                    ->all(),
            ])
            ->all();

        $allowed = collect($this->listingCustomFields)->pluck('name')->all();
        $this->customFieldValues = collect($this->customFieldValues)->only($allowed)->all();

        foreach ($this->listingCustomFields as $field) {
            if ($field['type'] === ListingCustomField::TYPE_BOOLEAN && ! array_key_exists($field['name'], $this->customFieldValues)) {
                $this->customFieldValues[$field['name']] = false;
            }
        }
    }

    private function hydrateLocationDefaultsFromProfile(): void
    {
        $user = auth()->user();

        if (! $user) {
            return;
        }

        $profile = Profile::query()->where('user_id', $user->getKey())->first();

        if (! $profile) {
            return;
        }

        $profileCountry = trim((string) ($profile->country ?? ''));
        $profileCity = trim((string) ($profile->city ?? ''));

        if ($profileCountry !== '') {
            $country = collect($this->countries)->first(fn (array $country): bool => mb_strtolower($country['name']) === mb_strtolower($profileCountry));

            if (is_array($country)) {
                $this->selectedCountryId = $country['id'];
            }
        }

        if ($profileCity !== '' && $this->selectedCountryId) {
            $city = collect($this->availableCities)->first(fn (array $city): bool => mb_strtolower($city['name']) === mb_strtolower($profileCity));

            if (is_array($city)) {
                $this->selectedCityId = $city['id'];
            }
        }
    }

    private function categoryExists(int $categoryId): bool
    {
        return collect($this->categories)->contains(fn (array $category): bool => $category['id'] === $categoryId);
    }

    private function frontendMediaDisk(): string
    {
        return (string) config('media_storage.local_disk', MediaStorage::diskFromDriver(MediaStorage::DRIVER_LOCAL));
    }

    private function categoryPathParts(int $categoryId): array
    {
        $byId = collect($this->categories)->keyBy('id');
        $parts = [];
        $currentId = $categoryId;

        while ($currentId && $byId->has($currentId)) {
            $category = $byId->get($currentId);

            if (! is_array($category)) {
                break;
            }

            $parts[] = (string) $category['name'];
            $currentId = $category['parent_id'] ?? null;
        }

        return array_reverse($parts);
    }
}
