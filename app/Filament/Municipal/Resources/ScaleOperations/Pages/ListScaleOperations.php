<?php

namespace App\Filament\Municipal\Resources\ScaleOperations\Pages;

use App\Filament\Municipal\Resources\ScaleOperations\ScaleOperationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListScaleOperations extends ListRecords
{
    protected static string $resource = ScaleOperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
