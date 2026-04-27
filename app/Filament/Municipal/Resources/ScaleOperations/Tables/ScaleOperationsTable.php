<?php

namespace App\Filament\Municipal\Resources\ScaleOperations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class ScaleOperationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordClasses(fn ($record) => match ($record->is_live) {
                true => 'border-s-2 border-primary-600 dark:border-primary-500 bg-primary-50 dark:bg-primary-900/10',
                default => null,
            })
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('vehicle_plate')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                \Filament\Tables\Columns\TextColumn::make('driver_name')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('net_weight')
                    ->label('Net Weight (kg)')
                    ->numeric()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('fee')
                    ->money('SAR')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'unpaid' => 'danger',
                        default => 'gray',
                    }),
                \Filament\Tables\Columns\IconColumn::make('is_live')
                    ->label('Hardware Link')
                    ->boolean(),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                \Filament\Tables\Actions\Action::make('print')
                    ->icon('heroicon-o-printer')
                    ->color('gray')
                    ->url(fn ($record) => route('filament.municipal.resources.scale-operations.print', ['record' => $record]))
                    ->openUrlInNewTab(),
                \Filament\Tables\Actions\EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
