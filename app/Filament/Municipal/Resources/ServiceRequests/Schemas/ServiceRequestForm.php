<?php

namespace App\Filament\Municipal\Resources\ServiceRequests\Schemas;

use Filament\Schemas\Schema;

class ServiceRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Section::make('Request Information')
                    ->schema([
                        \Filament\Forms\Components\Placeholder::make('service_name')
                            ->label('Service')
                            ->content(fn ($record) => $record?->service?->name),
                        \Filament\Forms\Components\Placeholder::make('citizen_name')
                            ->label('Citizen')
                            ->content(fn ($record) => $record?->user?->name),
                        \Filament\Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'under_review' => 'Under Review',
                                'awaiting_payment' => 'Awaiting Payment',
                                'completed' => 'Completed',
                                'rejected' => 'Rejected',
                            ])
                            ->required()
                            ->selectablePlaceholder(false)
                            ->native(false),
                    ])->columns(3),

                \Filament\Forms\Components\Section::make('Submitted Data')
                    ->description('This data was submitted by the citizen.')
                    ->schema([
                        \Filament\Forms\Components\KeyValue::make('payload')
                            ->label('Form Data')
                            ->disabled()
                            ->columnSpanFull(),
                    ]),

                \Filament\Forms\Components\Section::make('Internal Notes')
                    ->schema([
                        \Filament\Forms\Components\Textarea::make('notes')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
