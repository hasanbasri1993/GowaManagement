<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\GowaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;

class EditGowa extends EditRecord
{
    protected static string $resource = GowaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        Log::log('info', 'updateCustomer', $data);

//        if ($data['chatwoot']['host']) {
//            $chatwoot = Chatwoot::create([
//                'host' => $data['chatwoot']['host'],
//                'token' => $data['chatwoot']['token'],
//                'bot_token' => $data['chatwoot']['bot_token'],
//                'force_update' => $data['chatwoot']['force_update'] ?? null,
//            ]);
//            $data['chatwoot_id'] = $chatwoot->id;
//        }

        return $data;
    }

}
