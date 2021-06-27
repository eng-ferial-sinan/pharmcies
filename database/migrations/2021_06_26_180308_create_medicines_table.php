<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("category_id")->unsigned();
            $table->string("traite")->nullable(true);
            $table->string("demerites")->nullable(true);
            $table->string("relics")->nullable(true);
            $table->integer("price")->default(0);
            $table->string("production_date")->nullable(true);
            $table->string("expiry_date")->nullable(true);



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
        Schema::dropIfExists('medicines');
    }
}
