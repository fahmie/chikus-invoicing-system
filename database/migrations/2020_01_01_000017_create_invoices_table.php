<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uid')->unique();
            $table->Integer('type')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('transporter_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('plate_number_id')->nullable();
            $table->string('plate_number');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->string('invoice_number')->unique();
            $table->string('do_number')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('status');
            $table->string('paid_status');
            $table->unsignedBigInteger('payment_status_id')->nullable();
            $table->string('receipt_tran_number')->nullable();
            $table->string('transporter_paid_status')->nullable();
            $table->string('transporter_reference_number')->nullable();
            $table->string('tax_per_item');
            $table->string('discount_per_item');
            $table->text('notes')->nullable();
            $table->text('private_notes')->nullable();
            $table->string('discount_type')->nullable();
            $table->unsignedBigInteger('discount_val')->nullable();
            $table->unsignedBigInteger('sub_total');
            $table->unsignedBigInteger('total');
            $table->unsignedBigInteger('blance')->nullable();
            $table->unsignedBigInteger('discount')->nullable();
            $table->unsignedBigInteger('due_amount');
            $table->string('accurate')->nullable();
            $table->decimal('accurate_remark', 15, 3)->nullable();
            $table->unsignedBigInteger('accurate_amount')->nullable();
            $table->boolean('sent')->default(false);
            $table->boolean('viewed')->default(false);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
