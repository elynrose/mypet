<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('new_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('available_from')->nullable();
            $table->datetime('available_to')->nullable();
            $table->integer('credits');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
