<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPetReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('pet_reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('pet_id')->nullable();
            $table->foreign('pet_id', 'pet_fk_10397360')->references('id')->on('pets');
            $table->unsignedBigInteger('submitted_by_id')->nullable();
            $table->foreign('submitted_by_id', 'submitted_by_fk_10397363')->references('id')->on('users');
        });
    }
}
