<?php
namespace Modules\Partner\Filament\Resources\ListingResource\Pages;

use App\Support\QuickListingCategorySuggester;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Collection;
use Modules\Category\Models\Category;
use Modules\Partner\Filament\Resources\ListingResource;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class QuickCreateListing extends Page
{
    use WithFileUploads;

    protected static string $resource = ListingResource::class;
    protected string $view = 'filament.partner.listings.quick-create';
    protected static ?string $title = 'Hızlı İlan Ver';
    protected static ?string $slug = 'quick-create';
    protected static bool $shouldRegisterNavigation = false;

    /**
     * @var array<int, TemporaryUploadedFile>
     */
    public array $photos = [];

    /**
     * @var array<int, array{id: int, name: string, parent_id: int|null, icon: string|null, has_children: bool}>
     */
    public array $categories = [];

    public int $currentStep = 1;
    public string $categorySearch = '';
    public ?int $selectedCategoryId = null;
    public ?int $activeParentCategoryId = null;
    public ?int $detectedCategoryId = null;
    public ?float $detectedConfidence = null;
    public ?string $detectedReason = null;
    public ?string $detectedError = null;

    /**
     * @var array<int>
     */
    public array $detectedAlternatives = [];

    public bool $isDetecting = false;

    public function mount(): void
    {
        $this->loadCategories();
    }

    public function updatedPhotos(): void
    {
        $this->validatePhotos();
    }

    public function removePhoto(int $index): void
    {
        if (! isset($this->photos[$index])) {
            return;
        }

        unset($this->photos[$index]);
        $this->photos = array_values($this->photos);
    }

    public function goToCategoryStep(): void
    {
        $this->validatePhotos();
        $this->currentStep = 2;

        if (! $this->isDetecting && ! $this->detectedCategoryId) {
            $this->detectCategoryFromImage();
        }
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
    }

    public function continueToManualCreate()
    {
        if (! $this->selectedCategoryId) {
            return null;
        }

        $url = ListingResource::getUrl(
            name: 'create',
            parameters: [
                'category_id' => $this->selectedCategoryId,
                'quick' => 1,
            ],
            shouldGuessMissingParameters: true,
        );

        return redirect()->to($url);
    }

    /**
     * @return array<int, array{id: int, name: string, parent_id: int|null, icon: string|null, has_children: bool}>
     */
    public function getRootCategoriesProperty(): array
    {
        return collect($this->categories)
            ->whereNull('parent_id')
            ->values()
            ->all();
    }

    /**
     * @return array<int, array{id: int, name: string, parent_id: int|null, icon: string|null, has_children: bool}>
     */
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
            return 'Kategori Seçimi';
        }

        $category = collect($this->categories)
            ->firstWhere('id', $this->activeParentCategoryId);

        return (string) ($category['name'] ?? 'Kategori Seçimi');
    }

    public function getSelectedCategoryNameProperty(): ?string
    {
        if (! $this->selectedCategoryId) {
            return null;
        }

        $category = collect($this->categories)
            ->firstWhere('id', $this->selectedCategoryId);

        return $category['name'] ?? null;
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

    private function categoryExists(int $categoryId): bool
    {
        return collect($this->categories)
            ->contains(fn (array $category): bool => $category['id'] === $categoryId);
    }
}
