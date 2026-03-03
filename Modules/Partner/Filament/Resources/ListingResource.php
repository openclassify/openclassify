<?php
namespace Modules\Partner\Filament\Resources;

use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\Partner\Filament\Resources\ListingResource\Pages;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')->required()->maxLength(255)->live(onBlur: true)->afterStateUpdated(fn ($state, $set) => $set('slug', \Illuminate\Support\Str::slug($state) . '-' . \Illuminate\Support\Str::random(4))),
            TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
            Textarea::make('description')->rows(4),
            TextInput::make('price')->numeric()->prefix('$'),
            TextInput::make('currency')->default('USD')->maxLength(3),
            Select::make('category_id')->label('Category')->options(fn () => Category::where('is_active', true)->pluck('name', 'id'))->searchable()->nullable(),
            TextInput::make('contact_phone')->tel()->maxLength(50),
            TextInput::make('contact_email')->email()->maxLength(255),
            TextInput::make('city')->maxLength(100),
            TextInput::make('country')->maxLength(100),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable()->sortable()->limit(40),
            TextColumn::make('category.name')->label('Category'),
            TextColumn::make('price')->money('USD')->sortable(),
            TextColumn::make('status')->badge()->color(fn ($state) => match ($state) { 'active' => 'success', 'sold' => 'gray', 'pending' => 'warning', default => 'danger' }),
            TextColumn::make('city'),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])->actions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Filament::auth()->id());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListListings::route('/'),
            'create' => Pages\CreateListing::route('/create'),
            'edit' => Pages\EditListing::route('/{record}/edit'),
        ];
    }
}
