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
        Schema::create('rosters', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('user_id')->constrained();
            $table->string('proof')->nullable();
            $table->boolean('06:00');
            $table->boolean('06:30');
            $table->boolean('07:00');
            $table->boolean('07:30');
            $table->boolean('08:00');
            $table->boolean('08:30');
            $table->boolean('09:00');
            $table->boolean('09:30');
            $table->boolean('10:00');
            $table->boolean('10:30');
            $table->boolean('11:00');
            $table->boolean('11:30');
            $table->boolean('12:00');
            $table->boolean('12:30');
            $table->boolean('13:00');
            $table->boolean('13:30');
            $table->boolean('14:00');
            $table->boolean('14:30');
            $table->boolean('15:00');
            $table->boolean('15:30');
            $table->boolean('16:00');
            $table->boolean('16:30');
            $table->boolean('17:00');
            $table->boolean('17:30');
            $table->boolean('18:00');
            $table->boolean('18:30');
            $table->boolean('19:00');
            $table->boolean('19:30');
            $table->boolean('20:00');
            $table->boolean('20:30');
            $table->boolean('21:00');
            $table->boolean('21:30');
            $table->boolean('22:00');
            $table->boolean('22:30');
            $table->boolean('23:00');
            $table->boolean('23:30');
            $table->timestamps();
            $table->unique(['date', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rosters');
    }
};
