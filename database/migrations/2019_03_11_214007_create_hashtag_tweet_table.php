<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashtagTweetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashtag_tweet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hashtag_id');
            $table->bigInteger('tweet_id');

            $table->foreign('hashtag_id')->references('id')
                ->on('hashtags')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tweet_id')->references('id')
                ->on('tweets')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hashtag_tweet');
    }
}
