<div class="max-w-[1320px] mx-auto px-4 py-8">
    <style>
        .qc-shell {
            --qc-card: #ffffff;
            --qc-border: #e2e8f0;
            --qc-text: #0f172a;
            --qc-muted: #64748b;
            --qc-primary: #f43f5e;
            --qc-primary-soft: #ffe4ea;
            --qc-warn: #f6edc5;
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            color: var(--qc-text);
        }

        .qc-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: .85rem;
        }

        .qc-title {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.015em;
            line-height: 1.12;
        }

        .qc-progress-wrap {
            display: flex;
            align-items: center;
            gap: .65rem;
        }

        .qc-progress {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: .35rem;
            width: 190px;
        }

        .qc-progress > span {
            height: .24rem;
            border-radius: 999px;
            background: #cbd5e1;
        }

        .qc-progress > span.is-on {
            background: var(--qc-primary);
        }

        .qc-step-label {
            font-size: 1.55rem;
            font-weight: 700;
            line-height: 1;
        }

        .qc-card {
            border: 1px solid var(--qc-border);
            border-radius: .75rem;
            background: var(--qc-card);
            overflow: hidden;
        }

        .qc-body {
            padding: 1.25rem;
            min-height: 480px;
        }

        .qc-footer {
            border-top: 1px solid var(--qc-border);
            background: #fff;
            padding: .9rem 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .75rem;
        }

        .qc-btn {
            border: 0;
            border-radius: 999px;
            min-width: 190px;
            padding: .74rem 1.2rem;
            font-size: .97rem;
            font-weight: 700;
            cursor: pointer;
            transition: .15s ease;
        }

        .qc-btn-primary {
            background: var(--qc-primary);
            color: #fff;
        }

        .qc-btn-primary:hover {
            filter: brightness(.95);
        }

        .qc-btn-secondary {
            background: #dedede;
            color: #3d3d3d;
        }

        .qc-btn:disabled {
            background: #d8dbe1;
            color: #f3f4f6;
            cursor: not-allowed;
            filter: none;
        }

        .qc-upload-zone {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .65rem;
            text-align: center;
            border: 1px dashed #cbd5e1;
            border-radius: .75rem;
            background: #f8fafc;
            padding: 1.4rem .95rem;
            cursor: pointer;
        }

        .qc-upload-title {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.25;
        }

        .qc-upload-desc {
            color: #475569;
            max-width: 560px;
            line-height: 1.45;
            font-size: .95rem;
        }

        .qc-upload-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 170px;
            border-radius: 999px;
            background: var(--qc-primary);
            color: #fff;
            font-size: .95rem;
            font-weight: 700;
            padding: .66rem 1.2rem;
        }

        .qc-help {
            margin-top: .85rem;
            text-align: center;
            font-size: .9rem;
            color: #64748b;
            line-height: 1.5;
        }

        .qc-error {
            margin-top: .5rem;
            font-size: .85rem;
            color: #b42318;
            font-weight: 600;
        }

        .qc-ai-note {
            margin-top: 1.4rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .45rem;
        }

        .qc-ai-note h3 {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.25;
        }

        .qc-ai-note p {
            color: #475569;
            line-height: 1.45;
            font-size: .95rem;
        }

        .qc-photo-title {
            margin-top: 1.45rem;
            text-align: center;
            font-size: 1.35rem;
            font-weight: 700;
        }

        .qc-photo-sub {
            margin: .75rem auto 1rem;
            width: fit-content;
            border-radius: .8rem;
            background: #e3e7ee;
            color: #5b6371;
            padding: .5rem 1rem;
            font-size: .92rem;
        }

        .qc-photo-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: .65rem;
        }

        .qc-photo-slot {
            position: relative;
            border: 1px solid #d2d2d2;
            border-radius: .5rem;
            aspect-ratio: 1;
            background: #dddddd;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qc-photo-slot img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .qc-remove {
            position: absolute;
            top: .28rem;
            right: .28rem;
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 999px;
            border: 0;
            background: rgba(26, 26, 26, .86);
            color: #fff;
            font-size: .85rem;
            font-weight: 700;
            cursor: pointer;
        }

        .qc-cover {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--qc-primary);
            color: #fff;
            text-align: center;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .02em;
            padding: .2rem 0;
        }

        .qc-warning {
            display: flex;
            align-items: center;
            gap: .55rem;
            background: var(--qc-warn);
            border-bottom: 1px solid #eadb93;
            padding: .8rem 1rem;
            font-size: .95rem;
            font-weight: 600;
        }

        .qc-warning-sub {
            display: block;
            font-size: .82rem;
            color: #4a4a4a;
            font-weight: 500;
            margin-top: .2rem;
        }

        .qc-browser-header {
            border-bottom: 1px solid #d8d8d8;
            padding: .9rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: .8rem;
            font-weight: 700;
        }

        .qc-back-btn {
            border: 0;
            background: transparent;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: .2rem;
            color: #202020;
            font-size: .95rem;
        }

        .qc-root-grid {
            padding: 1rem;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: .85rem;
        }

        .qc-root-item {
            border: 1px solid transparent;
            border-radius: .7rem;
            background: transparent;
            cursor: pointer;
            padding: .7rem .4rem;
            text-align: center;
        }

        .qc-root-item:hover {
            border-color: #d4d4d4;
            background: #fafafa;
        }

        .qc-root-item.is-selected {
            border-color: var(--qc-primary);
            background: var(--qc-primary-soft);
        }

        .qc-root-icon {
            width: 4rem;
            height: 4rem;
            border-radius: 999px;
            background: #ece2d4;
            margin: 0 auto .5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .qc-root-name {
            font-size: .95rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .qc-search {
            padding: .8rem 1rem;
            border-bottom: 1px solid #dfdfdf;
        }

        .qc-search input {
            width: 100%;
            border: 1px solid #d6d6d6;
            border-radius: .6rem;
            background: #f2f2f2;
            padding: .68rem .9rem;
            font-size: .95rem;
        }

        .qc-list {
            padding: 0 1rem 1rem;
        }

        .qc-row {
            display: grid;
            grid-template-columns: 1fr auto auto;
            gap: .4rem;
            align-items: center;
            border-bottom: 1px solid #e0e0e0;
            padding: .84rem .1rem;
        }

        .qc-row-main,
        .qc-row-child {
            border: 0;
            background: transparent;
            cursor: pointer;
            text-align: left;
        }

        .qc-row-main {
            color: #1d1d1d;
            font-size: 1rem;
        }

        .qc-row-main.is-selected {
            font-weight: 700;
        }

        .qc-row-child {
            color: #8a8a8a;
        }

        .qc-row-check {
            color: var(--qc-primary);
        }

        .qc-selection {
            padding: .85rem 1rem 0;
            font-size: .92rem;
            color: #3b3b3b;
        }

        .qc-inline-actions {
            padding: .85rem 1rem 0;
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
        }

        .qc-chip {
            border: 1px solid #d8d8d8;
            border-radius: 999px;
            background: #fafafa;
            color: #404040;
            font-size: .82rem;
            font-weight: 600;
            padding: .35rem .7rem;
            cursor: pointer;
        }

        .qc-strip {
            border: 1px solid #d7d7d7;
            border-radius: .7rem;
            background: #eeeeee;
            padding: .75rem;
            display: grid;
            grid-template-columns: repeat(7, minmax(0, 1fr));
            gap: .55rem;
        }

        .qc-summary {
            margin-top: .95rem;
            border-top: 1px solid #d9d9d9;
            padding-top: .9rem;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: .8rem;
        }

        .qc-summary h4 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
            line-height: 1.2;
        }

        .qc-summary p {
            margin: .45rem 0 0;
            font-size: .98rem;
            color: #2f2f2f;
        }

        .qc-link-btn {
            border: 0;
            background: transparent;
            color: var(--qc-primary);
            font-size: 1rem;
            font-weight: 700;
            text-decoration: underline;
            cursor: pointer;
            white-space: nowrap;
        }

        .qc-form-grid {
            margin-top: 1rem;
            display: grid;
            gap: 1rem;
        }

        .qc-field label {
            display: inline-block;
            margin-bottom: .4rem;
            font-size: .95rem;
            font-weight: 700;
        }

        .qc-field .qc-hint {
            margin-top: .3rem;
            font-size: .85rem;
            color: #787878;
        }

        .qc-input,
        .qc-select,
        .qc-textarea {
            width: 100%;
            border: 1px solid #d6d6d6;
            border-radius: .65rem;
            background: #efefef;
            color: #2a2a2a;
            padding: .76rem .92rem;
            font-size: 1rem;
        }

        .qc-textarea {
            min-height: 140px;
            resize: vertical;
        }

        .qc-input-row {
            position: relative;
        }

        .qc-input-suffix {
            position: absolute;
            top: 50%;
            right: .9rem;
            transform: translateY(-50%);
            font-size: 1.25rem;
            font-weight: 700;
            color: #8a8a8a;
        }

        .qc-counter {
            margin-top: .35rem;
            text-align: right;
            color: #858585;
            font-size: .85rem;
            font-weight: 600;
        }

        .qc-two-col {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: .75rem;
        }

        .qc-dynamic-grid {
            margin-top: 1rem;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: .8rem;
        }

        .qc-toggle-line {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            font-size: .95rem;
            font-weight: 600;
            color: #323232;
        }

        .qc-info-box {
            margin-top: .8rem;
            border: 1px dashed #c8c8c8;
            border-radius: .75rem;
            background: #f4f4f4;
            color: #555;
            font-size: .92rem;
            padding: .85rem 1rem;
            line-height: 1.45;
        }

        .qc-preview-breadcrumb {
            color: #6a6a6a;
            font-size: .92rem;
            font-weight: 600;
            margin-bottom: .85rem;
        }

        .qc-preview-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 330px;
            gap: .9rem;
            align-items: start;
        }

        .qc-preview-panel {
            border: 1px solid #d8d8d8;
            border-radius: .75rem;
            background: #f8f8f8;
            padding: .9rem;
        }

        .qc-gallery {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: .55rem;
        }

        .qc-gallery-item {
            border-radius: .65rem;
            overflow: hidden;
            background: #2f2f35;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qc-gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .qc-main-meta {
            margin-top: 1rem;
            border-top: 1px solid #dfdfdf;
            padding-top: 1rem;
        }

        .qc-main-price {
            font-size: 1.9rem;
            font-weight: 900;
            line-height: 1;
        }

        .qc-main-location {
            margin-top: .5rem;
            color: #545454;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: .35rem;
        }

        .qc-main-title {
            margin-top: .95rem;
            font-size: 1.15rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .qc-main-desc {
            margin-top: .5rem;
            color: #333;
            line-height: 1.55;
            font-size: .98rem;
        }

        .qc-preview-features {
            margin-top: 1rem;
            border-top: 1px solid #dfdfdf;
            padding-top: .8rem;
        }

        .qc-preview-features h5 {
            font-size: 1.2rem;
            font-weight: 800;
            margin: 0 0 .6rem;
        }

        .qc-feature-row {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: .7rem;
            border-top: 1px solid #ececec;
            padding: .55rem 0;
            font-size: .95rem;
        }

        .qc-feature-row:first-child {
            border-top: 0;
            padding-top: 0;
        }

        .qc-feature-label {
            color: #6a6a6a;
            font-weight: 600;
        }

        .qc-feature-value {
            color: #1f1f1f;
            font-weight: 700;
        }

        .qc-seller-card {
            border: 1px solid #d8d8d8;
            border-radius: .75rem;
            background: #f8f8f8;
            padding: 1rem;
        }

        .qc-seller-head {
            display: flex;
            align-items: center;
            gap: .65rem;
        }

        .qc-avatar {
            width: 3.1rem;
            height: 3.1rem;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f1d9df;
            color: #b43353;
            font-weight: 800;
            font-size: 1.35rem;
        }

        .qc-seller-name {
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .qc-seller-email {
            color: #757575;
            font-size: .9rem;
        }

        .qc-seller-actions {
            margin-top: .95rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .5rem;
        }

        .qc-pill {
            border: 1px solid #e8c9d2;
            border-radius: 999px;
            background: #fff;
            color: #d34565;
            font-size: .95rem;
            font-weight: 700;
            padding: .55rem .6rem;
            text-align: center;
        }

        .qc-publish-wrap {
            margin-top: .9rem;
            display: grid;
            gap: .55rem;
        }

        .qc-publish {
            width: 100%;
            border: 0;
            border-radius: 999px;
            background: var(--qc-primary);
            color: #fff;
            font-size: 1.05rem;
            font-weight: 700;
            padding: .7rem 1rem;
            cursor: pointer;
        }

        .qc-publish:hover {
            filter: brightness(.95);
        }

        .qc-publish:disabled {
            background: #d8d8d8;
            color: #efefef;
            cursor: not-allowed;
        }

        .qc-muted-btn {
            width: 100%;
            border: 1px solid #d7d7d7;
            border-radius: 999px;
            background: #f7f7f7;
            color: #555;
            font-size: .95rem;
            font-weight: 700;
            padding: .6rem .9rem;
            cursor: pointer;
        }

        @media (max-width: 1120px) {
            .qc-preview-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 900px) {
            .qc-title {
                font-size: 1.7rem;
            }

            .qc-step-label {
                font-size: 1.3rem;
            }

            .qc-body {
                padding: 1rem;
                min-height: 420px;
            }

            .qc-progress {
                width: 160px;
                gap: .3rem;
            }

            .qc-upload-title,
            .qc-ai-note h3 {
                font-size: 1.3rem;
            }

            .qc-upload-desc,
            .qc-ai-note p,
            .qc-help {
                font-size: .97rem;
            }

            .qc-photo-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }

            .qc-root-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .qc-strip {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }

            .qc-two-col,
            .qc-dynamic-grid {
                grid-template-columns: 1fr;
            }

            .qc-feature-row {
                grid-template-columns: 1fr;
                gap: .2rem;
            }
        }

        @media (max-width: 640px) {
            .qc-head {
                flex-direction: column;
                align-items: flex-start;
                gap: .7rem;
            }

            .qc-progress-wrap {
                width: 100%;
                justify-content: space-between;
            }

            .qc-progress {
                width: min(58vw, 180px);
            }

            .qc-btn {
                min-width: 170px;
                font-size: .95rem;
            }

            .qc-upload-zone {
                padding: 1.2rem .85rem;
            }

            .qc-upload-title,
            .qc-ai-note h3 {
                font-size: 1.2rem;
            }

            .qc-photo-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
    </style>

    <div class="qc-shell">
        <div class="qc-head">
            <h1 class="qc-title">{{ $this->currentStepTitle }}</h1>
            <div class="qc-progress-wrap">
                <div class="qc-progress" aria-hidden="true">
                    @for ($step = 1; $step <= 5; $step++)
                        <span @class(['is-on' => $step <= $currentStep])></span>
                    @endfor
                </div>
                <div class="qc-step-label">{{ $currentStep }}/5</div>
            </div>
        </div>

        <div class="qc-card">
            @if ($currentStep === 1)
                <div class="qc-body">
                    <label class="qc-upload-zone" for="quick-listing-photo-input">
                        <x-heroicon-o-photo class="h-10 w-10 text-gray-700" />
                        <div class="qc-upload-title">Ürün fotoğraflarını yükle</div>
                        <div class="qc-upload-desc">
                            Yüklemeye başlamak için ürün fotoğraflarını
                            <strong>bu alana sürükleyip bırakın</strong> veya
                        </div>
                        <span class="qc-upload-btn">Fotoğraf Seç</span>
                    </label>

                    <input
                        id="quick-listing-photo-input"
                        type="file"
                        wire:model="photos"
                        accept="image/jpeg,image/jpg,image/png"
                        multiple
                        class="hidden"
                    />

                    <p class="qc-help">
                        <strong>İpucu:</strong> En az 1 fotoğraf, en çok {{ (int) config('quick-listing.max_photo_count', 20) }} fotoğraf yükleyebilirsin.<br>
                        Desteklenen formatlar: <strong>.jpg, .jpeg ve .png</strong>
                    </p>

                    @error('photos')
                        <div class="qc-error">{{ $message }}</div>
                    @enderror

                    @error('photos.*')
                        <div class="qc-error">{{ $message }}</div>
                    @enderror

                    @if (count($photos) > 0)
                        <h3 class="qc-photo-title">Seçtiğin Fotoğraflar</h3>
                        <div class="qc-photo-sub">Fotoğrafları sıralamak için tut ve sürükle</div>

                        <div class="qc-photo-grid">
                            @for ($index = 0; $index < (int) config('quick-listing.max_photo_count', 20); $index++)
                                <div class="qc-photo-slot">
                                    @if (isset($photos[$index]))
                                        <img src="{{ $photos[$index]->temporaryUrl() }}" alt="Yüklenen fotoğraf {{ $index + 1 }}">
                                        <button type="button" class="qc-remove" wire:click="removePhoto({{ $index }})">×</button>
                                        @if ($index === 0)
                                            <div class="qc-cover">KAPAK</div>
                                        @endif
                                    @else
                                        <x-heroicon-o-photo class="h-9 w-9 text-gray-400" />
                                    @endif
                                </div>
                            @endfor
                        </div>
                    @else
                        <div class="qc-ai-note">
                            <x-heroicon-o-sparkles class="h-10 w-10 text-pink-500" />
                            <h3>Ürün fotoğraflarını yükle</h3>
                            <p>
                                Hızlı ilan vermek için en az 1 fotoğraf yükleyin.<br>
                                <strong>Laravel AI</strong> sizin için otomatik kategori önerileri sunar.
                            </p>
                        </div>
                    @endif
                </div>

                <div class="qc-footer">
                    <button
                        type="button"
                        class="qc-btn qc-btn-primary"
                        wire:click="goToCategoryStep"
                        @disabled(count($photos) === 0 || $isDetecting)
                    >
                        Devam Et
                    </button>
                </div>
            @endif

            @if ($currentStep === 2)
                @if ($isDetecting)
                    <div class="qc-warning">
                        <x-heroicon-o-arrow-path class="h-5 w-5 animate-spin text-gray-700" />
                        <span>Fotoğraf analiz ediliyor, kategori önerisi hazırlanıyor...</span>
                    </div>
                @elseif ($detectedCategoryId)
                    <div class="qc-warning">
                        <x-heroicon-o-sparkles class="h-5 w-5 text-pink-500" />
                        <span>
                            AI kategori önerdi: <strong>{{ $this->selectedCategoryName }}</strong>
                            @if ($detectedConfidence)
                                (Güven: {{ number_format($detectedConfidence * 100, 0) }}%)
                            @endif
                            @if ($detectedReason)
                                <span class="qc-warning-sub">{{ $detectedReason }}</span>
                            @endif
                        </span>
                    </div>
                @else
                    <div class="qc-warning">
                        <x-heroicon-o-sparkles class="h-5 w-5 text-pink-500" />
                        <span>
                            AI ile kategori tespit edilemedi, lütfen kategori seçimi yapın.
                            @if ($detectedError)
                                <span class="qc-warning-sub">{{ $detectedError }}</span>
                            @endif
                        </span>
                    </div>
                @endif

                @if ($detectedAlternatives !== [])
                    <div class="qc-inline-actions">
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
                    <div class="qc-browser-header">
                        <span></span>
                        <strong>Ne Satıyorsun?</strong>
                        <button type="button" class="qc-chip" wire:click="detectCategoryFromImage" @disabled($isDetecting || count($photos) === 0)>
                            AI ile Tekrar Dene
                        </button>
                    </div>

                    <div class="qc-root-grid">
                        @foreach ($this->rootCategories as $category)
                            <button
                                type="button"
                                class="qc-root-item {{ $selectedCategoryId === $category['id'] ? 'is-selected' : '' }}"
                                wire:click="enterCategory({{ $category['id'] }})"
                            >
                                <span class="qc-root-icon">
                                    <x-dynamic-component :component="$this->categoryIconComponent($category['icon'])" class="h-8 w-8" />
                                </span>
                                <div class="qc-root-name">{{ $category['name'] }}</div>
                            </button>
                        @endforeach
                    </div>
                @else
                    <div class="qc-browser-header">
                        <button type="button" class="qc-back-btn" wire:click="backToRootCategories">
                            <x-heroicon-o-arrow-left class="h-5 w-5" />
                            Geri
                        </button>
                        <strong>{{ $this->currentParentName }}</strong>
                        <span></span>
                    </div>

                    <div class="qc-search">
                        <input type="text" placeholder="Kategori Ara" wire:model.live.debounce.300ms="categorySearch">
                    </div>

                    <div class="qc-list">
                        @forelse ($this->currentCategories as $category)
                            <div class="qc-row">
                                <button
                                    type="button"
                                    class="qc-row-main {{ $selectedCategoryId === $category['id'] ? 'is-selected' : '' }}"
                                    wire:click="selectCategory({{ $category['id'] }})"
                                >
                                    {{ $category['name'] }}
                                </button>

                                @if ($category['has_children'] && $category['id'] !== $activeParentCategoryId)
                                    <button type="button" class="qc-row-child" wire:click="enterCategory({{ $category['id'] }})">
                                        <x-heroicon-o-chevron-right class="h-5 w-5" />
                                    </button>
                                @else
                                    <span></span>
                                @endif

                                <span class="qc-row-check">
                                    @if ($selectedCategoryId === $category['id'])
                                        <x-heroicon-o-check-circle class="h-5 w-5" />
                                    @endif
                                </span>
                            </div>
                        @empty
                            <div class="qc-row">
                                <span class="qc-row-main">Aramaya uygun kategori bulunamadı.</span>
                            </div>
                        @endforelse
                    </div>
                @endif

                @if ($errors->has('selectedCategoryId'))
                    <div class="qc-selection qc-error">{{ $errors->first('selectedCategoryId') }}</div>
                @endif

                @if ($this->selectedCategoryName)
                    <div class="qc-selection">Seçilen kategori: <strong>{{ $this->selectedCategoryName }}</strong></div>
                @endif

                <div class="qc-footer">
                    <button type="button" class="qc-btn qc-btn-secondary" wire:click="goToStep(1)">Geri</button>
                    <button
                        type="button"
                        class="qc-btn qc-btn-primary"
                        wire:click="goToDetailsStep"
                        @disabled(! $selectedCategoryId)
                    >
                        Devam Et
                    </button>
                </div>
            @endif

            @if ($currentStep === 3)
                <div class="qc-body">
                    <div class="qc-strip">
                        @foreach (array_slice($photos, 0, 7) as $index => $photo)
                            <div class="qc-photo-slot">
                                <img src="{{ $photo->temporaryUrl() }}" alt="Seçilen fotoğraf {{ $index + 1 }}">
                                <button type="button" class="qc-remove" wire:click="removePhoto({{ $index }})">×</button>
                                @if ($index === 0)
                                    <div class="qc-cover">KAPAK</div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="qc-summary">
                        <div>
                            <h4>Seçilen Kategori</h4>
                            <p>{{ $this->selectedCategoryPath ?: '-' }}</p>
                        </div>
                        <button type="button" class="qc-link-btn" wire:click="goToStep(2)">Değiştir</button>
                    </div>

                    <div class="qc-form-grid">
                        <div class="qc-field">
                            <label for="quick-title">İlan Başlığı *</label>
                            <input id="quick-title" type="text" class="qc-input" placeholder="Başlık girin" wire:model.live.debounce.300ms="listingTitle" maxlength="70">
                            <p class="qc-hint">Ürünün temel özelliklerinden bahset (ör. marka, model, yaş, tip)</p>
                            <div class="qc-counter">{{ $this->titleCharacters }}/70</div>
                            @error('listingTitle')<div class="qc-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="qc-field">
                            <label for="quick-price">Fiyat *</label>
                            <div class="qc-input-row">
                                <input id="quick-price" type="number" step="0.01" class="qc-input" placeholder="Fiyat giriniz" wire:model.live.debounce.300ms="price">
                                <span class="qc-input-suffix">{{ \Modules\Listing\Support\ListingPanelHelper::defaultCurrency() }}</span>
                            </div>
                            <p class="qc-hint">Lütfen unutma; doğru fiyat daha hızlı satmanıza yardımcı olacaktır</p>
                            @error('price')<div class="qc-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="qc-field">
                            <label for="quick-description">Açıklama *</label>
                            <textarea id="quick-description" class="qc-textarea" placeholder="Açıklama girin" wire:model.live.debounce.300ms="description" maxlength="1450"></textarea>
                            <p class="qc-hint">Durum, özellik ve satma nedeni gibi bilgileri ekle</p>
                            <div class="qc-counter">{{ $this->descriptionCharacters }}/1450</div>
                            @error('description')<div class="qc-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="qc-field">
                            <label>Konum *</label>
                            <div class="qc-two-col">
                                <div>
                                    <select class="qc-select" wire:model.live="selectedCountryId">
                                        <option value="">Ülke seçin</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedCountryId')<div class="qc-error">{{ $message }}</div>@enderror
                                </div>
                                <div>
                                    <select class="qc-select" wire:model.live="selectedCityId" @disabled(! $selectedCountryId)>
                                        <option value="">Şehir seçin</option>
                                        @foreach ($this->availableCities as $city)
                                            <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedCityId')<div class="qc-error">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="qc-footer">
                    <button type="button" class="qc-btn qc-btn-secondary" wire:click="goToStep(2)">Geri</button>
                    <button type="button" class="qc-btn qc-btn-primary" wire:click="goToFeaturesStep">Devam Et</button>
                </div>
            @endif

            @if ($currentStep === 4)
                <div class="qc-body">
                    <div class="qc-summary" style="margin-top: 0; border-top: 0; padding-top: 0;">
                        <div>
                            <h4>Seçilen Kategori</h4>
                            <p>{{ $this->selectedCategoryPath ?: '-' }}</p>
                        </div>
                        <button type="button" class="qc-link-btn" wire:click="goToStep(2)">Değiştir</button>
                    </div>

                    @if ($listingCustomFields === [])
                        <div class="qc-info-box">
                            Bu kategori için ek ilan özelliği tanımlı değil. Devam ederek önizleme adımına geçebilirsin.
                        </div>
                    @else
                        <div class="qc-dynamic-grid">
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
                                            <option value="">Seçiniz</option>
                                            @foreach ($field['options'] as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($field['type'] === 'boolean')
                                        <label class="qc-toggle-line">
                                            <input type="checkbox" wire:model.live="customFieldValues.{{ $field['name'] }}">
                                            <span>Evet</span>
                                        </label>
                                    @elseif ($field['type'] === 'date')
                                        <input type="date" class="qc-input" wire:model.live="customFieldValues.{{ $field['name'] }}">
                                    @endif

                                    @if ($field['help_text'])
                                        <p class="qc-hint">{{ $field['help_text'] }}</p>
                                    @endif

                                    @error('customFieldValues.'.$field['name'])
                                        <div class="qc-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="qc-footer">
                    <button type="button" class="qc-btn qc-btn-secondary" wire:click="goToStep(3)">Geri</button>
                    <button type="button" class="qc-btn qc-btn-primary" wire:click="goToPreviewStep">Devam Et</button>
                </div>
            @endif

            @if ($currentStep === 5)
                <div class="qc-body">
                    <div class="qc-preview-breadcrumb">Anasayfa › {{ $this->selectedCategoryPath }}</div>

                    <div class="qc-preview-grid">
                        <div class="qc-preview-panel">
                            <div class="qc-gallery">
                                @foreach (array_slice($photos, 0, 3) as $photo)
                                    <div class="qc-gallery-item">
                                        <img src="{{ $photo->temporaryUrl() }}" alt="Önizleme fotoğrafı">
                                    </div>
                                @endforeach
                                @for ($empty = count(array_slice($photos, 0, 3)); $empty < 3; $empty++)
                                    <div class="qc-gallery-item">
                                        <x-heroicon-o-photo class="h-12 w-12 text-gray-500" />
                                    </div>
                                @endfor
                            </div>

                            @php
                                $displayPrice = is_numeric($price) ? number_format((float) $price, 0, ',', '.') : $price;
                            @endphp

                            <div class="qc-main-meta">
                                <div class="qc-main-price">{{ $displayPrice }} {{ \Modules\Listing\Support\ListingPanelHelper::defaultCurrency() }}</div>
                                <div class="qc-main-location">
                                    <x-heroicon-o-map-pin class="h-5 w-5" />
                                    <span>{{ $this->selectedCityName ?: '-' }}, {{ $this->selectedCountryName ?: '-' }}</span>
                                    <span style="margin-left: auto;">{{ now()->format('d.m.Y') }}</span>
                                </div>
                                <div class="qc-main-title">{{ $listingTitle }}</div>
                                <p class="qc-main-desc">{{ $description }}</p>
                            </div>

                            <div class="qc-preview-features">
                                <h5>İlan Özellikleri</h5>
                                @if ($this->previewCustomFields !== [])
                                    @foreach ($this->previewCustomFields as $field)
                                        <div class="qc-feature-row">
                                            <div class="qc-feature-label">{{ $field['label'] }}</div>
                                            <div class="qc-feature-value">{{ $field['value'] }}</div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="qc-feature-row">
                                        <div class="qc-feature-label">Ek özellik</div>
                                        <div class="qc-feature-value">Bu kategori için seçilmedi</div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <div class="qc-seller-card">
                                <div class="qc-seller-head">
                                    <span class="qc-avatar">{{ $this->currentUserInitial }}</span>
                                    <div>
                                        <div class="qc-seller-name">{{ $this->currentUserName }}</div>
                                        <div class="qc-seller-email">{{ auth()->user()?->email }}</div>
                                    </div>
                                </div>

                                <div class="qc-seller-actions">
                                    <div class="qc-pill">Harita</div>
                                    <div class="qc-pill">Satıcı Profili</div>
                                </div>
                            </div>

                            <div class="qc-publish-wrap">
                                <button
                                    type="button"
                                    class="qc-publish"
                                    wire:click="publishListing"
                                    @disabled($isPublishing)
                                >
                                    {{ $isPublishing ? 'Yayınlanıyor...' : 'İlanı Şimdi Yayınla' }}
                                </button>
                                <button type="button" class="qc-muted-btn" wire:click="goToStep(4)">Geri Dön</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
