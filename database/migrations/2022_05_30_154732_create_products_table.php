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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('typeofpizza_id')->unsigned();
            $table->foreign('typeofpizza_id')->references('id')->on('typeofpizzas');

           // $table->string('name')->nullable(); // varchar 255

            $table->enum('size', ['small', 'medium', 'large'])->nullable(); // varchar 255 

            $table->float('price')->nullable();

            $table->longText('description')->nullable(); // text

            $table->string('image')->nullable(); // varchar 255

            $table->boolean('is_active')->default(true); // tinyint 2 - 0 or 1

            $table->boolean('is_featured')->default(false); // tinyint 2 - 0 or 1

            $table->tinyInteger('sort_order')->default(0);

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
        Schema::dropIfExists('products');
    }
};
