<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeContentsTable extends Migration
{
    public function up()
    {
        Schema::create('home_contents', function (Blueprint $table) {
            $table->id();

            // Carousel content
            $table->string('carousel_text_1')->nullable();
            $table->string('carousel_text_2')->nullable();
            $table->string('carousel_text_3')->nullable();
            $table->string('carousel_image_1')->nullable(); // Image paths
            $table->string('carousel_image_2')->nullable();
            $table->string('carousel_image_3')->nullable();

            // About us section
            $table->string('about_us_title')->nullable();
            $table->text('about_us_description')->nullable();
            $table->string('about_us_image')->nullable(); // About image

            // Services Section
            $table->string('service_title')->nullable();
            $table->string('service_subtitle')->nullable();

            // Footer contact info (optional)
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_contents');
    }
}