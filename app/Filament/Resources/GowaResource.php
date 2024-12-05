<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\UsersRelationManager;
use App\Models\Gowa;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GowaResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Gowa::class;

    protected static ?string $navigationLabel = 'Gowa';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Label')
                    ->schema([
                        TextInput::make('name')
                            ->columns(6)
                            ->required(),
                        TextInput::make('port')
                            ->prefix('380')
                            ->columns(6)
                            ->type('number')
                            ->required(),
                        TextInput::make('token')->columns(6)
                            ->required(),
                        TextInput::make('service_name')->columns(6)
                            ->required(),
                        Toggle::make('active')
                            ->label('Active')->columns(6)
                            ->helperText('Service is active ?')
                            ->inline(false)
                            ->default(true),

                    ]),

                Fieldset::make()
                    ->schema([TextInput::make('webhook_url')
                        ->nullable()
                        ->helperText('e.g. https://webhook.site/1a2b3c4d')
                        ->columnSpan(12)
                        ->label('Webhook URL'),]),


                Section::make('Chatwoot Details (optional)')
                    ->schema([
                        TextInput::make('chatwoot_host')
                            ->label('Chatwoot Host')
                            ->helperText('e.g. https://chatwoot.example.com/1/account/inbox/2')
                            ->nullable(),
                        TextInput::make('chatwoot_token')
                            ->label('Chatwoot Token')
                            ->helperText('e.g. sdfasdf4wtgdfgsdfg')
                            ->nullable(),
                        TextInput::make('chatwoot_bot_token')
                            ->label('Chatwoot Bot Token')
                            ->helperText('e.g. sdfasdf4wtgdfgsdfg')
                            ->nullable(),
                        Toggle::make('chatwoot_force_update')
                            ->label('Chatwoot Force Update')
                            ->helperText('e.g. 1')
                            ->nullable(),
                    ]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('service_name'),
                Tables\Columns\IconColumn::make('active')->icon('heroicon-o-check-circle')->label('Active'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGowas::route('/'),
            'create' => Pages\CreateGowa::route('/create'),
            'edit' => Pages\EditGowa::route('/{record}/edit'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            'view_own',
        ];
    }
}
