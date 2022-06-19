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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();


            $table->string('name'); // varchar 255

            $table->string('code'); //varchar 255

            $table->enum('type', ['number_of_items_validation', 'total_amount_validation']);

            $table->enum('size', ['small', 'medium', 'large'])->nullable(); //pizza sizes

            $table->integer('value')->nullable(); 
            
            $table->enum('price_type', ['fixed', 'percentage']);

            $table->float('price_value', 10, 2)->nullable();

            $table->string('description')->nullable();

            $table->boolean('is_active')->default(true);


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
};
