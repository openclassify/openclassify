<?php

declare(strict_types=1);

namespace Modules\Video;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\View\View;

final class VideoPlugin implements Plugin
{
    public function getId(): string
    {
        return 'video';
    }

    public static function make(): static
    {
        return app(self::class);
    }

    public function register(Panel $panel): void
    {
        $panel
            ->discoverResources(
                in: module_path('Video', 'Filament/Admin/Resources'),
                for: 'Modules\\Video\\Filament\\Admin\\Resources',
            )
            ->renderHook(
                PanelsRenderHook::BODY_END,
                fn (): View => view('video::partials.video-upload-optimizer'),
            );
    }

    public function boot(Panel $panel): void {}
}
