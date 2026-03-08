<?php

namespace Modules\Listing\Support;

use Illuminate\Support\Str;

final class DemoListingImageFactory
{
    private const PALETTES = [
        ['#0f172a', '#1d4ed8', '#dbeafe'],
        ['#172554', '#2563eb', '#dbeafe'],
        ['#0f3b2e', '#059669', '#d1fae5'],
        ['#3f2200', '#ea580c', '#ffedd5'],
        ['#3b0764', '#9333ea', '#f3e8ff'],
        ['#3f3f46', '#e11d48', '#ffe4e6'],
        ['#0b3b66', '#0891b2', '#cffafe'],
        ['#422006', '#ca8a04', '#fef3c7'],
    ];

    public static function ensure(
        string $slug,
        string $title,
        string $categoryName,
        string $ownerName,
        int $seed
    ): string {
        $directory = public_path('generated/demo-listings');

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filePath = $directory.'/'.Str::slug($slug).'.svg';
        $palette = self::PALETTES[$seed % count(self::PALETTES)];
        [$baseColor, $accentColor, $surfaceColor] = $palette;

        $shortTitle = self::escape(Str::limit($title, 36, ''));
        $shortCategory = self::escape(Str::limit($categoryName, 18, ''));
        $shortOwner = self::escape(Str::limit($ownerName, 18, ''));
        $code = self::escape(strtoupper(Str::substr(md5($slug), 0, 6)));

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1600" height="1200" viewBox="0 0 1600 1200" fill="none">
  <defs>
    <linearGradient id="bg" x1="120" y1="80" x2="1480" y2="1120" gradientUnits="userSpaceOnUse">
      <stop stop-color="{$baseColor}"/>
      <stop offset="1" stop-color="{$accentColor}"/>
    </linearGradient>
    <linearGradient id="glass" x1="320" y1="220" x2="1200" y2="920" gradientUnits="userSpaceOnUse">
      <stop stop-color="white" stop-opacity="0.95"/>
      <stop offset="1" stop-color="{$surfaceColor}" stop-opacity="0.86"/>
    </linearGradient>
  </defs>
  <rect width="1600" height="1200" rx="64" fill="url(#bg)"/>
  <circle cx="1320" cy="230" r="170" fill="white" fill-opacity="0.08"/>
  <circle cx="240" cy="1010" r="220" fill="white" fill-opacity="0.06"/>
  <rect x="170" y="146" width="1260" height="908" rx="58" fill="url(#glass)" stroke="white" stroke-opacity="0.22" stroke-width="6"/>
  <rect x="260" y="248" width="420" height="700" rx="44" fill="{$baseColor}" fill-opacity="0.94"/>
  <rect x="740" y="248" width="520" height="200" rx="34" fill="white" fill-opacity="0.72"/>
  <rect x="740" y="490" width="520" height="210" rx="34" fill="white" fill-opacity="0.52"/>
  <rect x="740" y="742" width="240" height="180" rx="30" fill="white" fill-opacity="0.58"/>
  <rect x="1020" y="742" width="240" height="180" rx="30" fill="white" fill-opacity="0.32"/>
  <rect x="340" y="338" width="260" height="260" rx="130" fill="white" fill-opacity="0.12"/>
  <rect x="830" y="310" width="230" height="38" rx="19" fill="{$accentColor}" fill-opacity="0.16"/>
  <rect x="830" y="548" width="340" height="26" rx="13" fill="{$baseColor}" fill-opacity="0.12"/>
  <rect x="830" y="596" width="260" height="26" rx="13" fill="{$baseColor}" fill-opacity="0.08"/>
  <text x="262" y="214" fill="white" fill-opacity="0.92" font-family="Arial, Helvetica, sans-serif" font-size="40" font-weight="700" letter-spacing="10">OPENCLASSIFY DEMO</text>
  <text x="258" y="760" fill="white" font-family="Arial, Helvetica, sans-serif" font-size="86" font-weight="700">{$shortCategory}</text>
  <text x="258" y="840" fill="white" fill-opacity="0.78" font-family="Arial, Helvetica, sans-serif" font-size="44" font-weight="500">{$shortOwner}</text>
  <text x="818" y="390" fill="{$baseColor}" font-family="Arial, Helvetica, sans-serif" font-size="72" font-weight="700">{$shortTitle}</text>
  <text x="818" y="474" fill="{$accentColor}" font-family="Arial, Helvetica, sans-serif" font-size="34" font-weight="700" letter-spacing="8">{$code}</text>
</svg>
SVG;

        file_put_contents($filePath, $svg);

        return $filePath;
    }

    private static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_XML1, 'UTF-8');
    }
}
