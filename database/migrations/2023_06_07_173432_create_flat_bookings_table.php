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
        Schema::create('flat_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('object_id')->constrained('objects');
            $table->foreignId('block_id')->constrained('blocks');
            $table->foreignId('flat_id')->constrained('flats');
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('transaction_id')->nullable()->comment('Первоначальный взнос')->constrained('transactions');
            $table->foreignId('bank_id')->nullable()->comment('Ипотечный банк')->constrained('banks');
            $table->decimal('mortgage_sum', 13, 2, true)->default(0)->comment('Сумма ипотеки');
            $table->decimal('trade_in_sum', 13, 2, true)->default(0)->comment('Сумма взноса trade in');
            $table->decimal('installment_plan_sum', 13, 2, true)->default(0)->comment('Сумма в рассрочку');
            $table->decimal('cash_sum', 13, 2, true)->default(0)->comment('Наличными');
            $table->decimal('price', 13, 2, true)->default(0)->comment('Цена за кв м');
            $table->decimal('sum', 13, 2, true)->default(0)->comment('Общая стоимость квартиры');
            $table->string('comment')->nullable();
            $table->foreignId('employee_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flat_bookings');
    }
};
