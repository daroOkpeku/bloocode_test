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

        Schema::create('deletedjobs', function (Blueprint $table) {
            $table->id();
            $table->tinyText('job_name')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->tinyText('firstname');
            $table->tinyText('lastname')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deletedjobs');
    }
};
