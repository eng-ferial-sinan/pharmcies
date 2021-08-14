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
            $table->text("traite")->nullable(true);
            $table->text("demerites")->nullable(true);
            $table->text("relics")->nullable(true);
            $table->integer("price")->default(0);
            $table->date("production_date")->nullable(true);
            $table->date("expiry_date")->nullable(true);
            $table->string("image")->nullable(true);
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
        Schema::dropIfExists('medicines');
    }
}
