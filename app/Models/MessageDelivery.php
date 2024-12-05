<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class MessageDelivery extends Model
{

    protected $table = 'message_deliveries';

    public function getConnectionName(): string
    {
        $id = request()->segment(3); // Assumes 3rd segment is the ID
        // Dynamically create a SQLite connection at runtime
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
}
