<?php

namespace Modules\Listing\Support;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class ListingImageViewData
{
    private const CONTEXTS = [
        'card' => ['mobile' => 'card-mobile', 'desktop' => 'card-desktop'],
        'gallery' => ['mobile' => 'gallery-mobile', 'desktop' => 'gallery-desktop'],
        'thumb' => ['mobile' => 'thumb-mobile', 'desktop' => 'thumb-desktop'],
    ];

    public static function fromMedia(Media $media, string $context = 'card'): array
    {
        $conversion = self::CONTEXTS[$context] ?? self::CONTEXTS['card'];

        return [
            'mobile' => $media->getAvailableUrl([$conversion['mobile'], $conversion['desktop']]),
            'desktop' => $media->getAvailableUrl([$conversion['desktop'], $conversion['mobile']]),
            'fallback' => $media->getUrl(),
            'alt' => trim((string) $media->name),
        ];
    }

    public static function fromUrl(?string $url): ?array
    {
        $value = is_string($url) ? trim($url) : '';

        if ($value === '') {
            return null;
        }

        return [
            'mobile' => $value,
            'desktop' => $value,
            'fallback' => $value,
            'alt' => '',
        ];
    }

    public static function pickUrl(?array $image, string $viewport = 'desktop'): ?string
    {
        if (! is_array($image)) {
            return null;
        }

        $preferred = $viewport === 'mobile'
            ? ($image['mobile'] ?? null)
            : ($image['desktop'] ?? null);

        if (is_string($preferred) && trim($preferred) !== '') {
            return trim($preferred);
        }

        $fallback = $image['fallback'] ?? null;

        return is_string($fallback) && trim($fallback) !== ''
            ? trim($fallback)
            : null;
    }
}
