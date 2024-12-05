<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\GowaResource;
use App\Models\Chatwoot;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateGowa extends CreateRecord
{
    protected static string $resource = GowaResource::class;

    protected  function mutateFormDataBeforeCreate(array $data): array
    {
        Log::log('info', 'CreateGowa', $data);

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
