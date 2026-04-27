<?php

namespace App\Filament\Municipal\Resources\ScaleOperations;

use App\Filament\Municipal\Resources\ScaleOperations\Pages\CreateScaleOperation;
use App\Filament\Municipal\Resources\ScaleOperations\Pages\EditScaleOperation;
use App\Filament\Municipal\Resources\ScaleOperations\Pages\ListScaleOperations;
use App\Filament\Municipal\Resources\ScaleOperations\Schemas\ScaleOperationForm;
use App\Filament\Municipal\Resources\ScaleOperations\Tables\ScaleOperationsTable;
use App\Models\ScaleOperation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ScaleOperationResource extends Resource
{
    protected static ?string $model = ScaleOperation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ScaleOperationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ScaleOperationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListScaleOperations::route('/'),
            'create' => CreateScaleOperation::route('/create'),
            'edit' => EditScaleOperation::route('/{record}/edit'),
        ];
    }
}
