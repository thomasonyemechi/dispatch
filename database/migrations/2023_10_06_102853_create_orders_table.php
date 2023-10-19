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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->references('id')->on('customers');
            $table->integer('designer_id')->references('id')->on('users');
            $table->string('service_name');
            $table->string('files');
            $table->string('receiver_address');
            $table->string('receiver_phone');
            $table->integer('total_price');
            $table->integer('advance_paid');
            $table->string('receiving_date');
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
