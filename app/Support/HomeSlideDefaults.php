<?php

namespace App\Support;

final class HomeSlideDefaults
{
    /**
     * @return array<int, array{badge: string, title: string, subtitle: string, primary_button_text: string, secondary_button_text: string}>
     */
    public static function defaults(): array
    {
        return [
            [
                'badge' => 'Vitrin İlanları',
                'title' => 'İlan ücreti ödemeden ürününü dakikalar içinde yayına al.',
                'subtitle' => 'Mahallendeki alıcılarla hızlıca buluş, pazarlığı doğrudan mesajla tamamla.',
                'primary_button_text' => 'İlanları İncele',
                'secondary_button_text' => 'İlan Ver',
            ],
            [
                'badge' => 'Günün Fırsatları',
                'title' => 'Elektronikten araca kadar her kategoride canlı ilanlar seni bekliyor.',
                'subtitle' => 'Kategorilere göz at, favorilerine ekle ve satıcılarla tek tıkla iletişime geç.',
                'primary_button_text' => 'Kategorileri Gör',
                'secondary_button_text' => 'Hemen Başla',
            ],
            [
                'badge' => 'Yerel Alışveriş',
                'title' => 'Konumuna en yakın ikinci el fırsatları tek ekranda keşfet.',
                'subtitle' => 'Şehrini seç, sana en yakın ilanları filtrele ve güvenle alışveriş yap.',
                'primary_button_text' => 'Yakındaki İlanlar',
                'secondary_button_text' => 'Ücretsiz İlan Ver',
            ],
        ];
    }

    /**
     * @return array<int, array{badge: string, title: string, subtitle: string, primary_button_text: string, secondary_button_text: string}>
     */
    public static function normalize(mixed $slides): array
    {
        $defaults = self::defaults();
        $source = is_array($slides) ? $slides : [];

        $normalized = collect($source)
            ->filter(fn ($slide): bool => is_array($slide))
            ->values()
            ->map(function (array $slide, int $index) use ($defaults): ?array {
                $fallback = $defaults[$index] ?? $defaults[array_key_last($defaults)];
                $badge = trim((string) ($slide['badge'] ?? ''));
                $title = trim((string) ($slide['title'] ?? ''));
                $subtitle = trim((string) ($slide['subtitle'] ?? ''));
                $primaryButtonText = trim((string) ($slide['primary_button_text'] ?? ''));
                $secondaryButtonText = trim((string) ($slide['secondary_button_text'] ?? ''));

                if ($title === '') {
                    return null;
                }

                return [
                    'badge' => $badge !== '' ? $badge : $fallback['badge'],
                    'title' => $title,
                    'subtitle' => $subtitle !== '' ? $subtitle : $fallback['subtitle'],
                    'primary_button_text' => $primaryButtonText !== '' ? $primaryButtonText : $fallback['primary_button_text'],
                    'secondary_button_text' => $secondaryButtonText !== '' ? $secondaryButtonText : $fallback['secondary_button_text'],
                ];
            })
            ->filter(fn ($slide): bool => is_array($slide))
            ->values();

        return $normalized
            ->concat(collect($defaults)->slice($normalized->count()))
            ->take(count($defaults))
            ->values()
            ->all();
    }
}
