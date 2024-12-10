<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageDelivery extends Model
{
    protected $table = 'message_deliveries';

    public function getConnectionName(): string
    {
        $id = session('db_gowa');
        \Config::set('database.connections.dynamic_sqlite', [
            'driver' => 'sqlite',
            'database' => '/Users/it/PhpstormProjects/GowaManagement/database/db_'.$id,
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);

        return 'dynamic_sqlite';
    }

    protected $fillable = [
        'fullname',
        'sid',
        'parent_id',
        'jid',
        'message_type',
        'message_id',
        'content',
        'attachment',
        'attachment_name',
        'delivery_status',
        'priority',
        'attempt',
        'is_schedule',
        'is_group',
        'is_view_once',
        'send_after',
        'send_after_unix',
        'send_at',
        'delivered_at',
        'read_at',
        'full_name',
    ];

    public function scopeSearch($query, $value): void
    {
        $query->where('content', 'like', "%{$value}%")->orWhere('delivery_status', 'like', "%{$value}%");
    }

    public static function getMessageCounts(): array
    {
        $draftMessages = self::where('delivery_status', 'draft')
            ->whereNull('deleted_at')
            ->count();

        $errorMessages = self::where('delivery_status', 'error')
            ->whereNull('deleted_at')
            ->count();

        $pendingMessages = self::where('delivery_status', 'pending')
            ->whereNull('deleted_at')
            ->count();

        $sentMessages = self::whereNotNull('send_at')
            ->where('send_at', '!=', '')
            ->whereNull('deleted_at')
            ->count();

        $sentMessagesToday = self::whereNotNull('send_at')
            ->where('send_at', '!=', '')
            ->whereDate('send_at', now())
            ->whereNull('deleted_at')
            ->count();

        return [
            'draftMessages' => $draftMessages,
            'errorMessages' => $errorMessages,
            'pendingMessages' => $pendingMessages,
            'sentMessages' => $sentMessages,
            'sentMessagesToday' => $sentMessagesToday,
        ];
    }
}
