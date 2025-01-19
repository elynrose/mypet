<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMemberReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('member_reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10397352')->references('id')->on('users');
            $table->unsignedBigInteger('submitted_by_id')->nullable();
            $table->foreign('submitted_by_id', 'submitted_by_fk_10397355')->references('id')->on('users');
        });
    }
}
