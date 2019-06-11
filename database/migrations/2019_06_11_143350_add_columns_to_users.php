<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->integer('ethnicity')->nullable();
          $table->integer('gender')->nullable();
          $table->date('admission_date')->nullable();
          $table->string('upn', 30 )->nullable();
          $table->integer('idaci')->nullable();
          $table->boolean('free_meal')->default(false);
          $table->boolean('pupil_premium')->default(false);
          $table->boolean('looked_after')->default(false);
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
          $table->dropColumn('ethnicity');
          $table->dropColumn('gender');
          $table->dropColumn('admission_date');
          $table->dropColumn('upn');
          $table->dropColumn('idaci');
          $table->dropColumn('free_meal');
          $table->dropColumn('pupil_premium');
          $table->dropColumn('looked_after');
        });
    }
}
