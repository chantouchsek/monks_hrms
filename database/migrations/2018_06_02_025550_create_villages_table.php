<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('commune_id');
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('kh_name')->nullable();
            $table->string('reference')->nullable();
            $table->timestamps();

            $table->foreign('commune_id')->references('id')->on('communes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('villages');
    }
}
