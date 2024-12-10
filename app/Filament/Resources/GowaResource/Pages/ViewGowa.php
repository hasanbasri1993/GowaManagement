<?php

namespace App\Filament\Resources\GowaResource\Pages;

use App\Filament\Resources\GowaResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Filament\Support\Enums\MaxWidth;

class ViewGowa extends Page
{
    use InteractsWithRecord;

    protected static string $resource = GowaResource::class;

    protected static string $view = 'filament.resources.gowa-resource.pages.gowa-message-deliveries';

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('edit')
                ->url('/up'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
           // GowaResource\Widgets\MessagesDelivery::class
        ];
    }

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }

}
