<?php

namespace App\Filament\Municipal\Resources\ScaleOperations\Pages;

use App\Filament\Municipal\Resources\ScaleOperations\ScaleOperationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditScaleOperation extends EditRecord
{
    protected static string $resource = ScaleOperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
