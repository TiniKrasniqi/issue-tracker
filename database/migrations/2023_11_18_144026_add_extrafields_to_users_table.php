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
        Schema::table('users', function (Blueprint $table) {
            // Adding the new columns
            $table->boolean('2fa_enabled')->default(0); // 0 or 1, not nullable
            $table->boolean('status')->default(1); // 0 or 1, not nullable
            $table->string('prefered_lang')->nullable(); // Can be null
            $table->string('country')->nullable(); // Can be null
            $table->string('city')->nullable(); // Can be null
            $table->enum('theme_mode', ['light', 'dark'])->nullable(); // 'light' or 'dark', can be null
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['2fa_enabled', 'status', 'prefered_lang', 'theme_mode', 'country','city']);
        });
    }
};
