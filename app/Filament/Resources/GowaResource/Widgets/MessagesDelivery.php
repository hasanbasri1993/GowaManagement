<?php

namespace App\Filament\Resources\GowaResource\Widgets;

use App\Models\MessageDelivery;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class MessagesDelivery extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->actions([
                Action::make('Pesan Detail')
                    ->label('Lihat')
                    ->modalHeading('Pesan Detail')
                    ->modalSubmitAction(false)
                    ->modalContent(fn (MessageDelivery $record) => \View::make('livewire.content-modal', [
                        'content' => $this->format_message($record->content),
                        'record' => $record,
                    ])),

            ], position: ActionsPosition::BeforeColumns)
            ->filters([
                SelectFilter::make('delivery_status')
                    ->options([
                        'draft' => 'Draft',
                        'pending' => 'Pending',
                        'sent' => 'Sent',
                        'delivered' => 'Delivered',
                        'read' => 'Read',
                    ]),
            ])
            ->persistFiltersInSession()
            ->defaultSort('created_at', 'desc')
            ->query(MessageDelivery::query())
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'), // Explicit label for header
                Tables\Columns\TextColumn::make('jid')
                    ->label('JID')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('message_type')
                    ->label('Message Type')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable(),
                Tables\Columns\TextColumn::make('content')
                    ->label('Content')
                    ->wrap()
                    ->limit()
                    ->searchable(),
                Tables\Columns\TextColumn::make('delivery_status')
                    ->label('Delivery Status')
                    ->sortable(),
            ]);
    }

    public function format_message(string $raw_message): string
    {
        $nl2br_message = nl2br($raw_message);
        $bold = preg_replace('/\*(.*?)\*/', '<b>$1</b>', $nl2br_message);
        $italic = preg_replace('/_(.*?)_/', '<i>$1</i>', $bold);
        $strikethrough = preg_replace('/~(.*?)~/', '<span style="text-decoration: line-through;">$1</span>', $italic);
        $monospace = preg_replace('/```(.*?)```/', '<code>$1</code>', $strikethrough);

        $url = preg_replace(
            '/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#\=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&\/\=]*)/',
            '<a class="text-blue-500" href="$0" target="_blank">$0</a>',
            $monospace
        );

        return preg_replace_callback(
            ['/(\\\(u|U)[a-fA-F0-9]{4,8})/'],
            function ($matches) {
                $code = preg_replace('/\\\u|\\\U/', '', $matches[0]);

                return "&#x$code;";
            },
            $url
        );
    }
}
