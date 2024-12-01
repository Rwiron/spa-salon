<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicePricingsTable extends Migration
{
    public function up()
    {
        Schema::create('service_pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_type_id')->constrained('service_types')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->string('currency', 10)->default('FRW');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_pricings');
    }
}