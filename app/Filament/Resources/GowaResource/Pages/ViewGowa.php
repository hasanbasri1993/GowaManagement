<?php

namespace App\Filament\Resources\GowaResource\Pages;

use App\Filament\Resources\GowaResource;
use App\Models\Gowa;
use Filament\Actions\Action;
use Filament\Forms\Components\Actions\Action as FormAction;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Str;

class ViewGowa extends Page
{
    use InteractsWithRecord;

    protected static string $resource = GowaResource::class;

    protected static string $view = 'filament.resources.gowa-resource.pages.gowa-message-deliveries';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        session(['db_gowa' => $this->record->id]);
    }

    protected function getHeaderActions(): array
    {

        return [
            Action::make('edit')
                ->label('Edit Gowa')
                ->form([
                    Fieldset::make('Label')
                        ->schema([
                            TextInput::make('token')
                                ->label('Token')
                                ->columns(6)
                                ->default($this->record->token)
                                ->hintAction(
                                    FormAction::make('Generate New')
                                        ->icon('heroicon-m-clipboard')
                                        ->action(function (Set $set) {
                                            $randomToken = Str::random(32);
                                            $set('token', 'gowa_'.$randomToken);
                                        })
                                )
                                ->required(),
                            TextInput::make('webhook_url')
                                ->nullable()
                                ->helperText('e.g. https://webhook.site/1a2b3c4d')
                                ->columns(6)
                                ->activeUrl()
                                ->label('Webhook URL')
                                ->default($this->record->webhook_url),
                        ]),

                    Section::make('Chatwoot Details (optional)')
                        ->columns(12)
                        ->schema([
                            TextInput::make('chatwoot_host')
                                ->label('Chatwoot Host')
                                ->columnSpan(6)
                                ->activeUrl()
                                ->helperText('e.g. https://chatwoot.example.com/1/account/inbox/2')
                                ->nullable(),
                            TextInput::make('chatwoot_token')
                                ->label('Chatwoot Token')
                                ->columnSpan(6)
                                ->helperText('e.g. sdfasdf4wtgdfgsdfg')
                                ->nullable(),
                            TextInput::make('chatwoot_bot_token')
                                ->label('Chatwoot Bot Token')
                                ->columnSpan(6)
                                ->helperText('e.g. sdfasdf4wtgdfgsdfg')
                                ->nullable(),
                            Toggle::make('chatwoot_force_update')
                                ->label('Chatwoot Force Update')
                                ->columnSpan(6)
                                ->helperText('e.g. 1')
                                ->nullable(),
                        ]),
                ])
                ->action(function (Gowa $set, array $data) {
                    $set->token = $data['token'];
                    $set->webhook_url = $data['webhook_url'];
                    $set->chatwoot_host = $data['chatwoot_host'];
                    $set->chatwoot_token = $data['chatwoot_token'];
                    $set->chatwoot_bot_token = $data['chatwoot_bot_token'];
                    $set->chatwoot_force_update = $data['chatwoot_force_update'];
                    $set->save();

                    Notification::make()
                        ->title('Gowa Updated')
                        ->success()
                        ->send();
                }),

        ];
    }
}
