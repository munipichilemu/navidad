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
        Schema::create('inscritos', function (Blueprint $table) {
            $table->ulid('id');
            $table->rut('rut')->index();
            $table->string('names');
            $table->string('lastnames');
            $table->date('birthday');
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('sector_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscritos');
    }
};
