<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('open_hours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->string('weekday_hours'); // For Mon - Fri hours
            $table->string('saturday_hours'); // For Saturday hours
            $table->string('sunday_hours'); // For Sunday hours
            $table->string('image_path')->nullable(); // For storing image
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('open_hours');
    }
};