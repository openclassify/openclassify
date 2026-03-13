@extends('app::layouts.app')

@section('title', 'Videos')

@section('content')
<div class="max-w-[1320px] mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[220px,1fr] gap-4">
        @include('panel::partials.sidebar', ['activeMenu' => 'videos'])

        <section class="space-y-4">
            @include('panel::partials.page-header', [
                'title' => 'Videos',
                'description' => 'Upload listing videos and manage processing from one frontend workspace.',
            ])

            <div class="panel-surface p-6">
                @if (session('success'))
                    <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('panel.videos.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 xl:grid-cols-[1.1fr,1.1fr,0.8fr,auto] gap-3 items-end">
                    @csrf
                    <label class="block">
                        <span class="mb-2 block text-sm font-medium text-slate-700">Listing</span>
                        <select name="listing_id" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 focus:border-slate-400 focus:outline-none">
                            <option value="">Select listing</option>
                            @foreach($listingOptions as $listingOption)
                                <option value="{{ $listingOption->id }}" @selected((int) old('listing_id') === (int) $listingOption->id)>
                                    {{ $listingOption->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('listing_id')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-medium text-slate-700">Title</span>
                        <input type="text" name="title" value="{{ old('title') }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 focus:border-slate-400 focus:outline-none" placeholder="Short video title">
                        @error('title')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-medium text-slate-700">Video file</span>
                        <input type="file" name="video_file" accept="video/mp4,video/quicktime,video/webm,video/x-m4v,.mp4,.mov,.webm,.m4v" class="block w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 file:mr-3 file:rounded-full file:border-0 file:bg-slate-100 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-slate-700">
                        @error('video_file')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <button type="submit" class="inline-flex h-[52px] items-center justify-center rounded-full bg-slate-900 px-6 text-sm font-semibold text-white transition hover:bg-slate-800">
                        Upload
                    </button>
                </form>
            </div>

            <div class="panel-surface overflow-hidden">
                <div class="border-b border-slate-200 px-6 py-4">
                    <h2 class="text-lg font-semibold text-slate-900">My videos</h2>
                </div>

                <div class="divide-y divide-slate-200">
                    @forelse($videos as $video)
                        @php
                            $statusClass = match ((string) $video->status?->value) {
                                'ready' => 'bg-emerald-100 text-emerald-700',
                                'failed' => 'bg-rose-100 text-rose-700',
                                'processing' => 'bg-sky-100 text-sky-700',
                                default => 'bg-amber-100 text-amber-700',
                            };
                        @endphp
                        <article class="grid grid-cols-1 gap-4 px-6 py-5 xl:grid-cols-[minmax(0,1fr),auto] xl:items-center">
                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="text-base font-semibold text-slate-900">{{ $video->titleLabel() }}</h3>
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">{{ $video->statusLabel() }}</span>
                                    @if($video->is_active)
                                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">Visible</span>
                                    @endif
                                </div>
                                <p class="mt-2 text-sm text-slate-500">{{ $video->listing?->title ?? 'Listing removed' }}</p>
                                <div class="mt-3 flex flex-wrap items-center gap-4 text-sm text-slate-500">
                                    <span>Duration: {{ $video->durationLabel() }}</span>
                                    <span>Size: {{ $video->sizeLabel() }}</span>
                                    <span>Updated: {{ $video->updated_at?->format('d.m.Y H:i') ?? '-' }}</span>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-2 xl:justify-end">
                                <a href="{{ route('panel.videos.edit', $video) }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('panel.videos.destroy', $video) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center rounded-full border border-rose-200 px-4 py-2 text-sm font-semibold text-rose-600 transition hover:bg-rose-50">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </article>
                    @empty
                        <div class="px-6 py-16 text-center text-slate-500">
                            No videos yet.
                        </div>
                    @endforelse
                </div>

                @if($videos->hasPages())
                    <div class="border-t border-slate-200 px-6 py-4">
                        {{ $videos->links() }}
                    </div>
                @endif
            </div>
        </section>
    </div>
</div>
@endsection
