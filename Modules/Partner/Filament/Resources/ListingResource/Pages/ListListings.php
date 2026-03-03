<?php
namespace Modules\Partner\Filament\Resources\ListingResource\Pages;

use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Partner\Filament\Resources\ListingResource;

class ListListings extends ListRecords
{
    protected static string $resource = ListingResource::class;
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Manuel İlan Ekle'),
            Action::make('quickCreate')
                ->label('AI ile Hızlı İlan Ver')
                ->icon('heroicon-o-sparkles')
                ->color('danger')
                ->url(ListingResource::getUrl('quick-create', shouldGuessMissingParameters: true)),
        ];
    }
}
