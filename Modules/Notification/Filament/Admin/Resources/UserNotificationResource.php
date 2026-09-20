<?php

declare(strict_types=1);

namespace Modules\Notification\Filament\Admin\Resources;

use BackedEnum;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Modules\Admin\Support\Filament\ResourceTableActions;
use Modules\Admin\Support\Filament\ResourceTableColumns;
use Modules\Notification\Filament\Admin\Resources\UserNotificationResource\Pages;
use Modules\Notification\Models\UserNotification;
use UnitEnum;

class UserNotificationResource extends Resource
{
    protected static ?string $model = UserNotification::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-bell';

    protected static string|UnitEnum|null $navigationGroup = 'Moderation';

    protected static ?string $label = 'Notification';

    protected static ?string $pluralLabel = 'Notifications';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('user_id')->numeric()->required(),
            TextInput::make('type')->maxLength(48)->required(),
            TextInput::make('title')->maxLength(150)->required(),
            Textarea::make('body')->rows(3),
            TextInput::make('action_url')->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ResourceTableColumns::id(),
            TextColumn::make('title')->searchable()->limit(48),
            TextColumn::make('type')->badge()->sortable(),
            TextColumn::make('user_id')->label('User')->sortable(),
            TextColumn::make('read_at')->dateTime()->label('Read')->placeholder('Unread'),
            ResourceTableColumns::createdAtHidden(),
        ])->defaultSort('id', 'desc')->filters([
            SelectFilter::make('type')->options([
                'offer' => 'Offer', 'message' => 'Message', 'review' => 'Review',
                'listing' => 'Listing', 'promotion' => 'Promotion', 'saved_search' => 'Saved search',
            ]),
        ])->actions(ResourceTableActions::editDelete());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserNotificationResourceRecords::route('/'),
            'create' => Pages\CreateUserNotificationResourceRecord::route('/create'),
            'edit' => Pages\EditUserNotificationResourceRecord::route('/{record}/edit'),
        ];
    }
}
