<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnvev_diseases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('family')->nullable();
            $table->integer('age_group_family');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pnvev_diseases');
    }
}
