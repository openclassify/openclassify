@php
    $steps = [
        1 => __('panel::messages.photos'),
        2 => __('site::messages.category'),
        3 => __('site::messages.details'),
        4 => __('panel::messages.overview'),
    ];
@endphp

<div class="shell shell--narrow page">
    <div class="stack stack--loose">
        <header class="stack stack--tight">
            <p class="text-eyebrow">{{ __('panel::messages.new_listing') }}</p>
            <h1 class="title-page">{{ $this->currentStepTitle }}</h1>
            <p class="text-muted">{{ $this->currentStepHint }}</p>
        </header>

        <ol class="chip-row" aria-label="{{ __('panel::messages.new_listing') }}">
            @foreach($steps as $number => $label)
                <li>
                    <button
                        type="button"
                        class="pill {{ $currentStep === $number ? 'is-active' : '' }}"
                        wire:click="goToStep({{ $number }})"
                        @disabled($number > $currentStep)
                    >
                        <span>{{ $number }}</span>
                        <span>{{ $label }}</span>
                    </button>
                </li>
            @endforeach
        </ol>

        @if($publishError)
            <div class="alert alert--critical" role="alert">
                <x-ui.icon name="shield"/>
                <span>{{ $publishError }}</span>
            </div>
        @endif

        @error('photos.*')
            <div class="alert alert--critical" role="alert"><x-ui.icon name="shield"/><span>{{ $message }}</span></div>
        @enderror

        <section class="card">
            <div class="card__body">
                @if($currentStep === 1)
                    <div class="upload">
                        <label class="upload__control" for="quick-photos">
                            <x-ui.icon name="image"/>
                            <span class="title-card">{{ __('panel::messages.photos') }}</span>
                            <span class="text-muted">{{ __('panel::messages.photos_hint') }}</span>
                            <input id="quick-photos" type="file" class="visually-hidden" wire:model="photos" multiple accept="image/*">
                        </label>

                        <div wire:loading wire:target="photos" class="text-muted">{{ __('panel::messages.uploading') }}</div>

                        @if($photos !== [])
                            <div class="upload__grid">
                                @foreach($photos as $index => $photo)
                                    <figure class="upload__preview" style="position:relative">
                                        <img src="{{ $photo->temporaryUrl() }}" alt="">
                                        <button
                                            type="button"
                                            class="icon-button"
                                            style="position:absolute;top:4px;inset-inline-end:4px;background:var(--surface-overlay);width:28px;height:28px"
                                            wire:click="removePhoto({{ $index }})"
                                            aria-label="{{ __('favorite::messages.remove') }}"
                                        ><x-ui.icon name="close"/></button>
                                    </figure>
                                @endforeach
                            </div>
                        @endif

                        <div class="upload">
                            <label class="upload__control" for="quick-videos">
                                <x-ui.icon name="video"/>
                                <span class="title-card">{{ __('panel::messages.videos') }}</span>
                                <input id="quick-videos" type="file" class="visually-hidden" wire:model="videos" multiple accept="video/*">
                            </label>

                            @if($videos !== [])
                                <ul class="stack stack--tight">
                                    @foreach($videos as $index => $video)
                                        <li class="row row--between">
                                            <span class="text-body text-clamp-1">{{ $video->getClientOriginalName() }}</span>
                                            <button type="button" class="button button--ghost button--small" wire:click="removeVideo({{ $index }})">
                                                {{ __('favorite::messages.remove') }}
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @elseif($currentStep === 2)
                    <div class="stack">
                        @if($detectedError)
                            <div class="alert alert--caution"><x-ui.icon name="sparkle"/><span>{{ $detectedError }}</span></div>
                        @elseif($detectedCategoryId)
                            <div class="alert alert--positive"><x-ui.icon name="sparkle"/><span>{{ $detectedReason }}</span></div>
                        @endif

                        <div class="field">
                            <label class="field__label" for="category-search">{{ __('site::messages.search') }}</label>
                            <span class="input-affix">
                                <x-ui.icon name="search" class="input-affix__icon"/>
                                <input id="category-search" type="search" class="input" wire:model.live.debounce.300ms="categorySearch">
                            </span>
                        </div>

                        @if($activeParentCategoryId)
                            <div class="row">
                                <button type="button" class="button button--ghost button--small" wire:click="backToRootCategories">
                                    <x-ui.icon name="arrow-left"/>
                                    <span>{{ __('site::messages.all_categories') }}</span>
                                </button>
                                <span class="text-muted">{{ $this->currentParentName }}</span>
                            </div>

                            <div class="nav-list">
                                @foreach($this->currentCategories as $category)
                                    <button
                                        type="button"
                                        class="nav-list__item {{ $selectedCategoryId === $category['id'] ? 'is-active' : '' }}"
                                        wire:click="selectCategory({{ $category['id'] }})"
                                    >
                                        <span>{{ $category['name'] }}</span>
                                        @if($selectedCategoryId === $category['id'])
                                            <x-ui.icon name="check"/>
                                        @else
                                            <x-ui.icon name="chevron-right"/>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        @else
                            <div class="grid grid--categories">
                                @foreach($this->rootCategories as $category)
                                    <button type="button" class="category-card" wire:click="enterCategory({{ $category['id'] }})">
                                        <span class="category-card__icon"><x-ui.icon name="grid"/></span>
                                        <span class="category-card__name">{{ $category['name'] }}</span>
                                    </button>
                                @endforeach
                            </div>
                        @endif

                        @error('selectedCategoryId')<p class="field__error">{{ $message }}</p>@enderror
                    </div>
                @elseif($currentStep === 3)
                    <div class="stack">
                        <div class="field">
                            <label class="field__label" for="listing-title">{{ __('panel::messages.title') }}</label>
                            <input id="listing-title" type="text" class="input" wire:model.blur="listingTitle" maxlength="150">
                            @error('listingTitle')<p class="field__error">{{ $message }}</p>@enderror
                        </div>

                        <div class="field">
                            <label class="field__label" for="listing-description">{{ __('panel::messages.description') }}</label>
                            <textarea id="listing-description" class="textarea" rows="6" wire:model.blur="description" maxlength="4000"></textarea>
                            @error('description')<p class="field__error">{{ $message }}</p>@enderror
                        </div>

                        <div class="field__row field__row--three">
                            <div class="field">
                                <label class="field__label" for="listing-price">{{ __('panel::messages.price') }}</label>
                                <input id="listing-price" type="number" step="0.01" min="0" class="input" wire:model.blur="price">
                                @error('price')<p class="field__error">{{ $message }}</p>@enderror
                            </div>

                            <div class="field">
                                <label class="field__label" for="listing-country">{{ __('site::messages.country') }}</label>
                                <select id="listing-country" class="select" wire:model.live="selectedCountryId">
                                    <option value="">{{ __('site::messages.all_countries') }}</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('selectedCountryId')<p class="field__error">{{ $message }}</p>@enderror
                            </div>

                            <div class="field">
                                <label class="field__label" for="listing-city">{{ __('site::messages.city') }}</label>
                                <select id="listing-city" class="select" wire:model="selectedCityId" @disabled($this->availableCities === [])>
                                    <option value="">{{ __('site::messages.all_cities') }}</option>
                                    @foreach($this->availableCities as $city)
                                        <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('selectedCityId')<p class="field__error">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        @if($listingCustomFields !== [])
                            <div class="field-set">
                                <p class="field-set__legend">{{ __('site::messages.details') }}</p>
                                @foreach($listingCustomFields as $field)
                                    <div class="field">
                                        <label class="field__label" for="custom-{{ $field['name'] }}">{{ $field['label'] }}</label>
                                        @if(($field['type'] ?? 'text') === 'select')
                                            <select id="custom-{{ $field['name'] }}" class="select" wire:model="customFieldValues.{{ $field['name'] }}">
                                                <option value="">—</option>
                                                @foreach($field['options'] ?? [] as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        @elseif(($field['type'] ?? 'text') === 'boolean')
                                            <label class="checkbox">
                                                <input type="checkbox" wire:model="customFieldValues.{{ $field['name'] }}">
                                                <span>{{ $field['label'] }}</span>
                                            </label>
                                        @elseif(($field['type'] ?? 'text') === 'textarea')
                                            <textarea id="custom-{{ $field['name'] }}" class="textarea" rows="3" wire:model="customFieldValues.{{ $field['name'] }}"></textarea>
                                        @else
                                            <input
                                                id="custom-{{ $field['name'] }}"
                                                type="{{ ($field['type'] ?? 'text') === 'number' ? 'number' : 'text' }}"
                                                class="input"
                                                wire:model="customFieldValues.{{ $field['name'] }}"
                                            >
                                        @endif
                                        @if(filled($field['help_text'] ?? null))
                                            <p class="field__hint">{{ $field['help_text'] }}</p>
                                        @endif
                                        @error('customFieldValues.'.$field['name'])<p class="field__error">{{ $message }}</p>@enderror
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="stack">
                        <dl class="spec-list">
                            <div class="spec-list__row">
                                <dt class="spec-list__label">{{ __('panel::messages.title') }}</dt>
                                <dd class="spec-list__value">{{ $listingTitle }}</dd>
                            </div>
                            <div class="spec-list__row">
                                <dt class="spec-list__label">{{ __('site::messages.category') }}</dt>
                                <dd class="spec-list__value">{{ $this->selectedCategoryPath }}</dd>
                            </div>
                            <div class="spec-list__row">
                                <dt class="spec-list__label">{{ __('panel::messages.price') }}</dt>
                                <dd class="spec-list__value">{{ $price }}</dd>
                            </div>
                            <div class="spec-list__row">
                                <dt class="spec-list__label">{{ __('panel::messages.location') }}</dt>
                                <dd class="spec-list__value">{{ $this->selectedCityName }} {{ $this->selectedCountryName }}</dd>
                            </div>
                        </dl>

                        @if(filled($description))
                            <div class="prose">{{ $description }}</div>
                        @endif

                        @if($photos !== [])
                            <div class="upload__grid">
                                @foreach($photos as $photo)
                                    <figure class="upload__preview"><img src="{{ $photo->temporaryUrl() }}" alt=""></figure>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <div class="card__foot">
                <div class="row row--between">
                    @if($currentStep > 1)
                        <button type="button" class="button button--ghost" wire:click="goToStep({{ $currentStep - 1 }})">
                            <x-ui.icon name="arrow-left"/>
                            <span>{{ __('site::messages.back') }}</span>
                        </button>
                    @else
                        <a href="{{ route('panel.listings.index') }}" class="button button--ghost">{{ __('panel::messages.cancel') }}</a>
                    @endif

                    @if($currentStep === 1)
                        <button type="button" class="button button--primary" wire:click="goToCategoryStep">{{ __('site::messages.apply') }}</button>
                    @elseif($currentStep === 2)
                        <button type="button" class="button button--primary" wire:click="goToDetailsStep">{{ __('site::messages.apply') }}</button>
                    @elseif($currentStep === 3)
                        <button type="button" class="button button--primary" wire:click="goToPreviewStep">{{ __('site::messages.apply') }}</button>
                    @else
                        <button type="button" class="button button--primary button--large" wire:click="publishListing" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="publishListing">{{ __('site::messages.post_listing_cta') }}</span>
                            <span wire:loading wire:target="publishListing">{{ __('panel::messages.publishing') }}</span>
                        </button>
                    @endif
                </div>
            </div>
        </section>
    </div>
</div>
