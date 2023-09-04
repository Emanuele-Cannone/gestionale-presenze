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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('surname');
            $table->string('personal_email')->unique();
            $table->string('address');
            $table->string('city');
            $table->smallInteger('cap');
            $table->string('country', 2);
            $table->string('tax_code');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('iban');
            $table->tinyInteger('telephone_number');
            $table->string('degree');
            $table->string('document_type');
            $table->string('document_number');
            $table->date('document_expiry');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};
