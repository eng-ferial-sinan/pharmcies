<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->boolean("send_messages_automatically")->default(false);
            $table->boolean("message_reminder")->default(false);
            $table->boolean("unlimited_messages")->default(false);
            $table->boolean("attached_photos_video")->default(false);
            $table->boolean("remove_ads")->default(false);
            $table->boolean("choose_multiple_contacts")->default(false);
            $table->boolean("unlimited_characters")->default(false);
            $table->boolean("customize_scheduling_frequency")->default(false);
            $table->integer("number_of_contacts")->default(0);
            $table->integer("add_the_number_of_waiting_messages")->default(0);
            $table->integer("monthly_subscription")->default(0);
            $table->integer("yearly_subscription")->default(0);
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
        Schema::dropIfExists('products');
    }
}
