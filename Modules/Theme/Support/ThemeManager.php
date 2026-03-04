<?php

namespace Modules\Theme\Support;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class ThemeManager
{
    public function __construct(private Repository $config)
    {
    }

    public function activeTheme(string $module): string
    {
        $moduleKey = Str::lower($module);
        $moduleSpecific = $this->config->get("theme.modules.{$moduleKey}");

        if (is_string($moduleSpecific) && $moduleSpecific !== '') {
            return Str::lower($moduleSpecific);
        }

        $global = $this->config->get('theme.active', 'default');

        if (! is_string($global) || $global === '') {
            return 'default';
        }

        return Str::lower($global);
    }

    public function view(string $module, string $name): string
    {
        $moduleKey = Str::lower($module);
        $activeTheme = $this->activeTheme($moduleKey);

        $primary = "{$moduleKey}::themes.{$activeTheme}.{$name}";
        if (View::exists($primary)) {
            return $primary;
        }

        $defaultTheme = "{$moduleKey}::themes.default.{$name}";
        if (View::exists($defaultTheme)) {
            return $defaultTheme;
        }

        return "{$moduleKey}::{$name}";
    }
}
