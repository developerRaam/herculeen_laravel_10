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
            $table->integer('customer_id')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('firstname')->nullable();
            $table->timestamps();
            
 			// company	address_1	address_2	city	postcode	country_id	zone_id	custom_field	default
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
