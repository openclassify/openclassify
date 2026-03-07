@php
    $video = $video ?? null;
    $url = $video?->playableUrl();
    $statusColor = match ($video?->statusColor()) {
        'success' => 'bg-emerald-100 text-emerald-700',
        'info' => 'bg-sky-100 text-sky-700',
        'danger' => 'bg-rose-100 text-rose-700',
        default => 'bg-amber-100 text-amber-700',
    };
@endphp

<div class="space-y-3">
    <div class="flex flex-wrap items-center gap-2">
        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $statusColor }}">
            {{ $video?->statusLabel() ?? 'New' }}
        </span>

        @if($video && ($video->resolutionLabel() !== '-'))
            <span class="text-xs text-slate-500">{{ $video->resolutionLabel() }}</span>
        @endif

        @if($video && ($video->durationLabel() !== '-'))
            <span class="text-xs text-slate-500">{{ $video->durationLabel() }}</span>
        @endif

        @if($video && ($video->sizeLabel() !== '-'))
            <span class="text-xs text-slate-500">{{ $video->sizeLabel() }}</span>
        @endif
    </div>

    @if($url)
        <video
            class="w-full rounded-xl bg-slate-950 max-h-80"
            controls
            preload="metadata"
            src="{{ $url }}"
            type="{{ $video?->previewMimeType() }}"
        ></video>
    @else
        <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-6 text-sm text-slate-500">
            Preview will appear after the first upload.
        </div>
    @endif

    @if($video && filled($video->processing_error))
        <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
            {{ $video->processing_error }}
        </div>
    @endif
</div>
