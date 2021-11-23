<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

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
            $table->string("address")->nullable(true);
            $table->string("lat")->nullable(true);
            $table->string("lng")->nullable(true);
            $table->integer("status_id")->unsigned();
            $table->integer("sub_total")->nullable(true);
            $table->integer("delivery_price")->nullable(true);
            $table->integer("total")->nullable(true);
            $table->integer("user_id")->unsigned()->Nullable();
            $table->integer("driver_id")->nullable(true);
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
