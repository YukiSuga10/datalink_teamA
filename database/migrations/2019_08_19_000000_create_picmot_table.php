<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicmotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picmot', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('picture');
            $table->integer('motion');
            $table->string('location');
            $table->timestamp('motioned_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('picmot');
    }
}
