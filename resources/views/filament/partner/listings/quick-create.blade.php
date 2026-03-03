<x-filament-panels::page>
    <style>
        .ql-shell { --ql-bg: #ececec; --ql-card: #f3f3f3; --ql-border: #d5d5d5; --ql-text: #121212; --ql-muted: #5f5f5f; --ql-primary: #ff3d59; --ql-primary-soft: #ffe0e6; --ql-warn: #f5e8b3; max-width: 760px; margin: 0 auto; color: var(--ql-text); }
        .ql-head { display: flex; justify-content: space-between; align-items: center; gap: 1rem; margin-bottom: 1rem; }
        .ql-title { font-size: 2rem; font-weight: 800; letter-spacing: -.02em; }
        .ql-progress-wrap { display: flex; align-items: center; gap: 1rem; }
        .ql-progress { display: grid; grid-template-columns: repeat(6, 1fr); gap: .3rem; width: 260px; }
        .ql-progress > span { height: .32rem; border-radius: 999px; background: #d1d1d1; }
        .ql-progress > span.is-on { background: var(--ql-primary); }
        .ql-step-text { font-weight: 800; font-size: 2rem; }
        .ql-card { border: 1px solid var(--ql-border); border-radius: .8rem; background: var(--ql-card); overflow: hidden; }
        .ql-content { padding: 2rem; min-height: 560px; }
        .ql-upload-zone { display: flex; flex-direction: column; align-items: center; gap: .9rem; text-align: center; border: 2px dashed #ababab; border-radius: .8rem; padding: 2.2rem 1rem; cursor: pointer; background: #f7f7f7; }
        .ql-upload-title { font-size: 1.9rem; font-weight: 800; line-height: 1.2; }
        .ql-upload-desc { color: #303030; max-width: 540px; line-height: 1.35; font-size: 1.12rem; }
        .ql-upload-btn { display: inline-flex; align-items: center; justify-content: center; min-width: 220px; background: var(--ql-primary); color: #fff; border-radius: 999px; padding: .95rem 1.7rem; font-size: 1.2rem; font-weight: 700; }
        .ql-help { text-align: center; color: #444; margin: 1rem 0 0; font-size: 1rem; line-height: 1.45; }
        .ql-help strong { color: #111; }
        .ql-ai-note { display: flex; flex-direction: column; align-items: center; gap: .65rem; margin-top: 2.2rem; text-align: center; }
        .ql-ai-note h3 { font-size: 2.05rem; line-height: 1.2; font-weight: 800; }
        .ql-ai-note p { color: #303030; line-height: 1.5; font-size: 1.15rem; }
        .ql-error { color: #b42318; margin-top: .6rem; font-size: .9rem; text-align: center; }
        .ql-photos-title { margin-top: 2rem; text-align: center; font-size: 2.1rem; font-weight: 800; }
        .ql-photos-sub { margin: .8rem auto 1rem; background: #e0e0e0; border-radius: .8rem; width: fit-content; padding: .55rem 1.2rem; color: #515151; font-size: .95rem; }
        .ql-grid { display: grid; grid-template-columns: repeat(5, minmax(0, 1fr)); gap: .75rem; }
        .ql-slot { border-radius: .5rem; aspect-ratio: 1; background: #dcdcdc; border: 1px solid #d0d0d0; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center; }
        .ql-slot img { width: 100%; height: 100%; object-fit: cover; }
        .ql-remove { position: absolute; top: .25rem; right: .25rem; border: 0; background: #2e2e2ecc; color: #fff; width: 1.3rem; height: 1.3rem; border-radius: 999px; font-size: .75rem; font-weight: 700; cursor: pointer; }
        .ql-cover { position: absolute; left: 0; right: 0; bottom: 0; background: var(--ql-primary); color: #fff; font-size: .7rem; text-align: center; font-weight: 700; padding: .2rem 0; letter-spacing: .02em; }
        .ql-footer { border-top: 1px solid #cbcbcb; background: #ededed; padding: 1.1rem; display: flex; justify-content: center; }
        .ql-continue { border: 0; border-radius: 999px; min-width: 210px; padding: .9rem 1.4rem; font-size: 1.35rem; font-weight: 700; background: var(--ql-primary); color: #fff; cursor: pointer; }
        .ql-continue[disabled] { background: #d4d4d4; color: #efefef; cursor: not-allowed; }
        .ql-warning { display: flex; align-items: center; gap: .6rem; background: var(--ql-warn); padding: .9rem 1.1rem; border-bottom: 1px solid #eadf9f; font-size: .98rem; font-weight: 600; }
        .ql-browser-header { display: flex; align-items: center; justify-content: space-between; gap: 1rem; border-bottom: 1px solid #d9d9d9; padding: .95rem 1.1rem; font-weight: 700; }
        .ql-back-btn { border: 0; background: transparent; padding: 0; color: #222; cursor: pointer; display: inline-flex; align-items: center; gap: .3rem; font-weight: 600; }
        .ql-root-grid { padding: 1.2rem; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1rem; }
        .ql-root-item { border: 1px solid transparent; background: transparent; border-radius: .7rem; padding: .8rem .4rem; text-align: center; cursor: pointer; }
        .ql-root-item:hover { border-color: #cecece; background: #f9f9f9; }
        .ql-root-item.is-selected { border-color: var(--ql-primary); background: var(--ql-primary-soft); }
        .ql-root-icon { width: 4.2rem; height: 4.2rem; border-radius: 999px; margin: 0 auto .6rem; background: #ede1cf; display: inline-flex; align-items: center; justify-content: center; color: #3b3b3b; }
        .ql-root-name { font-size: 1.05rem; font-weight: 700; line-height: 1.3; }
        .ql-search { padding: .9rem 1.1rem; border-bottom: 1px solid #dfdfdf; }
        .ql-search input { width: 100%; border: 1px solid #d4d4d4; border-radius: .6rem; background: #f2f2f2; padding: .72rem .9rem; font-size: .98rem; }
        .ql-list { padding: 0 1.1rem 1.2rem; }
        .ql-row { border-bottom: 1px solid #dddddd; padding: .85rem .1rem; display: grid; grid-template-columns: 1fr auto auto; gap: .55rem; align-items: center; }
        .ql-row button { border: 0; background: transparent; cursor: pointer; text-align: left; }
        .ql-row-main { font-size: 1.05rem; color: #212121; }
        .ql-row-main.is-selected { font-weight: 700; }
        .ql-row-child { color: #8a8a8a; }
        .ql-row-check { color: var(--ql-primary); }
        .ql-selection { padding: .8rem 1.1rem 0; color: #3a3a3a; font-size: .95rem; }
        @media (max-width: 900px) {
            .ql-title { font-size: 1.7rem; }
            .ql-step-text { font-size: 1.7rem; }
            .ql-content { padding: 1.2rem; min-height: 460px; }
            .ql-upload-title, .ql-ai-note h3, .ql-photos-title { font-size: 1.5rem; }
            .ql-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
            .ql-root-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
    </style>

    <div class="ql-shell">
        <div class="ql-head">
            <div class="ql-title">{{ $currentStep === 1 ? 'Fotoğraf' : 'Kategori Seçimi' }}</div>
            <div class="ql-progress-wrap">
                <div class="ql-progress" aria-hidden="true">
                    @for ($step = 1; $step <= 6; $step++)
                        <span @class(['is-on' => $step <= $currentStep])></span>
                    @endfor
                </div>
                <div class="ql-step-text">{{ $currentStep }}/6</div>
            </div>
        </div>

        <div class="ql-card">
            @if ($currentStep === 1)
                <div class="ql-content">
                    <label class="ql-upload-zone" for="quick-listing-photo-input">
                        <x-heroicon-o-photo class="h-10 w-10 text-gray-700" />
                        <div class="ql-upload-title">Ürün fotoğraflarını yükle</div>
                        <div class="ql-upload-desc">
                            Yüklemeye başlamak için ürün fotoğraflarını
                            <strong>bu alana sürükleyip bırakın</strong> veya
                        </div>
                        <span class="ql-upload-btn">Fotoğraf Seç</span>
                    </label>

                    <input
                        id="quick-listing-photo-input"
                        type="file"
                        wire:model="photos"
                        accept="image/jpeg,image/jpg,image/png"
                        multiple
                        class="hidden"
                    />

                    <p class="ql-help">
                        <strong>İpucu:</strong> En az 1 fotoğraf, en çok {{ (int) config('quick-listing.max_photo_count', 20) }} fotoğraf yükleyebilirsin.<br>
                        Desteklenen formatlar: <strong>.jpg, .jpeg ve .png</strong>
                    </p>

                    @error('photos')
                        <div class="ql-error">{{ $message }}</div>
                    @enderror

                    @error('photos.*')
                        <div class="ql-error">{{ $message }}</div>
                    @enderror

                    @if (count($photos) > 0)
                        <h3 class="ql-photos-title">Seçtiğin Fotoğraflar</h3>
                        <div class="ql-photos-sub">Fotoğrafları sıralamak için tut ve sürükle</div>

                        <div class="ql-grid">
                            @for ($index = 0; $index < (int) config('quick-listing.max_photo_count', 20); $index++)
                                <div class="ql-slot">
                                    @if (isset($photos[$index]))
                                        <img src="{{ $photos[$index]->temporaryUrl() }}" alt="Yüklenen fotoğraf {{ $index + 1 }}">
                                        <button type="button" class="ql-remove" wire:click="removePhoto({{ $index }})">×</button>
                                        @if ($index === 0)
                                            <div class="ql-cover">KAPAK</div>
                                        @endif
                                    @else
                                        <x-heroicon-o-photo class="h-9 w-9 text-gray-400" />
                                    @endif
                                </div>
                            @endfor
                        </div>
                    @else
                        <div class="ql-ai-note">
                            <x-heroicon-o-sparkles class="h-10 w-10 text-pink-500" />
                            <h3>Ürün fotoğraflarını yükle</h3>
                            <p>
                                Hızlı ilan vermek için en az 1 fotoğraf yükleyin.<br>
                                <strong>letgo AI</strong> sizin için otomatik kategori önerileri sunar.
                            </p>
                        </div>
                    @endif
                </div>

                <div class="ql-footer">
                    <button
                        type="button"
                        class="ql-continue"
                        wire:click="goToCategoryStep"
                        @disabled(count($photos) === 0 || $isDetecting)
                    >
                        Devam Et
                    </button>
                </div>
            @endif

            @if ($currentStep === 2)
                @if ($isDetecting)
                    <div class="ql-warning">
                        <x-heroicon-o-arrow-path class="h-5 w-5 animate-spin text-gray-700" />
                        <span>Fotoğraf analiz ediliyor, kategori önerisi hazırlanıyor...</span>
                    </div>
                @elseif ($detectedCategoryId)
                    <div class="ql-warning">
                        <x-heroicon-o-sparkles class="h-5 w-5 text-pink-500" />
                        <span>
                            letgo AI kategori önerdi:
                            <strong>{{ $this->selectedCategoryName }}</strong>
                            @if ($detectedConfidence)
                                (Güven: {{ number_format($detectedConfidence * 100, 0) }}%)
                            @endif
                        </span>
                    </div>
                @else
                    <div class="ql-warning">
                        <x-heroicon-o-sparkles class="h-5 w-5 text-pink-500" />
                        <span>letgo AI ile ilan kategorisi tespit edilemedi, lütfen kategori seçimi yapın.</span>
                    </div>
                @endif

                @if (is_null($activeParentCategoryId))
                    <div class="ql-browser-header">
                        <span></span>
                        <strong>Ne Satıyorsun?</strong>
                        <span></span>
                    </div>

                    <div class="ql-root-grid">
                        @foreach ($this->rootCategories as $category)
                            <button
                                type="button"
                                class="ql-root-item {{ $selectedCategoryId === $category['id'] ? 'is-selected' : '' }}"
                                wire:click="enterCategory({{ $category['id'] }})"
                            >
                                <span class="ql-root-icon">
                                    <x-dynamic-component :component="$this->categoryIconComponent($category['icon'])" class="h-8 w-8" />
                                </span>
                                <div class="ql-root-name">{{ $category['name'] }}</div>
                            </button>
                        @endforeach
                    </div>
                @else
                    <div class="ql-browser-header">
                        <button type="button" class="ql-back-btn" wire:click="backToRootCategories">
                            <x-heroicon-o-arrow-left class="h-5 w-5" />
                            Geri
                        </button>
                        <strong>{{ $this->currentParentName }}</strong>
                        <span></span>
                    </div>

                    <div class="ql-search">
                        <input type="text" placeholder="Kategori Ara" wire:model.live.debounce.300ms="categorySearch">
                    </div>

                    <div class="ql-list">
                        @forelse ($this->currentCategories as $category)
                            <div class="ql-row">
                                <button
                                    type="button"
                                    class="ql-row-main {{ $selectedCategoryId === $category['id'] ? 'is-selected' : '' }}"
                                    wire:click="selectCategory({{ $category['id'] }})"
                                >
                                    {{ $category['name'] }}
                                </button>

                                @if ($category['has_children'] && $category['id'] !== $activeParentCategoryId)
                                    <button type="button" class="ql-row-child" wire:click="enterCategory({{ $category['id'] }})">
                                        <x-heroicon-o-chevron-right class="h-5 w-5" />
                                    </button>
                                @else
                                    <span></span>
                                @endif

                                <span class="ql-row-check">
                                    @if ($selectedCategoryId === $category['id'])
                                        <x-heroicon-o-check-circle class="h-5 w-5" />
                                    @endif
                                </span>
                            </div>
                        @empty
                            <div class="ql-row">
                                <span class="ql-row-main">Aramaya uygun kategori bulunamadı.</span>
                            </div>
                        @endforelse
                    </div>
                @endif

                @if ($this->selectedCategoryName)
                    <div class="ql-selection">Seçilen kategori: <strong>{{ $this->selectedCategoryName }}</strong></div>
                @endif

                <div class="ql-footer">
                    <button
                        type="button"
                        class="ql-continue"
                        wire:click="continueToManualCreate"
                        @disabled(! $selectedCategoryId)
                    >
                        Devam Et
                    </button>
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>
