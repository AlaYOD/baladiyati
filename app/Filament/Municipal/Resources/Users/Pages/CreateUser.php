<?php

namespace App\Filament\Municipal\Resources\Users\Pages;

use App\Filament\Municipal\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
