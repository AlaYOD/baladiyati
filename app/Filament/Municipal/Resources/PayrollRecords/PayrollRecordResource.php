<?php

namespace App\Filament\Municipal\Resources\PayrollRecords;

use App\Filament\Municipal\Resources\PayrollRecords\Pages\CreatePayrollRecord;
use App\Filament\Municipal\Resources\PayrollRecords\Pages\EditPayrollRecord;
use App\Filament\Municipal\Resources\PayrollRecords\Pages\ListPayrollRecords;
use App\Filament\Municipal\Resources\PayrollRecords\Schemas\PayrollRecordForm;
use App\Filament\Municipal\Resources\PayrollRecords\Tables\PayrollRecordsTable;
use App\Models\PayrollRecord;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PayrollRecordResource extends Resource
{
    protected static ?string $model = PayrollRecord::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PayrollRecordForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PayrollRecordsTable::configure($table);
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
            'index' => ListPayrollRecords::route('/'),
            'create' => CreatePayrollRecord::route('/create'),
            'edit' => EditPayrollRecord::route('/{record}/edit'),
        ];
    }
}
