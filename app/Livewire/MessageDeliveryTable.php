<?php

namespace App\Livewire;


use App\Models\MessageDelivery;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;


class MessageDeliveryTable extends DataTableComponent
{
    protected $model = MessageDelivery::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Message Id", "message_id")
                ->sortable(),
            Column::make("Jid:", "jid")
                ->sortable(),
            Column::make("Delivery Status", "delivery_status")
                ->sortable(),
            Column::make("created_at Type", "created_at")
                ->sortable(),
            Column::make("Content", "content")
                ->html()
                ->searchable()
                ->collapseAlways()

        ];
    }

    public function builder(): Builder
    {
        return MessageDelivery::query()
            ->orderByDesc('created_at')
            ->select(); // Select some things
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Delivery Status', 'delivery_status')
                ->options([
                    '' => 'All',
                    'draft' => 'draft',
                    'pending' => 'pending',
                    'sent' => 'sent',
                    'delivery' => 'delivery',
                    'read' => 'read',
                    'error' => 'error',
                ])->filter(function (Builder $builder, string $value) {
                    match ($value) {
                        'draft' => $builder->where('delivery_status', 'draft'),
                        'pending' => $builder->where('delivery_status', 'pending'),
                        'sent' => $builder->where('delivery_status', 'sent'),
                        'delivery' => $builder->where('delivery_status', 'delivery'),
                        'read' => $builder->where('delivery_status', 'read'),
                        'error' => $builder->where('delivery_status', 'error'),
                    };
                }),
        ];
    }
}
