@props([
    'kicker' => 'Panel',
    'title',
    'description' => null,
    'actions' => null,
])

<div class="panel-surface p-6">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div class="min-w-0">
            <p class="text-[0.68rem] font-semibold uppercase tracking-[0.26em] text-slate-400">{{ $kicker }}</p>
            <h1 class="mt-2 text-[2.1rem] font-semibold leading-tight tracking-[-0.04em] text-slate-950">{{ $title }}</h1>
            @if (filled($description))
                <p class="mt-3 max-w-3xl text-sm leading-6 text-slate-500">{{ $description }}</p>
            @endif
        </div>

        @if ($actions)
            <div class="flex shrink-0 flex-wrap items-center gap-3">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>
