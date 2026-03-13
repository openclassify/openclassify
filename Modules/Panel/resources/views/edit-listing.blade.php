@extends('app::layouts.app')

@section('title', 'Edit Listing')

@section('content')
<div class="max-w-[1320px] mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[220px,1fr] gap-4">
        @include('panel::partials.sidebar', ['activeMenu' => 'listings'])

        <section class="space-y-4">
            <div class="panel-surface p-6">
                <div class="flex flex-col gap-1 mb-5">
                    <h1 class="text-2xl font-semibold text-slate-900">Edit Listing</h1>
                    <p class="text-sm text-slate-500">Update the core listing details without leaving the frontend panel.</p>
                </div>

                @if (session('success'))
                    <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('panel.listings.update', $listing) }}" class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                    @csrf
                    @method('PUT')

                    <label class="block xl:col-span-2">
                        <span class="mb-2 block text-sm font-medium text-slate-700">Title</span>
                        <input type="text" name="title" value="{{ old('title', $listing->title) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 focus:border-slate-400 focus:outline-none">
                        @error('title')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="block xl:col-span-2">
                        <span class="mb-2 block text-sm font-medium text-slate-700">Description</span>
                        <textarea name="description" rows="6" class="w-full rounded-3xl border border-slate-300 px-4 py-3 text-sm text-slate-800 focus:border-slate-400 focus:outline-none">{{ old('description', $listing->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-medium text-slate-700">Price</span>
                        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $listing->price) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 focus:border-slate-400 focus:outline-none">
                        @error('price')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-medium text-slate-700">Status</span>
                        <select name="status" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 focus:border-slate-400 focus:outline-none">
                            @foreach($statusOptions as $value => $label)
                                <option value="{{ $value }}" @selected(old('status', $listing->statusValue()) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-medium text-slate-700">Email</span>
                        <input type="email" name="contact_email" value="{{ old('contact_email', $listing->contact_email) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 focus:border-slate-400 focus:outline-none">
                        @error('contact_email')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-medium text-slate-700">Phone</span>
                        <input type="text" name="contact_phone" value="{{ old('contact_phone', $listing->contact_phone) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 focus:border-slate-400 focus:outline-none">
                        @error('contact_phone')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-medium text-slate-700">Country</span>
                        <input type="text" name="country" value="{{ old('country', $listing->country) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 focus:border-slate-400 focus:outline-none">
                        @error('country')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-medium text-slate-700">City</span>
                        <input type="text" name="city" value="{{ old('city', $listing->city) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 focus:border-slate-400 focus:outline-none">
                        @error('city')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-medium text-slate-700">Expires at</span>
                        <input type="date" name="expires_at" value="{{ old('expires_at', $listing->expires_at?->format('Y-m-d')) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 focus:border-slate-400 focus:outline-none">
                        @error('expires_at')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <div class="xl:col-span-2 flex flex-wrap items-center gap-3">
                        <button type="submit" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                            Save changes
                        </button>
                        <a href="{{ route('panel.videos.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            Manage videos
                        </a>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-[1.2fr,0.8fr] gap-4">
                <div class="panel-surface p-6">
                    <h2 class="text-lg font-semibold text-slate-900">Photos</h2>
                    <div class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-3">
                        @forelse($listing->getMedia('listing-images') as $media)
                            <img src="{{ $media->getUrl() }}" alt="{{ $listing->title }}" class="h-32 w-full rounded-2xl object-cover">
                        @empty
                            <div class="col-span-full rounded-3xl border border-dashed border-slate-300 px-6 py-12 text-center text-sm text-slate-500">
                                No photos on this listing.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="panel-surface p-6 space-y-5">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Listing info</h2>
                        <dl class="mt-4 space-y-3 text-sm text-slate-600">
                            <div class="flex items-start justify-between gap-4">
                                <dt>Category</dt>
                                <dd class="text-right font-semibold text-slate-900">{{ $listing->category?->name ?? '-' }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Status</dt>
                                <dd class="text-right font-semibold text-slate-900">{{ $listing->statusLabel() }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Videos</dt>
                                <dd class="text-right font-semibold text-slate-900">{{ $listing->videos->count() }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-[0.16em] text-slate-400">Custom fields</h3>
                        <div class="mt-3 space-y-2">
                            @forelse($customFieldValues as $field)
                                <div class="rounded-2xl bg-slate-50 px-4 py-3">
                                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">{{ $field['label'] }}</p>
                                    <p class="mt-1 text-sm font-medium text-slate-800">{{ $field['value'] }}</p>
                                </div>
                            @empty
                                <p class="text-sm text-slate-500">No category-specific fields stored on this listing.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
