<?php

namespace App\Filament\Municipal\Resources\PayrollRecords\Pages;

use App\Filament\Municipal\Resources\PayrollRecords\PayrollRecordResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPayrollRecords extends ListRecords
{
    protected static string $resource = PayrollRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
