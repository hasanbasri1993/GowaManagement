<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gowas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('port');
            $table->string('token');
            $table->string('service_name');
            $table->boolean('active');
            $table->string('webhook_url')->nullable();
            $table->string('chatwoot_host')->nullable();
            $table->string('chatwoot_token')->nullable();
            $table->string('chatwoot_bot_token')->nullable();
            $table->string('chatwoot_force_update')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gowas');
    }
};
