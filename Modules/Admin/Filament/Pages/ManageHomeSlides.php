<?php

namespace Modules\Admin\Filament\Pages;

use App\Settings\GeneralSettings;
use App\Support\HomeSlideDefaults;
use BackedEnum;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Modules\Admin\Support\HomeSlideFormSchema;
use Modules\S3\Support\MediaStorage;
use UnitEnum;

class ManageHomeSlides extends SettingsPage
{
    protected static string $settings = GeneralSettings::class;

    protected static ?string $title = 'Home Slides';

    protected static ?string $navigationLabel = 'Home Slides';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-photo';

    protected static string | UnitEnum | null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 2;

    protected Width | string | null $maxContentWidth = Width::Full;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        return [
            'home_slides' => $this->normalizeHomeSlides(
                $data['home_slides'] ?? $this->defaultHomeSlides(),
                MediaStorage::storedDisk('public'),
            ),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['home_slides'] = $this->normalizeHomeSlides($data['home_slides'] ?? [], MediaStorage::activeDisk());

        return $data;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                HomeSlideFormSchema::make(
                    $this->defaultHomeSlides(),
                    fn ($state): array => $this->normalizeHomeSlides($state, MediaStorage::activeDisk()),
                ),
            ]);
    }

    private function defaultHomeSlides(): array
    {
        return HomeSlideDefaults::defaults();
    }

    private function normalizeHomeSlides(mixed $state, ?string $defaultDisk = null): array
    {
        return HomeSlideDefaults::normalize($state, $defaultDisk);
    }
}
