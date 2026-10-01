<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('AUTORES', function (Blueprint $table) {
            $table->id('AUTCODIGO');
            $table->string('AUTNOME', 150);
            $table->string('AUTPSEUDONIMO', 150)->nullable();
            $table->text('AUTBIOGRAFIA')->nullable();
            $table->string('AUTPAISNASC', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('AUTORES');
    }
};