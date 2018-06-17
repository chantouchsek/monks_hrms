<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagodasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagodas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('kh_name')->nullable();
            $table->unsignedInteger('village_id')->nullable();
            $table->text('about')->nullable();
            $table->text('address')->nullable();
            $table->longText('history')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->text('slug')->nullable();
            $table->text('website')->nullable();
            $table->timestamps();

            $table->foreign('village_id')->references('id')->on('villages')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagodas');
    }
}
