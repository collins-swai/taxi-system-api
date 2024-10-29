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
        $table->timestamps(); // This will add `created_at` and `updated_at`
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropTimestamps();
    });
}
};
