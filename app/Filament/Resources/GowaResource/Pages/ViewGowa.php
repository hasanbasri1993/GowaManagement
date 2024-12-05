<?php

namespace App\Filament\Resources\GowaResource\Pages;

use App\Filament\Resources\GowaResource;
use Filament\Resources\Pages\ViewRecord;

class ViewGowa extends ViewRecord
{
    protected static string $resource = GowaResource::class;

    protected static ?string $title = 'Detail';
}
