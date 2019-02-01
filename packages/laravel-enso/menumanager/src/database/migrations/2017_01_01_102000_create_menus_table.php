<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->foreign('parent_id')->references('id')->on('menus');

            $table->integer('permission_id')->unsigned()->index()->nullable();
            $table->foreign('permission_id')->references('id')->on('permissions');

            $table->string('name');
            $table->string('icon');
            $table->integer('order_index');
            $table->boolean('has_children');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
