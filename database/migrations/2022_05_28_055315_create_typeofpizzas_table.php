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
        Schema::create('typeofpizzas', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // varchar 255
            
            $table->longText('description')->nullable(); // text
            $table->longText('ingredients')->nullable(); // text
            $table->string('image')->nullable(); // varchar 255
            $table->boolean('is_active')->default(true); // tinyint 2 - 0 or 1

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
        Schema::dropIfExists('typeofpizzas');
    }
};
