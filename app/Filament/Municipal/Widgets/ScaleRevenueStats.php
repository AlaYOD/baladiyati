<?php

namespace App\Filament\Municipal\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ScaleRevenueStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = now()->startOfDay();
        
        $collected = \App\Models\ScaleOperation::where('status', 'paid')
            ->where('created_at', '>=', $today)
            ->sum('fee');
            
        $pending = \App\Models\ScaleOperation::where('status', 'unpaid')
            ->where('created_at', '>=', $today)
            ->sum('fee');
            
        $operations = \App\Models\ScaleOperation::where('created_at', '>=', $today)->count();

        return [
            Stat::make('Today\'s Revenue', number_format($collected, 2) . ' SAR')
                ->description('Collected from scale operations')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                
            Stat::make('Pending Payments', number_format($pending, 2) . ' SAR')
                ->description('Awaiting payment')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
                
            Stat::make('Total Operations Today', $operations)
                ->description('Trucks weighed')
                ->descriptionIcon('heroicon-m-truck')
                ->color('primary'),
        ];
    }
}
