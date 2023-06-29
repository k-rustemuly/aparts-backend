<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('iin')->unique();
            $table->bigInteger('phone_number')->nullable();
            $table->string('surname');
            $table->string('name');
            $table->string('patronymic')->nullable();
            $table->timestamps();
        });
        DB::unprepared("ALTER TABLE  `clients` CHANGE  `iin`  `iin` BIGINT( 12 ) UNSIGNED ZEROFILL NOT NULL DEFAULT '0';");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
