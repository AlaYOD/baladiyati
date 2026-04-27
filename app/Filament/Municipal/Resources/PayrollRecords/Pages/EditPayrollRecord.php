<?php

namespace App\Filament\Municipal\Resources\PayrollRecords\Pages;

use App\Filament\Municipal\Resources\PayrollRecords\PayrollRecordResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPayrollRecord extends EditRecord
{
    protected static string $resource = PayrollRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
