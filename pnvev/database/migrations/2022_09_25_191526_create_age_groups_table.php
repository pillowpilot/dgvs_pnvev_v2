<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnvev_age_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('order');
            $table->integer('family');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pnvev_age_groups');
    }
}
