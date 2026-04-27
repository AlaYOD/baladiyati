<?php

namespace App\Filament\Municipal\Resources\PayrollRecords\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class PayrollRecordsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('user.name')
                    ->label('Employee')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                \Filament\Tables\Columns\TextColumn::make('month')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('year')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('net_salary')
                    ->money('SAR')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'processed' => 'success',
                        'paid' => 'success',
                        'draft' => 'warning',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                \Filament\Tables\Actions\Action::make('payslip')
                    ->label('View Payslip')
                    ->icon('heroicon-o-document-text')
                    ->color('primary')
                    ->url(fn ($record) => route('filament.municipal.resources.payroll-records.payslip', ['record' => $record]))
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
