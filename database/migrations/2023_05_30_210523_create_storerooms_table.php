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
        Schema::create('storerooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('object_id')->constrained('objects');
            $table->foreignId('block_id')->constrained('blocks');
            $table->unsignedInteger('number')->default(1)->comment('Название');
            $table->decimal('area')->default(1)->comment('Площадь');
            $table->foreignId('status_id')->default(1)->constrained('parking_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storerooms');
    }
};
