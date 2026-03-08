@php
    $categoryCount = $categories->count();
@endphp

<div class="max-w-[1320px] mx-auto px-4 py-5 md:py-7 space-y-7">
    <section class="space-y-4">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 md:text-3xl">All categories</h2>
                <p class="mt-1 text-sm text-slate-500 md:text-base">A single directory view with the same spacing and chrome used across the frontend.</p>
            </div>
            <p class="text-sm font-medium text-slate-500">{{ number_format($categoryCount, 0, '.', ',') }} categories</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            @foreach($categories as $category)
            @php
                $childNames = $category->children
                    ->take(3)
                    ->pluck('name')
                    ->filter()
                    ->implode(' · ');
                $extraChildCount = max($category->children->count() - 3, 0);
                $iconUrl = $category->iconUrl();
                $iconLabel = strtoupper(\Illuminate\Support\Str::substr($category->name, 0, 1));
            @endphp
            <a
                href="{{ route('listings.index', ['category' => $category->id]) }}"
                class="group flex h-full flex-col rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-lg"
            >
                <div class="flex items-start justify-between gap-4">
                    <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 text-slate-900 shadow-sm">
                        @if($iconUrl)
                        <img src="{{ $iconUrl }}" alt="{{ $category->name }}" class="h-11 w-11 object-contain">
                        @else
                        <span class="text-3xl font-semibold">{{ $iconLabel }}</span>
                        @endif
                    </span>
                    <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-600">
                        {{ number_format($category->children->count(), 0, '.', ',') }} subcategories
                    </span>
                </div>

                <div class="mt-6 space-y-3">
                    <h3 class="text-2xl font-extrabold tracking-tight text-slate-950 transition group-hover:text-blue-700">
                        {{ $category->name }}
                    </h3>
                    <p class="text-sm leading-6 text-slate-600">
                        {{ $childNames !== '' ? $childNames : 'Open this category to browse available listings and subcategories.' }}
                        @if($extraChildCount > 0)
                        <span class="font-semibold text-slate-900">+{{ $extraChildCount }} more</span>
                        @endif
                    </p>
                </div>

                <div class="mt-auto pt-6">
                    <span class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700">
                        Explore category
                        <svg class="h-4 w-4 transition group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 6l6 6-6 6"/>
                        </svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </section>
</div>
