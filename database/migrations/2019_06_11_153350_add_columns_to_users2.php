<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsers2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->boolean('flag_fsm')->default(false);
          $table->boolean('post_cla')->default(false);
          $table->boolean('flag_cla')->default(false);
          $table->boolean('flag_sen')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('flag_fsm');
          $table->dropColumn('post_cla');
          $table->dropColumn('flag_cla');
          $table->dropColumn('flag_sen');
        });
    }
}
