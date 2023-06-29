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
        Schema::create('objects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->default(1)->constrained('regions');
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('status_id')->default(1)->constrained('object_statuses');
            $table->string('name_kk')->comment('Наимнование');
            $table->string('name_ru');
            $table->text('description_kk')->comment('Описание')->nullable();
            $table->text('description_ru')->nullable();
            $table->foreignId('class_id')->constrained('object_classes');
            $table->foreignId('technology_id')->constrained('construction_technologies');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objects');
    }
};
