@extends('app::layouts.app')
@section('content')
@php
    $totalListings = (int) $listings->total();
    $activeCategoryName = $selectedCategory?->name ? trim((string) $selectedCategory->name) : '';
    $pageTitle = $activeCategoryName !== ''
        ? 'İkinci El '.$activeCategoryName.' İlanları ve Fiyatları'
        : 'İkinci El Araba İlanları ve Fiyatları';
    $canSaveSearch = $search !== '' || ! is_null($categoryId);
    $normalizeQuery = static fn ($value): bool => ! is_null($value) && $value !== '';
    $baseCategoryQuery = array_filter([
        'search' => $search !== '' ? $search : null,
        'country' => $countryId,
        'city' => $cityId,
        'min_price' => $minPriceInput !== '' ? $minPriceInput : null,
        'max_price' => $maxPriceInput !== '' ? $maxPriceInput : null,
        'date_filter' => $dateFilter !== 'all' ? $dateFilter : null,
        'sort' => $sort !== 'smart' ? $sort : null,
    ], $normalizeQuery);
    $clearFiltersQuery = array_filter([
        'search' => $search !== '' ? $search : null,
    ], $normalizeQuery);
@endphp

<style>
    .listing-filter-card {
        border: 1px solid #d7dbe7;
        border-radius: 14px;
        background: #ffffff;
    }

    .listing-card {
        border: 1px solid #d7dbe7;
        border-radius: 12px;
        overflow: hidden;
        background: #ffffff;
        transition: box-shadow .2s ease, transform .2s ease;
    }

    .listing-card:hover {
        box-shadow: 0 16px 32px rgba(22, 29, 57, 0.11);
        transform: translateY(-2px);
    }

    .listing-title {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
    }
</style>

<div class="max-w-[1320px] mx-auto px-4 py-7 lg:py-8">
    <h1 class="text-[30px] leading-tight font-extrabold text-slate-900 mb-6">{{ $pageTitle }}</h1>

    <div class="grid grid-cols-1 lg:grid-cols-[260px,1fr] gap-4 lg:gap-5">
        <aside class="space-y-4">
            <section class="listing-filter-card p-4">
                <div class="flex items-center justify-between gap-3 mb-3">
                    <h2 class="text-[26px] font-extrabold text-slate-900 leading-none">Kategoriler</h2>
                </div>

                <div class="space-y-1 max-h-[330px] overflow-y-auto pr-1">
                    @php
                        $allCategoriesLink = route('listings.index', $baseCategoryQuery);
                    @endphp
                    <a href="{{ $allCategoriesLink }}" class="flex items-center justify-between rounded-lg px-2.5 py-2 text-sm font-semibold {{ is_null($categoryId) ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-100' }}">
                        <span>Tüm İlanlar</span>
                        <span>{{ number_format($totalListings, 0, ',', '.') }}</span>
                    </a>

                    @foreach($categories as $category)
                        @php
                            $childCount = (int) $category->children->sum('active_listings_count');
                            $categoryCount = (int) $category->active_listings_count + $childCount;
                            $isSelectedParent = (int) $categoryId === (int) $category->id;
                            $categoryUrl = route('listings.index', array_filter(array_merge($baseCategoryQuery, [
                                'category' => $category->id,
                            ]), $normalizeQuery));
                        @endphp
                        <a href="{{ $categoryUrl }}" class="flex items-center justify-between rounded-lg px-2.5 py-2 text-sm font-semibold {{ $isSelectedParent ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-100' }}">
                            <span>{{ $category->name }}</span>
                            <span>{{ number_format($categoryCount, 0, ',', '.') }}</span>
                        </a>

                        @foreach($category->children as $childCategory)
                            @php
                                $isSelectedChild = (int) $categoryId === (int) $childCategory->id;
                                $childUrl = route('listings.index', array_filter(array_merge($baseCategoryQuery, [
                                    'category' => $childCategory->id,
                                ]), $normalizeQuery));
                            @endphp
                            <a href="{{ $childUrl }}" class="ml-2 flex items-center justify-between rounded-lg px-2 py-1.5 text-[13px] font-medium {{ $isSelectedChild ? 'bg-rose-50 text-rose-600' : 'text-slate-600 hover:bg-slate-100' }}">
                                <span>{{ $childCategory->name }}</span>
                                <span>{{ number_format((int) $childCategory->active_listings_count, 0, ',', '.') }}</span>
                            </a>
                        @endforeach
                    @endforeach
                </div>
            </section>

            <form method="GET" action="{{ route('listings.index') }}" class="listing-filter-card p-4 space-y-5">
                @if($search !== '')
                    <input type="hidden" name="search" value="{{ $search }}">
                @endif
                @if($categoryId)
                    <input type="hidden" name="category" value="{{ $categoryId }}">
                @endif
                <input type="hidden" name="sort" value="{{ $sort }}">

                <section>
                    <h3 class="text-base font-extrabold text-slate-900 mb-3">Konum</h3>
                    <div class="space-y-2.5">
                        @php
                            $citiesRouteTemplate = \Illuminate\Support\Facades\Route::has('locations.cities')
                                ? route('locations.cities', ['country' => '__COUNTRY__'], false)
                                : '';
                        @endphp
                        <select
                            name="country"
                            data-listing-country
                            data-cities-url-template="{{ $citiesRouteTemplate }}"
                            class="w-full h-10 rounded-lg border border-slate-300 bg-slate-50 px-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-rose-200"
                        >
                            <option value="">İl seçin</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" @selected((int) $countryId === (int) $country->id)>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>

                        <select name="city" data-listing-city class="w-full h-10 rounded-lg border border-slate-300 bg-slate-50 px-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-rose-200" @disabled(!$countryId)>
                            <option value="">{{ $countryId ? 'İlçe seçin' : 'Önce il seçin' }}</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" @selected((int) $cityId === (int) $city->id)>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>

                        <button type="button" data-use-current-location class="w-full h-10 rounded-lg border border-slate-300 bg-white text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                            Mevcut konumu kullan
                        </button>
                    </div>
                </section>

                <section>
                    <h3 class="text-base font-extrabold text-slate-900 mb-3">Fiyat</h3>
                    <div class="grid grid-cols-2 gap-2">
                        <input type="number" name="min_price" value="{{ $minPriceInput }}" min="0" step="1" placeholder="Min" class="h-10 rounded-lg border border-slate-300 bg-slate-50 px-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-rose-200">
                        <input type="number" name="max_price" value="{{ $maxPriceInput }}" min="0" step="1" placeholder="Maks" class="h-10 rounded-lg border border-slate-300 bg-slate-50 px-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-rose-200">
                    </div>
                </section>

                <section>
                    <h3 class="text-base font-extrabold text-slate-900 mb-3">İlan Tarihi</h3>
                    <div class="space-y-2 text-sm text-slate-700">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="date_filter" value="all" class="accent-rose-500" @checked($dateFilter === 'all')>
                            <span>Tümü</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="date_filter" value="today" class="accent-rose-500" @checked($dateFilter === 'today')>
                            <span>Bugün</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="date_filter" value="week" class="accent-rose-500" @checked($dateFilter === 'week')>
                            <span>Son 7 Gün</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="date_filter" value="month" class="accent-rose-500" @checked($dateFilter === 'month')>
                            <span>Son 30 Gün</span>
                        </label>
                    </div>
                </section>

                <div class="flex items-center gap-2">
                    <a href="{{ route('listings.index', $clearFiltersQuery) }}" class="flex-1 h-10 inline-flex items-center justify-center rounded-full border border-rose-300 text-rose-500 text-sm font-semibold hover:bg-rose-50 transition">
                        Temizle
                    </a>
                    <button type="submit" class="flex-1 h-10 rounded-full bg-rose-500 text-white text-sm font-semibold hover:bg-rose-600 transition">
                        Uygula
                    </button>
                </div>
            </form>
        </aside>

        <section class="space-y-4">
            <div class="listing-filter-card px-4 py-3 flex flex-col xl:flex-row xl:items-center gap-3">
                <p class="text-sm text-slate-700 mr-auto">
                    {{ $activeCategoryName !== '' ? 'İkinci El '.$activeCategoryName.' kategorisinde' : 'İkinci El Araba kategorisinde' }}
                    <strong>{{ number_format($totalListings, 0, ',', '.') }}</strong>
                    ilan bulundu
                </p>
                <div class="flex flex-wrap items-center gap-2">
                    @auth
                        <form method="POST" action="{{ route('favorites.searches.store') }}">
                            @csrf
                            <input type="hidden" name="search" value="{{ $search }}">
                            <input type="hidden" name="category_id" value="{{ $categoryId }}">
                            <button type="submit" class="h-10 px-4 rounded-full border text-sm font-semibold transition {{ $isCurrentSearchSaved ? 'bg-emerald-100 border-emerald-200 text-emerald-700 cursor-default' : ($canSaveSearch ? 'bg-rose-50 border-rose-200 text-rose-600 hover:bg-rose-100' : 'bg-slate-100 border-slate-200 text-slate-400 cursor-not-allowed') }}" @disabled($isCurrentSearchSaved || ! $canSaveSearch)>
                                {{ $isCurrentSearchSaved ? 'Arama Kaydedildi' : 'Arama Kaydet' }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="h-10 px-4 inline-flex items-center rounded-full border border-slate-300 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">
                            Arama Kaydet
                        </a>
                    @endauth

                    <form method="GET" action="{{ route('listings.index') }}">
                        @if($search !== '')
                            <input type="hidden" name="search" value="{{ $search }}">
                        @endif
                        @if($categoryId)
                            <input type="hidden" name="category" value="{{ $categoryId }}">
                        @endif
                        @if($countryId)
                            <input type="hidden" name="country" value="{{ $countryId }}">
                        @endif
                        @if($cityId)
                            <input type="hidden" name="city" value="{{ $cityId }}">
                        @endif
                        @if($minPriceInput !== '')
                            <input type="hidden" name="min_price" value="{{ $minPriceInput }}">
                        @endif
                        @if($maxPriceInput !== '')
                            <input type="hidden" name="max_price" value="{{ $maxPriceInput }}">
                        @endif
                        @if($dateFilter !== 'all')
                            <input type="hidden" name="date_filter" value="{{ $dateFilter }}">
                        @endif

                        <label class="h-10 px-4 rounded-full border border-slate-300 bg-white inline-flex items-center gap-2 text-sm font-semibold text-slate-700">
                            <span>Akıllı Sıralama</span>
                            <select name="sort" class="bg-transparent text-sm font-semibold focus:outline-none" onchange="this.form.submit()">
                                <option value="smart" @selected($sort === 'smart')>Önerilen</option>
                                <option value="newest" @selected($sort === 'newest')>En Yeni</option>
                                <option value="oldest" @selected($sort === 'oldest')>En Eski</option>
                                <option value="price_asc" @selected($sort === 'price_asc')>Fiyat Artan</option>
                                <option value="price_desc" @selected($sort === 'price_desc')>Fiyat Azalan</option>
                            </select>
                        </label>
                    </form>
                </div>
            </div>

            @if($listings->isEmpty())
                <div class="listing-filter-card py-14 text-center text-slate-500">
                    Bu filtreye uygun ilan bulunamadı.
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-3.5">
                    @foreach($listings as $listing)
                        @php
                            $listingImage = $listing->getFirstMediaUrl('listing-images');
                            $isFavorited = in_array($listing->id, $favoriteListingIds ?? [], true);
                            $priceValue = ! is_null($listing->price) ? (float) $listing->price : null;
                            $locationParts = array_filter([
                                trim((string) ($listing->city ?? '')),
                                trim((string) ($listing->country ?? '')),
                            ], fn ($value) => $value !== '');
                            $locationText = implode(', ', $locationParts);
                        @endphp
                        <article class="listing-card">
                            <div class="relative h-52 bg-slate-200">
                                @if($listingImage)
                                    <a href="{{ route('listings.show', $listing) }}" class="block w-full h-full">
                                        <img src="{{ $listingImage }}" alt="{{ $listing->title }}" class="w-full h-full object-cover">
                                    </a>
                                @else
                                    <a href="{{ route('listings.show', $listing) }}" class="w-full h-full grid place-items-center text-slate-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.6-4.6a2 2 0 012.8 0L16 16m-2-2 1.6-1.6a2 2 0 012.8 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </a>
                                @endif

                                @if($listing->is_featured)
                                    <span class="absolute top-2 left-2 inline-flex items-center rounded-full bg-yellow-300 text-slate-900 text-[11px] font-bold px-2.5 py-1">
                                        Öne Çıkan
                                    </span>
                                @endif

                                <div class="absolute top-2 right-2">
                                    @auth
                                        <form method="POST" action="{{ route('favorites.listings.toggle', $listing) }}">
                                            @csrf
                                            <button type="submit" class="w-8 h-8 rounded-full grid place-items-center transition {{ $isFavorited ? 'bg-rose-500 text-white' : 'bg-white text-slate-500 hover:text-rose-500' }}" aria-label="Favoriye ekle">
                                                ♥
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="w-8 h-8 rounded-full bg-white text-slate-500 hover:text-rose-500 grid place-items-center transition" aria-label="Giriş yap">
                                            ♥
                                        </a>
                                    @endauth
                                </div>
                            </div>

                            <div class="px-3.5 py-3">
                                <a href="{{ route('listings.show', $listing) }}" class="block">
                                    <p class="text-[29px] leading-none font-extrabold text-slate-900">
                                        @if(!is_null($priceValue) && $priceValue > 0)
                                            {{ number_format($priceValue, 0, ',', '.') }} {{ $listing->currency }}
                                        @else
                                            Ücretsiz
                                        @endif
                                    </p>
                                    <h3 class="listing-title mt-2 text-sm font-semibold text-slate-900">
                                        {{ $listing->title }}
                                    </h3>
                                </a>

                                <p class="text-xs text-slate-500 mt-2">
                                    {{ $listing->category?->name ?: 'Kategori yok' }}
                                </p>

                                <div class="mt-3 pt-2 border-t border-slate-100 flex items-center justify-between gap-2 text-[12px] text-slate-500">
                                    <span class="truncate">{{ $locationText !== '' ? $locationText : 'Konum belirtilmedi' }}</span>
                                    <span class="shrink-0">{{ $listing->created_at?->format('d.m.Y') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

            <div class="pt-2">
                {{ $listings->links() }}
            </div>
        </section>
    </div>
</div>

<script>
    (() => {
        const countrySelect = document.querySelector('[data-listing-country]');
        const citySelect = document.querySelector('[data-listing-city]');
        const currentLocationButton = document.querySelector('[data-use-current-location]');
        const citiesTemplate = countrySelect?.dataset.citiesUrlTemplate ?? '';
        const locationStorageKey = 'oc2.header.location';

        if (!countrySelect || !citySelect || citiesTemplate === '') {
            return;
        }

        const normalize = (value) => (value ?? '')
            .toString()
            .toLocaleLowerCase('tr-TR')
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .trim();

        const setCityOptions = (cities, selectedCityName = '') => {
            citySelect.innerHTML = '<option value="">İlçe seçin</option>';
            cities.forEach((city) => {
                const option = document.createElement('option');
                option.value = String(city.id ?? '');
                option.textContent = city.name ?? '';
                option.dataset.name = city.name ?? '';
                citySelect.appendChild(option);
            });
            citySelect.disabled = false;

            if (selectedCityName) {
                const matched = Array.from(citySelect.options).find((option) => normalize(option.dataset.name) === normalize(selectedCityName));
                if (matched) {
                    citySelect.value = matched.value;
                }
            }
        };

        const fetchCityOptions = async (url) => {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            });

            if (!response.ok) {
                throw new Error('city_fetch_failed');
            }

            const payload = await response.json();

            if (Array.isArray(payload)) {
                return payload;
            }

            return Array.isArray(payload?.data) ? payload.data : [];
        };

        const loadCities = async (countryId, selectedCityName = '') => {
            if (!countryId) {
                citySelect.innerHTML = '<option value="">Önce il seçin</option>';
                citySelect.disabled = true;
                return;
            }

            citySelect.disabled = true;
            citySelect.innerHTML = '<option value="">İlçeler yükleniyor...</option>';

            const primaryUrl = citiesTemplate.replace('__COUNTRY__', encodeURIComponent(String(countryId)));

            try {
                let cities = [];

                try {
                    cities = await fetchCityOptions(primaryUrl);
                } catch (primaryError) {
                    if (!/^https?:\/\//i.test(primaryUrl)) {
                        throw primaryError;
                    }

                    let fallbackUrl = null;

                    try {
                        const parsed = new URL(primaryUrl);
                        fallbackUrl = `${parsed.pathname}${parsed.search}`;
                    } catch (urlError) {
                        fallbackUrl = null;
                    }

                    if (!fallbackUrl) {
                        throw primaryError;
                    }

                    cities = await fetchCityOptions(fallbackUrl);
                }

                setCityOptions(cities, selectedCityName);
            } catch (error) {
                citySelect.innerHTML = '<option value="">İlçeler yüklenemedi</option>';
                citySelect.disabled = true;
            }
        };

        countrySelect.addEventListener('change', () => {
            citySelect.value = '';
            void loadCities(countrySelect.value);
        });

        currentLocationButton?.addEventListener('click', async () => {
            try {
                const rawLocation = localStorage.getItem(locationStorageKey);
                if (!rawLocation) {
                    return;
                }

                const parsedLocation = JSON.parse(rawLocation);
                const countryName = parsedLocation?.countryName ?? '';
                const cityName = parsedLocation?.cityName ?? '';
                const countryId = parsedLocation?.countryId ? String(parsedLocation.countryId) : null;

                const matchedCountryOption = Array.from(countrySelect.options).find((option) => {
                    if (countryId && option.value === countryId) {
                        return true;
                    }

                    return normalize(option.textContent) === normalize(countryName);
                });

                if (!matchedCountryOption) {
                    return;
                }

                countrySelect.value = matchedCountryOption.value;
                await loadCities(matchedCountryOption.value, cityName);
            } catch (error) {
                // no-op
            }
        });
    })();
</script>
@endsection
