@extends('app::layouts.app')

@section('title', 'Edit Video')

@section('content')
<div class="max-w-[1320px] mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[220px,1fr] gap-4">
        @include('panel::partials.sidebar', ['activeMenu' => 'videos'])

        <section class="space-y-4">
            <div class="panel-surface p-6">
                <div class="flex flex-col gap-1 mb-5">
                    <h1 class="text-2xl font-semibold text-slate-900">Edit Video</h1>
                    <p class="text-sm text-slate-500">Update listing assignment, title, status, or replace the source file.</p>
                </div>

                @if (session('success'))
                    <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('panel.videos.update', $video) }}" enctype="multipart/form-data" class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                    @csrf
                    @method('PUT')

                    <label class="block">
                        <span class="mb-2 block text-sm font-medium text-slate-700">Listing</span>
                        <select name="listing_id" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 focus:border-slate-400 focus:outline-none">
                            @foreach($listingOptions as $listingOption)
                                <option value="{{ $listingOption->id }}" @selected((int) old('listing_id', $video->listing_id) === (int) $listingOption->id)>
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
                        <input type="text" name="title" value="{{ old('title', $video->title) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 focus:border-slate-400 focus:outline-none">
                        @error('title')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="block xl:col-span-2">
                        <span class="mb-2 block text-sm font-medium text-slate-700">Description</span>
                        <textarea name="description" rows="4" class="w-full rounded-3xl border border-slate-300 px-4 py-3 text-sm text-slate-800 focus:border-slate-400 focus:outline-none">{{ old('description', $video->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="block xl:col-span-2">
                        <span class="mb-2 block text-sm font-medium text-slate-700">Replace file</span>
                        <input type="file" name="video_file" accept="video/mp4,video/quicktime,video/webm,video/x-m4v,.mp4,.mov,.webm,.m4v" class="block w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 file:mr-3 file:rounded-full file:border-0 file:bg-slate-100 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-slate-700">
                        @error('video_file')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="inline-flex items-center gap-3">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $video->is_active)) class="h-5 w-5 rounded border-slate-300 text-slate-900 focus:ring-slate-400">
                        <span class="text-sm font-medium text-slate-700">Visible on listing page</span>
                    </label>

                    <div class="flex flex-wrap items-center gap-3 xl:col-span-2">
                        <button type="submit" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                            Save changes
                        </button>
                        <a href="{{ route('panel.videos.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            Back to videos
                        </a>
                    </div>
                </form>
            </div>

            <div class="panel-surface p-6">
                <div class="grid grid-cols-1 xl:grid-cols-[1fr,320px] gap-6 items-start">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Current file</h2>
                        <div class="mt-4 rounded-3xl border border-slate-200 bg-slate-100 p-4">
                            @if($video->playableUrl())
                                <video controls preload="metadata" class="w-full rounded-2xl bg-black">
                                    <source src="{{ $video->playableUrl() }}" type="{{ $video->previewMimeType() }}">
                                </video>
                            @else
                                <div class="grid min-h-48 place-items-center rounded-2xl border border-dashed border-slate-300 bg-white text-sm text-slate-500">
                                    Video preview is not available yet.
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5 text-sm text-slate-600">
                        <dl class="space-y-3">
                            <div class="flex items-center justify-between gap-4">
                                <dt>Status</dt>
                                <dd class="font-semibold text-slate-900">{{ $video->statusLabel() }}</dd>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <dt>Duration</dt>
                                <dd class="font-semibold text-slate-900">{{ $video->durationLabel() }}</dd>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <dt>Resolution</dt>
                                <dd class="font-semibold text-slate-900">{{ $video->resolutionLabel() }}</dd>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <dt>Size</dt>
                                <dd class="font-semibold text-slate-900">{{ $video->sizeLabel() }}</dd>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <dt>Listing</dt>
                                <dd class="font-semibold text-slate-900 text-right">{{ $video->listing?->title ?? '-' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
