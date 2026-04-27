<?php

namespace App\Filament\Municipal\Resources\ServiceCategories\Pages;

use App\Filament\Municipal\Resources\ServiceCategories\ServiceCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceCategory extends CreateRecord
{
    protected static string $resource = ServiceCategoryResource::class;
}
