<?php

namespace App\Filament\Municipal\Widgets;

use Filament\Widgets\ChartWidget;

class ScaleWeightChart extends ChartWidget
{
    protected ?string $heading = 'Total Weight Processed (7 Days)';
    
    public ?string $filter = 'today';
    
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = \Flowframe\Trend\Trend::model(\App\Models\ScaleOperation::class)
            ->between(
                start: now()->subDays(6),
                end: now(),
            )
            ->perDay()
            ->sum('net_weight');
 
        return [
            'datasets' => [
                [
                    'label' => 'Net Weight (kg)',
                    'data' => $data->map(fn (\Flowframe\Trend\TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (\Flowframe\Trend\TrendValue $value) => \Carbon\Carbon::parse($value->date)->format('M d')),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
