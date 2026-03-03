<?php
namespace Modules\Admin\Filament\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Modules\Admin\Filament\Resources\ListingResource\Pages;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Catalog';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')->required()->maxLength(255)->live(onBlur: true)->afterStateUpdated(fn ($state, $set) => $set('slug', \Illuminate\Support\Str::slug($state) . '-' . \Illuminate\Support\Str::random(4))),
            TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
            Textarea::make('description')->rows(4),
            TextInput::make('price')->numeric()->prefix('$'),
            TextInput::make('currency')->default('USD')->maxLength(3),
            Select::make('category_id')->label('Category')->options(fn () => Category::where('is_active', true)->pluck('name', 'id'))->searchable()->nullable(),
            Select::make('status')->options(['active' => 'Active', 'pending' => 'Pending', 'sold' => 'Sold', 'expired' => 'Expired'])->default('active')->required(),
            TextInput::make('contact_phone')->tel()->maxLength(50),
            TextInput::make('contact_email')->email()->maxLength(255),
            Toggle::make('is_featured')->default(false),
            TextInput::make('city')->maxLength(100),
            TextInput::make('country')->maxLength(100),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('title')->searchable()->sortable()->limit(40),
            TextColumn::make('category.name')->label('Category'),
            TextColumn::make('price')->money('USD')->sortable(),
            TextColumn::make('status')->badge()->color(fn ($state) => match ($state) { 'active' => 'success', 'sold' => 'gray', 'pending' => 'warning', default => 'danger' }),
            IconColumn::make('is_featured')->boolean()->label('Featured'),
            TextColumn::make('city'),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])->filters([
            SelectFilter::make('status')->options(['active' => 'Active', 'pending' => 'Pending', 'sold' => 'Sold', 'expired' => 'Expired']),
        ])->actions([EditAction::make(), DeleteAction::make()]);
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
