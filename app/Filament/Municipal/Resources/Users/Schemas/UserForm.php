<?php

namespace App\Filament\Municipal\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Tabs::make('Employee Details')
                    ->tabs([
                        \Filament\Forms\Components\Tabs\Tab::make('Personal Info')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('name')->required()->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('email')->email()->required()->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                                    ->dehydrated(fn ($state) => filled($state))
                                    ->maxLength(255),
                            ])->columns(2),

                        \Filament\Forms\Components\Tabs\Tab::make('Job Details')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('department')->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('job_title')->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('base_salary')->numeric()->prefix('SAR'),
                                \Filament\Forms\Components\DatePicker::make('join_date'),
                            ])->columns(2),

                        \Filament\Forms\Components\Tabs\Tab::make('Attendance')
                            ->schema([
                                \Filament\Forms\Components\ViewField::make('attendance_calendar')
                                    ->view('municipal.hr.attendance-calendar')
                                    ->columnSpanFull(),
                            ])->hidden(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),

                        \Filament\Forms\Components\Tabs\Tab::make('Payroll History')
                            ->schema([
                                \Filament\Forms\Components\Repeater::make('payrollRecords')
                                    ->relationship()
                                    ->schema([
                                        \Filament\Forms\Components\TextInput::make('month'),
                                        \Filament\Forms\Components\TextInput::make('year'),
                                        \Filament\Forms\Components\TextInput::make('net_salary')->numeric()->prefix('SAR'),
                                        \Filament\Forms\Components\TextInput::make('status'),
                                    ])
                                    ->columns(4)
                                    ->addable(false)
                                    ->deletable(false)
                                    ->reorderable(false)
                                    ->columnSpanFull(),
                            ])->hidden(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),
                    ])->columnSpanFull(),
            ]);
    }
}
