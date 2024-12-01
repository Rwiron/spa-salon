<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTariffsTable extends Migration
{
    public function up()
    {
        Schema::create('tariffs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->timestamp('available_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->string('file_path'); // For storing the file path of the uploaded tariff
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tariffs');
    }
}
