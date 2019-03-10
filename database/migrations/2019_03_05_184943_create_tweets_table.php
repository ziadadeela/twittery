<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('twitter_id');
            $table->unsignedInteger('user_id');
            $table->json('hashtags');
            $table->text('text')->nullable();
            $table->integer('retweet_count')->default(0);
            $table->integer('favorite_count')->default(0);
            $table->timestamp('twitter_created_at');
            $table->timestamps();


            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
}
