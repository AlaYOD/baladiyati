<?php

namespace App\Filament\Municipal\Pages;

use Filament\Pages\Dashboard;

class ScaleDashboard extends Dashboard
{
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-scale';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Operations';
    }

    public function getTitle(): \Illuminate\Contracts\Support\Htmlable|string
    {
        return 'Scale Department Analytics';
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Municipal\Widgets\ScaleRevenueStats::class,
            \App\Filament\Municipal\Widgets\ScaleWeightChart::class,
        ];
    }
}
