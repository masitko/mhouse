<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');

            // $table->integer('mandatary_id')->unsigned()->index()->nullable();
            // $table->foreign('mandatary_id')->references('id')->on('people');

            $table->string('name')->unique();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();

            // $table->string('bank')->nullable();
            // $table->string('bank_account')->nullable();

            $table->text('notes')->nullable();
            // $table->string('pays_vat')->boolean();

            $table->integer('created_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users');

            $table->integer('updated_by')->unsigned()->index()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
          $table->integer('school_id')->after('id')->unsigned()->index()->nullable();
          $table->foreign('school_id')->references('id')->on('schools');
        });

        Schema::table('people', function (Blueprint $table) {
            $table->integer('school_id')->after('id')->unsigned()->index()->nullable();
            $table->foreign('school_id')->references('id')->on('schools');
        });
    }

    public function down()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
        });

        Schema::table('users', function (Blueprint $table) {
          $table->dropForeign(['school_id']);
          $table->dropColumn('school_id');
      });

      Schema::dropIfExists('schools');
    }
}
