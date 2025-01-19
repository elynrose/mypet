<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('age');
            $table->string('gender');
            $table->string('notes')->nullable();
            $table->boolean('not_available')->default(0)->nullable();
            $table->datetime('available_from')->nullable();
            $table->datetime('available_to')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
