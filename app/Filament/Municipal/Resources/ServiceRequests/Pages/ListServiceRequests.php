<?php

namespace App\Filament\Municipal\Resources\ServiceRequests\Pages;

use App\Filament\Municipal\Resources\ServiceRequests\ServiceRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServiceRequests extends ListRecords
{
    protected static string $resource = ServiceRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => \Filament\Resources\Components\Tab::make(),
            'pending' => \Filament\Resources\Components\Tab::make()
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'pending')),
            'under_review' => \Filament\Resources\Components\Tab::make()
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'under_review')),
            'awaiting_payment' => \Filament\Resources\Components\Tab::make()
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'awaiting_payment')),
            'completed' => \Filament\Resources\Components\Tab::make()
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'completed')),
        ];
    }
}
