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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('object_id')->constrained('objects');
            $table->string('name')->comment('Название');
            $table->string('cadastral_number')->comment('Номер (кадастровый)')->nullable();
            $table->date('start')->comment('Дата начало строительства')->nullable();
            $table->date('end')->comment('Дата сдачи строительства')->nullable();
            $table->unsignedInteger('storeys_number')->comment('Этажность')->default(0);
            $table->foreignId('heating_type_id')->default(1)->constrained('heating_types');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocks');
    }
};
