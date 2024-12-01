<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidesTable extends Migration
{
    public function up()
    {
        Schema::create('provides', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image_path')->nullable(); // Storing image paths
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('provides');
    }
}