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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username',50);
            $table->string('password',255);
            $table->string('firstname',50);
            $table->string('lastname',50);
            $table->string('email',50);
            $table->string('image',255)->nullable();
            $table->string('ip',50)->nullable();
            $table->boolean('status')->default(0);
            $table->integer('admin_group_id')->length(11)->default(0);
            $table->timestamps();
        });

        // Insert default values into the admins table
        DB::table('admins')->insert([
            'username' => 'admin',
            'password' => '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918',
            'firstname' => 'admin',
            'lastname' => 'admin',
            'email' => 'admin@gmail.com',
            'image' => NULL,
            'ip' => NULL,
            'status' => 1,
            'admin_group_id' => 0,
            'created_at' => '2024-04-24 19:58:10',
            'updated_at' => '2024-04-24 19:58:10'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
