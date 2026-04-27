<?php

namespace App\Filament\Municipal\Resources\ServiceRequests\Pages;

use App\Filament\Municipal\Resources\ServiceRequests\ServiceRequestResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewServiceRequest extends ViewRecord
{
    protected static string $resource = ServiceRequestResource::class;

    protected string $view = 'filament.municipal.resources.service-requests.pages.view-service-request';

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('approve')
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->action(fn () => $this->record->update(['status' => 'completed'])),
            \Filament\Actions\Action::make('reject')
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->requiresConfirmation()
                ->action(fn () => $this->record->update(['status' => 'rejected'])),
            \Filament\Actions\Action::make('request_info')
                ->label('Need More Info')
                ->color('warning')
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->action(fn () => $this->record->update(['status' => 'under_review'])),
            \Filament\Actions\EditAction::make(),
        ];
    }
}
