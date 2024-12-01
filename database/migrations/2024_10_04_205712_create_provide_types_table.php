<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvideTypesTable extends Migration
{
    public function up()
    {
        Schema::create('provide_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provide_id')->constrained('provides')->onDelete('cascade');
            $table->string('type_name');
            $table->text('description');
            $table->decimal('price', 8, 2); // Price for the service type
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('provide_types');
    }
}