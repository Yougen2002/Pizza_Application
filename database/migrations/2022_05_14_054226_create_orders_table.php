<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('cart_id')->unsigned();
            $table->foreign('cart_id')->references('id')->on('carts');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('deal_id')->unsigned()->nullable();


            $table->enum('status', ['pending', 'processing', 'delivered', 'cancelled'])->nullable();

            $table->enum('payment_status', ['pending', 'paid', 'failed'])->nullable();

            $table->enum('delivery_method', ['collection', 'delivery'])->nullable();

              //Address
              $table->text('address_1')->nullable();
              $table->text('address_2')->nullable();
              $table->string('city')->nullable();
              $table->string('postcode')->nullable();
  
              //contact info
              $table->string('phone')->nullable();
              $table->string('mobile')->nullable();

 
              $table->float('discount', 10, 2)->nullable();
              $table->float('total', 10, 2)->nullable();

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
        Schema::dropIfExists('orders');
    }
};
