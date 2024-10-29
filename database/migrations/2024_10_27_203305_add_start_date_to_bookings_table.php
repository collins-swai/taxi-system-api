<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dateTime('start_date')->nullable(); // Adjust type and nullability as needed
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropColumn('start_date');
    });
}
};
