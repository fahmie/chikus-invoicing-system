<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptTransportersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_transporters', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->unsignedBigInteger('invoice_id');
            $table->string('receipt_number_transporter')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('reference_number_transporter')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_status')->nullable();
            $table->unsignedBigInteger('quantity_start')->nullable();
            $table->unsignedBigInteger('quantity_arrived')->nullable();
            $table->unsignedBigInteger('quantity_shortage')->nullable();
            $table->unsignedBigInteger('amount_start')->nullable();
            $table->unsignedBigInteger('amount_arrived')->nullable();
            $table->unsignedBigInteger('amount_shortage')->nullable();
            $table->unsignedBigInteger('net_pay_amount')->nullable();
            $table->unsignedBigInteger('balance')->nullable();
            $table->unsignedBigInteger('discount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipt_transporters');
    }
}
