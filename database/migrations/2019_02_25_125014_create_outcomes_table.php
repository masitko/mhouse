<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcomes', function (Blueprint $table) {
            $table->increments('id');

            // students
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');

            // wheels
            $table->integer('wheel_id')->unsigned()->index();
            $table->foreign('wheel_id')->references('id')->on('wheels');

            // terms
            $table->integer('term_id')->unsigned()->index();
            $table->foreign('term_id')->references('id')->on('terms');

            // json structure for outcomes
            $table->json('outcomes')->nullable();
            
            // json structure for extra options (if needed)
            $table->json('extra')->nullable();

            // this can be set if we want to edit after the end of the term
            $table->boolean('editable')->default(false);
      
            $table->integer('created_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users');

            $table->integer('updated_by')->unsigned()->index()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');

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
        Schema::dropIfExists('outcomes');
    }
}
