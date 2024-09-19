<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_name');
            $table->string('ip_address')->unique()->nullable();
            $table->string('operating_system');
            $table->foreignId('depart_id')->references('id')->on('departments')->onDelete('CASCADE');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('CASCADE');
            $table->text('details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
