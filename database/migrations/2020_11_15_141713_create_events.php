<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by_id')->nullable()->constrained('users');
            $table->foreignId('updated_by_id')->nullable()->constrained('users');
            $table->string('name');
            $table->string('title_color');
            $table->string('display_title');
            $table->string('desc_long', 8000);
            $table->string('desc_short');
            $table->string('img_path')->nullable();
            $table->string('url_event')->nullable();
            $table->dateTime('event_date_start');
            $table->dateTime('event_date_end');
            $table->boolean('visibility')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
