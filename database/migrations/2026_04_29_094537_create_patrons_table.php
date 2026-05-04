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
        Schema::create('patrons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->string('patron_code');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable(true);
            $table->string('suffix')->nullable(true);
            $table->string('profile_picture')->nullable(true);
            $table->enum('gender', ['Male','Female']);
            $table->unsignedBigInteger('patron_type_id');
            $table->foreign('patron_type_id')->references('id')->on('patron_types')->onDelete('restrict')->onUpdate('cascade');
            $table->string('contact_number');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patrons');
    }
};
