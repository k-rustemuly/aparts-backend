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
        Schema::create('commercial_premises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('object_id')->constrained('objects');
            $table->foreignId('block_id')->constrained('blocks');
            $table->integer('floor')->default(1)->comment('Этаж');
            $table->unsignedInteger('number')->default(1)->comment('Номер');
            $table->decimal('area')->default(1)->comment('Площадь');
            $table->decimal('ceiling_height', 8, 1)->default(1)->comment('Высота потолков');
            $table->foreignId('status_id')->default(1)->constrained('commercial_premise_statuses');
            $table->foreignId('finishing_status_id')->default(1)->constrained('finishing_statuses');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commercial_premises');
    }
};
