<?php

namespace App\Filament\Municipal\Resources\PayrollRecords\Schemas;

use Filament\Schemas\Schema;

class PayrollRecordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Wizard::make([
                    \Filament\Forms\Components\Wizard\Step::make('Select Period')
                        ->description('Choose the month, year, and employee.')
                        ->schema([
                            \Filament\Forms\Components\Select::make('user_id')
                                ->relationship('user', 'name')
                                ->label('Employee')
                                ->searchable()
                                ->required(),
                            \Filament\Forms\Components\Select::make('month')
                                ->options([
                                    'January' => 'January', 'February' => 'February', 'March' => 'March',
                                    'April' => 'April', 'May' => 'May', 'June' => 'June',
                                    'July' => 'July', 'August' => 'August', 'September' => 'September',
                                    'October' => 'October', 'November' => 'November', 'December' => 'December',
                                ])->required(),
                            \Filament\Forms\Components\TextInput::make('year')
                                ->numeric()
                                ->default(now()->year)
                                ->required(),
                        ])->columns(2),

                    \Filament\Forms\Components\Wizard\Step::make('Calculations')
                        ->description('Review base salary, deductions, and overtime.')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('base_salary')
                                ->numeric()
                                ->prefix('SAR')
                                ->required(),
                            \Filament\Forms\Components\TextInput::make('overtime')
                                ->numeric()
                                ->prefix('SAR')
                                ->default(0),
                            \Filament\Forms\Components\TextInput::make('deductions')
                                ->numeric()
                                ->prefix('SAR')
                                ->default(0),
                            \Filament\Forms\Components\Placeholder::make('net_salary_preview')
                                ->label('Net Salary Calculation')
                                ->content('Will be calculated automatically upon saving.'),
                        ])->columns(2),

                    \Filament\Forms\Components\Wizard\Step::make('Confirmation')
                        ->description('Finalize and prepare for payslip generation.')
                        ->schema([
                            \Filament\Forms\Components\Select::make('status')
                                ->options([
                                    'draft' => 'Draft',
                                    'processed' => 'Processed',
                                ])
                                ->default('draft')
                                ->required(),
                        ]),
                ])->columnSpanFull()
            ]);
    }
}
