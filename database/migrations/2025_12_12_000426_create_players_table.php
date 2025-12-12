<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // отображаемое имя
            $table->string('fullname')->nullable(); // полное имя
            $table->string('position')->nullable();
            $table->string('team', 10)->nullable();
            $table->integer('number')->nullable();
            $table->text('img_url')->nullable();

            $table->string('height')->nullable(); // храню как string "198 см"
            $table->string('weight')->nullable(); // "98 кг"
            $table->integer('age')->nullable();

            $table->decimal('ppg', 5, 2)->nullable(); // очки за матч
            $table->decimal('rpg', 5, 2)->nullable(); // подборы
            $table->decimal('apg', 5, 2)->nullable(); // передачи

            $table->text('bio')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};