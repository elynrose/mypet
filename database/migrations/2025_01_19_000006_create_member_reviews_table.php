<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('member_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('score');
            $table->longText('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
