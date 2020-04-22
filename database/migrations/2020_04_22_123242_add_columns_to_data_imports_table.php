<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToDataImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_imports', function (Blueprint $table) {

          $table->integer('school_id')->unsigned()->index();
          $table->foreign('school_id')->references('id')->on('schools');
          //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_imports', function (Blueprint $table) {
          $table->dropForeign('data_imports_school_id_foreign');
          $table->dropColumn('school_id');

            //
        });
    }
}
