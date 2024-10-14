<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->integer('customer_id');
            $table->string('name')->nullable();
            $table->bigInteger('contact');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('city', 50);
            $table->integer('state_id');
            $table->integer('country_id');
            $table->integer('default');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
