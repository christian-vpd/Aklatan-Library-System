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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_code')->unique();
            $table->unsignedBigInteger('patron_id');
            $table->foreign('patron_id')->references('id')->on('patrons')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('book_copy_id');
            $table->foreign('book_copy_id')->references('id')->on('book_copies')->onDelete('restrict')->onUpdate('cascade');
            $table->enum('status', ['pending', 'available', 'claimed']);
            $table->timestamp('reserved_at');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
