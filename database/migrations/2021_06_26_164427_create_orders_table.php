<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
          // $table->string("address")->nullable(true);
            $table->integer("status_id")->unsigned();
            $table->integer("total_pice")->nullable(true);
            $table->integer("pharmacy_id")->unsigned();
            $table->integer("user_id")->unsigned();
            
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
        Schema::dropIfExists('orders');
    }
}
