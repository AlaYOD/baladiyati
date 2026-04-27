<?php

namespace App\Filament\Municipal\Resources\Services\Schemas;

use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Split::make([
                    \Filament\Forms\Components\Section::make('Core Definition')
                        ->description('Basic service details and pricing.')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            \Filament\Forms\Components\Select::make('service_category_id')
                                ->relationship('category', 'name')
                                ->required()
                                ->searchable()
                                ->preload(),
                            \Filament\Forms\Components\TextInput::make('base_fee')
                                ->numeric()
                                ->prefix('SAR')
                                ->default(0),
                            \Filament\Forms\Components\Toggle::make('is_active')
                                ->label('Available for Citizens')
                                ->default(true),
                            \Filament\Forms\Components\Textarea::make('description')
                                ->maxLength(65535)
                                ->rows(4),
                        ])->grow(false),

                    \Filament\Forms\Components\Section::make('Dynamic Form Builder')
                        ->description('Design the fields citizens will see in the frontend.')
                        ->schema([
                            \Filament\Forms\Components\Builder::make('form_schema')
                                ->label('Fields Configuration')
                                ->blocks([
                                    \Filament\Forms\Components\Builder\Block::make('text_input')
                                        ->label('Text Input')
                                        ->icon('heroicon-o-pencil')
                                        ->schema([
                                            \Filament\Forms\Components\TextInput::make('label')->required(),
                                            \Filament\Forms\Components\TextInput::make('name')->required()->alpha_dash(),
                                            \Filament\Forms\Components\Select::make('type')
                                                ->options([
                                                    'text' => 'Text',
                                                    'number' => 'Number',
                                                    'email' => 'Email',
                                                    'tel' => 'Phone',
                                                ])->default('text'),
                                            \Filament\Forms\Components\Toggle::make('is_required'),
                                        ])->columns(2),
                                    \Filament\Forms\Components\Builder\Block::make('select')
                                        ->label('Select Dropdown')
                                        ->icon('heroicon-o-list-bullet')
                                        ->schema([
                                            \Filament\Forms\Components\TextInput::make('label')->required(),
                                            \Filament\Forms\Components\TextInput::make('name')->required()->alpha_dash(),
                                            \Filament\Forms\Components\Repeater::make('options')
                                                ->schema([
                                                    \Filament\Forms\Components\TextInput::make('label')->required(),
                                                    \Filament\Forms\Components\TextInput::make('value')->required(),
                                                ])->columns(2),
                                            \Filament\Forms\Components\Toggle::make('is_required'),
                                        ])->columns(2),
                                    \Filament\Forms\Components\Builder\Block::make('file_upload')
                                        ->label('Document Upload')
                                        ->icon('heroicon-o-arrow-up-tray')
                                        ->schema([
                                            \Filament\Forms\Components\TextInput::make('label')->required(),
                                            \Filament\Forms\Components\TextInput::make('name')->required()->alpha_dash(),
                                            \Filament\Forms\Components\Toggle::make('is_required'),
                                        ])->columns(2),
                                ])
                                ->collapsible()
                                ->collapsed()
                                ->addActionLabel('Add New Form Field'),
                        ]),
                ])->from('md')->columnSpanFull(),
            ]);
    }
}
