<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('observations', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('area_id')->unsigned()->index()->nullable();
      $table->foreign('area_id')->references('id')->on('areas');

      $table->string('name')->unique();
      $table->string('description')->nullable();

      $table->integer('order_index');

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('observations');
  }
}
