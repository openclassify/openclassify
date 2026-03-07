<?php

namespace Modules\Video\Filament\Partner\Resources;

use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Modules\Video\Filament\Partner\Resources\VideoResource\Pages;
use Modules\Video\Models\Video;
use Modules\Video\Support\Filament\VideoFormSchema;
use Modules\Video\Support\Filament\VideoTableSchema;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-film';

    protected static ?string $navigationLabel = 'Videos';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema(VideoFormSchema::resourceSchema(partnerScoped: true));
    }

    public static function table(Table $table): Table
    {
        return VideoTableSchema::configure($table, showOwner: false);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('listing', fn (Builder $query): Builder => $query->where('user_id', Filament::auth()->id()));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
