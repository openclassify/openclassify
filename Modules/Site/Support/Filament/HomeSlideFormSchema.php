<?php

namespace Modules\Site\Support\Filament;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Modules\Site\App\Support\LocalMedia;

final class HomeSlideFormSchema
{
    public static function make(array $defaults, callable $normalizeSlides): Repeater
    {
        return Repeater::make('home_slides')
            ->label('Homepage Slides')
            ->helperText('Use 1 to 5 slides. Upload a wide image for each slide to improve the hero area.')
            ->schema([
                FileUpload::make('image_path')
                    ->label('Slide Image')
                    ->image()
                    ->disk(LocalMedia::disk())
                    ->directory('home-slides')
                    ->visibility('public')
                    ->imageEditor()
                    ->imagePreviewHeight('200')
                    ->helperText('Recommended: 1600x1000 or wider.')
                    ->columnSpanFull(),
                TextInput::make('badge')
                    ->label('Badge')
                    ->maxLength(255),
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('subtitle')
                    ->label('Subtitle')
                    ->rows(3)
                    ->required()
                    ->maxLength(500)
                    ->columnSpanFull(),
                TextInput::make('primary_button_text')
                    ->label('Primary Button')
                    ->required()
                    ->maxLength(120),
                TextInput::make('secondary_button_text')
                    ->label('Secondary Button')
                    ->required()
                    ->maxLength(120),
            ])
            ->columns(2)
            ->default($defaults)
            ->minItems(1)
            ->maxItems(5)
            ->collapsible()
            ->collapsed()
            ->cloneable()
            ->reorderableWithButtons()
            ->addActionLabel('Add Slide')
            ->itemLabel(fn (array $state): string => filled($state['title'] ?? null) ? (string) $state['title'] : 'New Slide')
            ->dehydrateStateUsing(fn ($state) => $normalizeSlides($state));
    }
}
