<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');

            $table->morphs('addressable');

            $table->integer('country_id')->unsigned()->index();
            $table->foreign('country_id')->references('id')->on('countries');

            $table->boolean('is_default')->default(true);
            $table->string('number')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('town')->nullable();
            $table->string('county')->nullable();
            $table->string('post_code')->nullable();

            $table->text('notes')->nullable();

            $table->float('lat', 10, 6)->nullable();
            $table->float('long', 10, 6)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
