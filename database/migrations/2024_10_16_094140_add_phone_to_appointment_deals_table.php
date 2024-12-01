<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('appointment_deals', function (Blueprint $table) {
            $table->string('phone', 15)->nullable(); // Adjust the length as per your requirements
        });
    }

    public function down()
    {
        Schema::table('appointment_deals', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }

};