<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSittingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nameAr');
            $table->string('nameEn');
            $table->string('email')->nullable($value = true);
            $table->string('address')->nullable($value = true); 
            $table->string('phone')->nullable($value = true); 
            $table->string("image")->nullable(true);
            $table->string("facebook")->nullable(true);
            $table->string("twitter")->nullable(true);
            $table->string("instagram")->nullable(true);
            $table->string("google_plus")->nullable(true);
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
        Schema::dropIfExists('settings');
    }
}
