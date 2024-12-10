<?php

namespace App\Filament\Resources\GowaResource\Widgets;

use App\Models\MessageDelivery;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsMessageDelivery extends BaseWidget
{
    protected function getStats(): array
    {
        $statMessages = MessageDelivery::getMessageCounts();

        return [
            Stat::make('Draft', $statMessages['draftMessages']),
            Stat::make('Pending', $statMessages['pendingMessages']),
            Stat::make('Error', $statMessages['errorMessages']),
            Stat::make('Sent Today', $statMessages['sentMessagesToday']),
            Stat::make('Sent', $statMessages['sentMessages']),
        ];
    }
}
