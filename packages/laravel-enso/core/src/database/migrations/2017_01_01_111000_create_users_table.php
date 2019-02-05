<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            // $table->integer('person_id')->unsigned()->index()->nullable();

            // $table->integer('group_id')->unsigned()->index()->nullable();
            // $table->foreign('group_id')->references('id')->on('user_groups');
            
            $table->integer('role_id')->unsigned()->index('roles_id');
            $table->foreign('role_id')->references('id')->on('roles');

            $table->tinyInteger('title')->nullable();
            
            $table->string('first_name');
            $table->string('other_name')->nullable();
            $table->string('last_name');

            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();

            $table->date('birthday')->nullable();

            $table->text('notes')->nullable();

            $table->boolean('is_active');

            $table->integer('created_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users');

            $table->integer('updated_by')->unsigned()->index()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');

            $table->rememberToken();

            $table->datetime('password_updated_at')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
