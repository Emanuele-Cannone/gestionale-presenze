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
        Schema::create('progen_customer_user', function (Blueprint $table) {
            $table->primary(['user_id', 'progen_customer_id']);
            $table->string('user_type');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('progen_customer_id')->constrained();
            $table->boolean('leader')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progen_customer_user');
    }
};
