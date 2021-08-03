<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string("medicine")->nullable(true);
            $table->integer("medicine_id")->unsigned();
            $table->integer('price')->default(0);
            $table->integer("count")->default(0);
            $table->integer("sum")->default(0);
            $table->integer("order_id")->unsigned();
            
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
        Schema::dropIfExists('details');
    }
}
