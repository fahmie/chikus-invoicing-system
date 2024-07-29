<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->unsignedBigInteger('invoice_id');
            $table->string('receipt_number')->nullable();
            $table->string('reference_number')->nullable();
            $table->unsignedBigInteger('total')->nullable();
            $table->unsignedBigInteger('supposed_amount')->nullable();
            $table->unsignedBigInteger('balance')->nullable();
            $table->unsignedBigInteger('discount')->nullable();
            $table->unsignedBigInteger('paid_amount')->nullable();
            $table->string('last_paid_amount')->nullable();
            $table->string('payment_number');
            $table->string('receipt_status')->nullable();
            $table->unsignedBigInteger('payment_status')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->date('payment_date');
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
        Schema::dropIfExists('receipts');
    }
}
