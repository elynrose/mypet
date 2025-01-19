<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToNewRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('new_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('pet_id')->nullable();
            $table->foreign('pet_id', 'pet_fk_10397474')->references('id')->on('pets');
            $table->unsignedBigInteger('booked_by_id')->nullable();
            $table->foreign('booked_by_id', 'booked_by_fk_10397479')->references('id')->on('users');
        });
    }
}
