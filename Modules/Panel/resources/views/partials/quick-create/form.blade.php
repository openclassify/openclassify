@php
    $maxPhotoCount = (int) config('quick-listing.max_photo_count', 20);
    $visiblePhotoSlotCount = min($maxPhotoCount, 8);
    $maxVideoCount = (int) config('video.max_listing_videos', 5);
    $currency = \Modules\Listing\Support\ListingPanelHelper::defaultCurrency();
    $displayPrice = is_numeric($price) ? number_format((float) $price, 0, ',', '.') : $price;
@endphp

<div class="mx-auto w-full max-w-[920px] px-4 py-6 sm:py-10">
    <div class="qc-shell">
        <div class="qc-header">
            <span class="qc-step-chip">Step {{ $currentStep }} of 5</span>
            <h1 class="qc-title">{{ $this->currentStepTitle }}</h1>
            <div class="qc-progress" aria-hidden="true">
                @for ($step = 1; $step <= 5; $step++)
                    <span @class(['is-on' => $step <= $currentStep])></span>
                @endfor
            </div>
        </div>

        <div class="qc-card">
            @if ($publishError)
                <div class="px-4 pt-4">
                    <div class="rounded-[18px] border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700">
                        {{ $publishError }}
                    </div>
                </div>
            @endif

            @if ($currentStep === 1)
                <div class="qc-body">
                    <div class="qc-stack">
                        <label class="qc-upload-zone" for="quick-listing-photo-input">
                            <span class="qc-upload-icon">
                                <x-heroicon-o-photo class="h-7 w-7" />
                            </span>
                            <div class="qc-upload-title">Add photos</div>
                            <p class="qc-copy">1 to {{ $maxPhotoCount }} photos.</p>
                            <span class="qc-primary-pill">Select photos</span>
                        </label>

                        <input
                            id="quick-listing-photo-input"
                            type="file"
                            wire:model="photos"
                            accept="image/jpeg,image/jpg,image/png"
                            multiple
                            class="hidden"
                        >

                        @error('photos')
                            <div class="qc-error">{{ $message }}</div>
                        @enderror

                        @error('photos.*')
                            <div class="qc-error">{{ $message }}</div>
                        @enderror

                        @if (count($photos) > 0)
                            <div class="qc-panel">
                                <div class="qc-panel-head">
                                    <div>
                                        <h2>Your photos</h2>
                                    </div>
                                    <span class="qc-count">{{ count($photos) }}/{{ $maxPhotoCount }}</span>
                                </div>

                                <div class="qc-photo-grid">
                                    @for ($index = 0; $index < $visiblePhotoSlotCount; $index++)
                                        <div class="qc-photo-slot">
                                            @if (isset($photos[$index]))
                                                <img src="{{ $photos[$index]->temporaryUrl() }}" alt="Uploaded photo {{ $index + 1 }}">
                                                <button type="button" class="qc-remove" wire:click="removePhoto({{ $index }})">×</button>
                                                @if ($index === 0)
                                                    <div class="qc-cover">Cover</div>
                                                @endif
                                            @else
                                                <x-heroicon-o-photo class="h-8 w-8 text-slate-400" />
                                            @endif
                                        </div>
                                    @endfor
                                </div>

                                @if (count($photos) > $visiblePhotoSlotCount)
                                    <p class="qc-meta-copy mt-3">{{ count($photos) - $visiblePhotoSlotCount }} more photos added.</p>
                                @endif
                            </div>
                        @else
                            <div class="qc-empty">Add one cover photo to continue.</div>
                        @endif

                        <div class="qc-panel">
                            <div class="qc-panel-row">
                                <h2>Video</h2>
                                <label for="quick-listing-video-input" class="qc-secondary-pill cursor-pointer">
                                    Add video
                                </label>
                            </div>

                            <input
                                id="quick-listing-video-input"
                                type="file"
                                wire:model="videos"
                                accept="video/mp4,video/quicktime,video/webm,video/x-matroska,video/x-msvideo"
                                multiple
                                class="hidden"
                                data-video-upload-optimizer="{{ config('video.client_side.enabled', true) ? 'true' : 'false' }}"
                                data-video-optimize-width="{{ config('video.client_side.max_width', 854) }}"
                                data-video-optimize-bitrate="{{ config('video.client_side.bitrate', 900000) }}"
                                data-video-optimize-fps="{{ config('video.client_side.fps', 24) }}"
                                data-video-optimize-min-bytes="{{ config('video.client_side.min_size_bytes', 1048576) }}"
                            />

                            @error('videos')
                                <div class="qc-error">{{ $message }}</div>
                            @enderror

                            @error('videos.*')
                                <div class="qc-error">{{ $message }}</div>
                            @enderror

                            @if (count($videos) > 0)
                                <div class="qc-video-list">
                                    @foreach ($videos as $index => $video)
                                        @php
                                            $videoName = method_exists($video, 'getClientOriginalName') ? $video->getClientOriginalName() : 'Video '.($index + 1);
                                            $videoSize = method_exists($video, 'getSize') ? (int) $video->getSize() : 0;
                                        @endphp
                                        <div class="qc-video-item">
                                            <div class="qc-video-meta">
                                                <div class="qc-video-name">{{ $videoName }}</div>
                                                <div class="qc-video-size">{{ $videoSize > 0 ? number_format($videoSize / 1048576, 1, ',', '.') : '-' }} MB</div>
                                            </div>
                                            <button type="button" class="qc-icon-button h-11 w-11 p-0" wire:click="removeVideo({{ $index }})">×</button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="qc-footer is-single">
                    <button
                        type="button"
                        class="qc-button"
                        wire:click="goToCategoryStep"
                        @disabled(count($photos) === 0 || $isDetecting)
                    >
                        Next
                    </button>
                </div>
            @endif

            @if ($currentStep === 2)
                <div class="qc-body">
                    <div class="qc-stack">
                        @if ($isDetecting)
                            <div class="qc-notice">Finding the best category...</div>
                        @elseif ($detectedCategoryId)
                            <div class="qc-notice">Suggested: <strong>{{ $this->selectedCategoryName }}</strong></div>
                        @elseif ($detectedError)
                            <div class="qc-notice">{{ $detectedError }}</div>
                        @endif

                        @if ($detectedAlternatives !== [])
                            <div class="qc-chip-row">
                                @foreach ($detectedAlternatives as $alternativeId)
                                    @php
                                        $alternativeCategory = collect($categories)->firstWhere('id', $alternativeId);
                                    @endphp
                                    @if ($alternativeCategory)
                                        <button type="button" class="qc-chip" wire:click="selectCategory({{ $alternativeId }})">
                                            {{ $alternativeCategory['name'] }}
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        @if (is_null($activeParentCategoryId))
                            <div class="qc-panel">
                                <div class="qc-panel-head">
                                    <div>
                                        <h2>Choose a category</h2>
                                    </div>
                                    <button type="button" class="qc-text-link" wire:click="detectCategoryFromImage" @disabled($isDetecting || count($photos) === 0)>
                                        Try again
                                    </button>
                                </div>

                                <div class="qc-category-grid">
                                    @foreach ($this->rootCategories as $category)
                                        <button
                                            type="button"
                                            class="qc-category-card {{ $selectedCategoryId === $category['id'] ? 'is-selected' : '' }}"
                                            wire:click="enterCategory({{ $category['id'] }})"
                                        >
                                            <span class="qc-category-icon">
                                                <x-dynamic-component :component="$this->categoryIconComponent($category['icon'])" class="h-8 w-8" />
                                            </span>
                                            <div class="qc-category-name">{{ $category['name'] }}</div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="qc-panel">
                                <div class="qc-panel-head">
                                    <button type="button" class="qc-back-link" wire:click="backToRootCategories">Back</button>
                                    <div class="text-center">
                                        <h2>{{ $this->currentParentName }}</h2>
                                    </div>
                                    <span class="qc-count">Pick</span>
                                </div>

                                <div class="qc-search-wrap">
                                    <input type="text" class="qc-input" placeholder="Search categories" wire:model.live.debounce.300ms="categorySearch">

                                    <div class="qc-category-list">
                                        @forelse ($this->currentCategories as $category)
                                            <div class="qc-category-row">
                                                <button
                                                    type="button"
                                                    class="qc-category-main {{ $selectedCategoryId === $category['id'] ? 'is-selected' : '' }}"
                                                    wire:click="selectCategory({{ $category['id'] }})"
                                                >
                                                    {{ $category['name'] }}
                                                </button>

                                                @if ($category['has_children'] && $category['id'] !== $activeParentCategoryId)
                                                    <button type="button" class="qc-category-next" wire:click="enterCategory({{ $category['id'] }})">
                                                        <x-heroicon-o-chevron-right class="h-5 w-5" />
                                                    </button>
                                                @else
                                                    <span></span>
                                                @endif

                                                <span class="qc-category-check">
                                                    @if ($selectedCategoryId === $category['id'])
                                                        <x-heroicon-o-check-circle class="h-5 w-5" />
                                                    @endif
                                                </span>
                                            </div>
                                        @empty
                                            <div class="qc-empty">No categories found.</div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($errors->has('selectedCategoryId'))
                            <div class="qc-error">{{ $errors->first('selectedCategoryId') }}</div>
                        @endif

                        @if ($this->selectedCategoryName)
                            <div class="qc-summary-card">
                                <div>
                                    <span class="qc-summary-label">Selected</span>
                                    <span class="qc-summary-value">{{ $this->selectedCategoryName }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="qc-footer">
                    <button type="button" class="qc-button-secondary" wire:click="goToStep(1)">Back</button>
                    <button
                        type="button"
                        class="qc-button"
                        wire:click="goToDetailsStep"
                        @disabled(! $selectedCategoryId)
                    >
                        Next
                    </button>
                </div>
            @endif

            @if ($currentStep === 3)
                <div class="qc-body">
                    <div class="qc-stack">
                        <div class="qc-photo-strip">
                            @foreach (array_slice($photos, 0, 4) as $index => $photo)
                                <div class="qc-photo-slot">
                                    <img src="{{ $photo->temporaryUrl() }}" alt="Selected photo {{ $index + 1 }}">
                                    <button type="button" class="qc-remove" wire:click="removePhoto({{ $index }})">×</button>
                                    @if ($index === 0)
                                        <div class="qc-cover">Cover</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="qc-summary-card">
                            <div>
                                <span class="qc-summary-label">Category</span>
                                <span class="qc-summary-value">{{ $this->selectedCategoryPath ?: '-' }}</span>
                            </div>
                            <button type="button" class="qc-text-link" wire:click="goToStep(2)">Change</button>
                        </div>

                        <div class="qc-fields">
                            <div class="qc-field">
                                <label for="quick-title">Title</label>
                                <input id="quick-title" type="text" class="qc-input" placeholder="Listing title" wire:model.live.debounce.300ms="listingTitle" maxlength="70">
                                <div class="qc-counter">{{ $this->titleCharacters }}/70</div>
                                @error('listingTitle')<div class="qc-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="qc-fields two-col">
                                <div class="qc-field">
                                    <label for="quick-price">Price</label>
                                    <div class="qc-input-row">
                                        <input id="quick-price" type="number" step="0.01" class="qc-input" placeholder="Price" wire:model.live.debounce.300ms="price">
                                        <span class="qc-input-suffix">{{ $currency }}</span>
                                    </div>
                                    @error('price')<div class="qc-error">{{ $message }}</div>@enderror
                                </div>

                                <div class="qc-field">
                                    <label>Location</label>
                                    <div class="qc-fields two-col">
                                        <div>
                                            <select class="qc-select" wire:model.live="selectedCountryId">
                                                <option value="">Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('selectedCountryId')<div class="qc-error">{{ $message }}</div>@enderror
                                        </div>
                                        <div>
                                            <select class="qc-select" wire:model.live="selectedCityId" @disabled(! $selectedCountryId)>
                                                <option value="">City</option>
                                                @foreach ($this->availableCities as $city)
                                                    <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('selectedCityId')<div class="qc-error">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="qc-field">
                                <label for="quick-description">Description</label>
                                <textarea id="quick-description" class="qc-textarea" placeholder="Describe the item" wire:model.live.debounce.300ms="description" maxlength="1450"></textarea>
                                <div class="qc-counter">{{ $this->descriptionCharacters }}/1450</div>
                                @error('description')<div class="qc-error">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="qc-footer">
                    <button type="button" class="qc-button-secondary" wire:click="goToStep(2)">Back</button>
                    <button type="button" class="qc-button" wire:click="goToFeaturesStep">Next</button>
                </div>
            @endif

            @if ($currentStep === 4)
                <div class="qc-body">
                    <div class="qc-stack">
                        <div class="qc-summary-card">
                            <div>
                                <span class="qc-summary-label">Category</span>
                                <span class="qc-summary-value">{{ $this->selectedCategoryPath ?: '-' }}</span>
                            </div>
                            <button type="button" class="qc-text-link" wire:click="goToStep(2)">Change</button>
                        </div>

                        @if ($listingCustomFields === [])
                            <div class="qc-empty">No extra details for this category.</div>
                        @else
                            <div class="qc-fields two-col">
                                @foreach ($listingCustomFields as $field)
                                    <div class="qc-field">
                                        <label>
                                            {{ $field['label'] }}
                                            @if ($field['is_required'])
                                                *
                                            @endif
                                        </label>

                                        @if ($field['type'] === 'text')
                                            <input
                                                type="text"
                                                class="qc-input"
                                                wire:model.live="customFieldValues.{{ $field['name'] }}"
                                                placeholder="{{ $field['placeholder'] ?: $field['label'] }}"
                                            >
                                        @elseif ($field['type'] === 'textarea')
                                            <textarea
                                                class="qc-textarea"
                                                wire:model.live="customFieldValues.{{ $field['name'] }}"
                                                placeholder="{{ $field['placeholder'] ?: $field['label'] }}"
                                            ></textarea>
                                        @elseif ($field['type'] === 'number')
                                            <input
                                                type="number"
                                                step="0.01"
                                                class="qc-input"
                                                wire:model.live="customFieldValues.{{ $field['name'] }}"
                                                placeholder="{{ $field['placeholder'] ?: $field['label'] }}"
                                            >
                                        @elseif ($field['type'] === 'select')
                                            <select class="qc-select" wire:model.live="customFieldValues.{{ $field['name'] }}">
                                                <option value="">Select</option>
                                                @foreach ($field['options'] as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        @elseif ($field['type'] === 'boolean')
                                            <label class="qc-toggle">
                                                <input type="checkbox" wire:model.live="customFieldValues.{{ $field['name'] }}">
                                                <span>Yes</span>
                                            </label>
                                        @elseif ($field['type'] === 'date')
                                            <input type="date" class="qc-input" wire:model.live="customFieldValues.{{ $field['name'] }}">
                                        @endif

                                        @if ($field['help_text'])
                                            <p class="qc-meta-copy">{{ $field['help_text'] }}</p>
                                        @endif

                                        @error('customFieldValues.'.$field['name'])
                                            <div class="qc-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="qc-footer">
                    <button type="button" class="qc-button-secondary" wire:click="goToStep(3)">Back</button>
                    <button type="button" class="qc-button" wire:click="goToPreviewStep">Review</button>
                </div>
            @endif

            @if ($currentStep === 5)
                <div class="qc-body">
                    <div class="qc-review-grid">
                        <div class="qc-stack">
                            <div class="qc-review-gallery">
                                <div class="qc-gallery-main">
                                    @if (isset($photos[0]))
                                        <img src="{{ $photos[0]->temporaryUrl() }}" alt="Preview cover photo">
                                    @else
                                        <x-heroicon-o-photo class="h-12 w-12 text-slate-400" />
                                    @endif
                                </div>

                                <div class="qc-review-thumbs">
                                    @foreach (array_slice($photos, 0, 4) as $photo)
                                        <div class="qc-review-thumb">
                                            <img src="{{ $photo->temporaryUrl() }}" alt="Preview photo">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="qc-panel qc-review-panel">
                                <div class="qc-review-meta">
                                    <div class="qc-review-price">{{ $displayPrice }} {{ $currency }}</div>
                                    <div class="qc-review-location">
                                        <div>{{ $this->selectedCityName ?: '-' }}, {{ $this->selectedCountryName ?: '-' }}</div>
                                        <div>{{ now()->format('d.m.Y') }}</div>
                                    </div>
                                </div>

                                <h2 class="qc-review-title">{{ $listingTitle ?: 'Untitled listing' }}</h2>
                                <p class="qc-review-description">{{ $description ?: 'No description added.' }}</p>

                                <div class="qc-feature-list">
                                    <div class="qc-feature-row">
                                        <div class="qc-feature-label">Category</div>
                                        <div class="qc-feature-value">{{ $this->selectedCategoryPath ?: '-' }}</div>
                                    </div>

                                    @if ($this->previewCustomFields !== [])
                                        @foreach ($this->previewCustomFields as $field)
                                            <div class="qc-feature-row">
                                                <div class="qc-feature-label">{{ $field['label'] }}</div>
                                                <div class="qc-feature-value">{{ $field['value'] }}</div>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if (count($videos) > 0)
                                        <div class="qc-feature-row">
                                            <div class="qc-feature-label">Videos</div>
                                            <div class="qc-feature-value">{{ count($videos) }} added</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="qc-side-stack">
                            <div class="qc-panel qc-seller-card">
                                <div class="qc-seller-head">
                                    <span class="qc-avatar">{{ $this->currentUserInitial }}</span>
                                    <div>
                                        <div class="qc-seller-name">{{ $this->currentUserName }}</div>
                                        <div class="qc-seller-email">{{ auth()->user()?->email }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="qc-panel">
                                <div class="qc-publish-stack">
                                    <button
                                        type="button"
                                        class="qc-button"
                                        wire:click.prevent="publishListing"
                                        wire:loading.attr="disabled"
                                        wire:target="publishListing"
                                    >
                                        <span wire:loading.remove wire:target="publishListing">Publish listing</span>
                                        <span wire:loading wire:target="publishListing">Publishing...</span>
                                    </button>
                                    <button type="button" class="qc-button-secondary" wire:click="goToStep(4)" wire:loading.attr="disabled" wire:target="publishListing">Back</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@include('video::partials.video-upload-optimizer')
