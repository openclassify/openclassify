<?php

namespace Modules\Video\Support\Filament;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Modules\Video\Enums\VideoStatus;
use Modules\Video\Models\Video;

class VideoTableSchema
{
    public static function configure(Table $table, bool $showOwner = true): Table
    {
        $columns = [
            TextColumn::make('title')
                ->searchable()
                ->sortable()
                ->limit(40)
                ->formatStateUsing(fn (Video $record): string => $record->titleLabel()),
            TextColumn::make('listing.title')
                ->label('Listing')
                ->searchable()
                ->sortable()
                ->limit(40),
        ];

        if ($showOwner) {
            $columns[] = TextColumn::make('user.email')
                ->label('Owner')
                ->searchable()
                ->sortable()
                ->toggleable();
        }

        return $table
            ->columns([
                ...$columns,
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (Video $record): string => $record->statusColor())
                    ->formatStateUsing(fn (Video $record): string => $record->statusLabel()),
                IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean(),
                TextColumn::make('resolution')
                    ->label('Resolution')
                    ->state(fn (Video $record): string => $record->resolutionLabel()),
                TextColumn::make('duration')
                    ->label('Duration')
                    ->state(fn (Video $record): string => $record->durationLabel()),
                TextColumn::make('size')
                    ->label('Size')
                    ->state(fn (Video $record): string => $record->sizeLabel()),
                TextColumn::make('processed_at')
                    ->label('Processed')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(VideoStatus::options()),
                SelectFilter::make('listing_id')
                    ->label('Listing')
                    ->relationship('listing', 'title')
                    ->searchable()
                    ->preload(),
                TernaryFilter::make('is_active')
                    ->label('Visible'),
                ...($showOwner ? [
                    SelectFilter::make('user_id')
                        ->label('Owner')
                        ->relationship('user', 'email')
                        ->searchable()
                        ->preload(),
                ] : []),
            ])
            ->defaultSort('id', 'desc')
            ->actions([
                Action::make('watch')
                    ->icon('heroicon-o-play-circle')
                    ->color('gray')
                    ->modalHeading(fn (Video $record): string => $record->titleLabel())
                    ->modalWidth('5xl')
                    ->modalSubmitAction(false)
                    ->modalContent(
                        fn (Video $record): View => view('video::filament.video-player', ['video' => $record->loadMissing('listing')]),
                    ),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
