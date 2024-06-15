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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('address',255)->nullable();
            $table->string('embed_url',255)->nullable();
            $table->boolean('address_status')->default(0);
            $table->bigInteger('mobile')->nullable();
            $table->boolean('mobile_status')->default(0);
            $table->bigInteger('whatsapp_number')->nullable();
            $table->boolean('whatsapp_number_status')->default(0);
            $table->string('email',255)->nullable();
            $table->boolean('email_status')->default(0);
            $table->string('website')->nullable();
            $table->boolean('website_status')->default(0);
        });

        // Insert default values into the address table
        DB::table('address')->insert([
            'address' => 'Noida',
            'embed_url' => '',
            'address_status' => true,
            'mobile' => '1234567890',
            'mobile_status' => true,
            'whatsapp_number' => '1234567890',
            'whatsapp_number_status' => true,
            'email' => 'demo@gmail.com',
            'email_status' => true,
            'website' => '',
            'website_status' => true
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
