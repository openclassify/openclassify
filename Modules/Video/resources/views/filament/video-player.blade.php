@php
    $video = $video ?? null;
    $url = $video?->playableUrl();
@endphp

<div class="space-y-4">
    @if($url)
        <video
            class="w-full rounded-2xl bg-slate-950 max-h-[32rem]"
            controls
            preload="metadata"
            src="{{ $url }}"
            type="{{ $video?->previewMimeType() }}"
        ></video>
    @else
        <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-10 text-center text-sm text-slate-500">
            This video does not have a playable file yet.
        </div>
    @endif

    @if($video)
        <div class="grid gap-3 md:grid-cols-2">
            <div class="rounded-xl border border-slate-200 bg-white px-4 py-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Title</p>
                <p class="mt-1 text-sm font-medium text-slate-800">{{ $video->titleLabel() }}</p>
            </div>
            <div class="rounded-xl border border-slate-200 bg-white px-4 py-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Status</p>
                <p class="mt-1 text-sm font-medium text-slate-800">{{ $video->statusLabel() }}</p>
            </div>
            <div class="rounded-xl border border-slate-200 bg-white px-4 py-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Listing</p>
                <p class="mt-1 text-sm font-medium text-slate-800">{{ $video->listing?->title ?? '-' }}</p>
            </div>
            <div class="rounded-xl border border-slate-200 bg-white px-4 py-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Resolution</p>
                <p class="mt-1 text-sm font-medium text-slate-800">{{ $video->resolutionLabel() }}</p>
            </div>
            <div class="rounded-xl border border-slate-200 bg-white px-4 py-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Duration</p>
                <p class="mt-1 text-sm font-medium text-slate-800">{{ $video->durationLabel() }}</p>
            </div>
            <div class="rounded-xl border border-slate-200 bg-white px-4 py-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Size</p>
                <p class="mt-1 text-sm font-medium text-slate-800">{{ $video->sizeLabel() }}</p>
            </div>
        </div>

        @if(filled($video->description))
            <div class="rounded-xl border border-slate-200 bg-white px-4 py-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Description</p>
                <p class="mt-1 text-sm text-slate-700">{{ $video->description }}</p>
            </div>
        @endif

        @if(filled($video->processing_error))
            <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                {{ $video->processing_error }}
            </div>
        @endif
    @endif
</div>
