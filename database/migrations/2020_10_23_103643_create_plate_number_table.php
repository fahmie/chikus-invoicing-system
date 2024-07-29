<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlateNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plate_number', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id');
            $table->string('number_plate')->nullable();
            $table->unsignedBigInteger('lorry_type_id')->nullable();
            $table->decimal('weight', 15, 3)->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();

            $table->foreign('driver_id')
            ->references('id')
            ->on('drivers')
            ->onDelete('no action')
            ->onUpdate('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plate_number');
    }
}
