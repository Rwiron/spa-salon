<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // This will store the feature name
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('features');
    }

};