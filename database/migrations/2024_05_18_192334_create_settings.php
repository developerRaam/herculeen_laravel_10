<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo',255)->nullable();
            $table->string('site_name',255)->nullable();
            $table->string('site_description',400)->nullable();
            $table->boolean('status')->default(0);
        });

        // Insert default values into the settings table
        DB::table('settings')->insert([
            'logo' => 'default_logo.png',
            'site_name' => 'Your Site Name',
            'site_description' => 'Your Site Description',
            'status' => true
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
