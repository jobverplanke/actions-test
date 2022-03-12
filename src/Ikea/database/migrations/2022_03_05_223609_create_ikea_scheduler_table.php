<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config(key: 'ikea.scheduler.table_name'), function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'user_id')->constrained(table: 'users');
            $table->string(column: 'command');
            $table->string(column: 'name')->nullable();
            $table->string(column: 'status');
            $table->json(column: 'options')->comment('JSON field with options as timezone, frequency, command parameters and more');
            $table->timestamp(column: 'last_run_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config(key: 'ikea.scheduler.table_name'));
    }
};
