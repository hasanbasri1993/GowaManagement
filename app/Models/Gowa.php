<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gowa extends Model
{
    protected $fillable = [
        'name',
        'port',
        'token',
        'service_name',
        'webhook_url',
        'chatwoot_host',
        'chatwoot_token',
        'chatwoot_bot_token',
        'chatwoot_force_update',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

}
