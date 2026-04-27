<?php

namespace App\Filament\Municipal\Resources\ServiceRequests\Pages;

use App\Filament\Municipal\Resources\ServiceRequests\ServiceRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceRequest extends CreateRecord
{
    protected static string $resource = ServiceRequestResource::class;
}
