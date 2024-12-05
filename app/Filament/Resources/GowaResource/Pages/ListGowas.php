<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\GowaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGowas extends ListRecords
{
    protected static string $resource = GowaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
