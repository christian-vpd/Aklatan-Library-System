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
        Schema::create('borrow_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('borrow_id');
            $table->foreign('borrow_id')->references('id')->on('borrows')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('book_copy_id');
            $table->foreign('book_copy_id')->references('id')->on('book_copies')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamp('returned_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_items');
    }
};
