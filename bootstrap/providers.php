<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\Filament\MunicipalPanelProvider::class,
    App\Providers\FortifyServiceProvider::class,
    BladeUI\Icons\BladeIconsServiceProvider::class,
    Filament\Actions\ActionsServiceProvider::class,
    Filament\FilamentServiceProvider::class,
    Filament\Forms\FormsServiceProvider::class,
    Filament\Infolists\InfolistsServiceProvider::class,
    Filament\Notifications\NotificationsServiceProvider::class,
    Filament\QueryBuilder\QueryBuilderServiceProvider::class,
    Filament\Schemas\SchemasServiceProvider::class,
    Filament\Support\SupportServiceProvider::class,
    Filament\Tables\TablesServiceProvider::class,
    Filament\Widgets\WidgetsServiceProvider::class,
    Flux\FluxServiceProvider::class,
    Laravel\Fortify\FortifyServiceProvider::class,
    Livewire\LivewireServiceProvider::class,
    Spatie\Multitenancy\MultitenancyServiceProvider::class,
];
