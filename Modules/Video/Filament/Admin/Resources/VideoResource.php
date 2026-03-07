<?php

namespace Modules\Video\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Video\Filament\Admin\Resources\VideoResource\Pages;
use Modules\Video\Models\Video;
use Modules\Video\Support\Filament\VideoFormSchema;
use Modules\Video\Support\Filament\VideoTableSchema;
use UnitEnum;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-film';

    protected static string | UnitEnum | null $navigationGroup = 'Catalog';

    protected static ?string $navigationLabel = 'Videos';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema(VideoFormSchema::resourceSchema());
    }

    public static function table(Table $table): Table
    {
        return VideoTableSchema::configure($table);
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
