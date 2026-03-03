<?php
namespace Modules\Admin\Filament\Resources;

use A909M\FilamentStateFusion\Forms\Components\StateFusionSelect;
use A909M\FilamentStateFusion\Tables\Columns\StateFusionSelectColumn;
use A909M\FilamentStateFusion\Tables\Filters\StateFusionSelectFilter;
use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Admin\Filament\Resources\UserResource\Pages;
use STS\FilamentImpersonate\Actions\Impersonate;
use UnitEnum;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-users';
    protected static string | UnitEnum | null $navigationGroup = 'User Management';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')->required()->maxLength(255),
            TextInput::make('email')->email()->required()->maxLength(255)->unique(ignoreRecord: true),
            TextInput::make('password')->password()->required(fn ($livewire) => $livewire instanceof Pages\CreateUser)->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)->dehydrated(fn ($state) => filled($state)),
            StateFusionSelect::make('status')->required(),
            Select::make('roles')->multiple()->relationship('roles', 'name')->preload(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('email')->searchable()->sortable(),
            TextColumn::make('roles.name')->badge()->label('Roles'),
            StateFusionSelectColumn::make('status'),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])->filters([
            StateFusionSelectFilter::make('status'),
        ])->actions([
            EditAction::make(),
            Action::make('activities')
                ->icon('heroicon-o-clock')
                ->url(fn (User $record): string => static::getUrl('activities', ['record' => $record])),
            Impersonate::make(),
            DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'activities' => Pages\ListUserActivities::route('/{record}/activities'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
