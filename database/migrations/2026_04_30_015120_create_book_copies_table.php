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
        Schema::create('book_copies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('restrict')->onUpdate('cascade');
            $table->string('ascension_number')->unique();
            $table->string('barcode')->nullable()->unique();
            $table->enum('status', ['available', 'borrowed', 'reserved', 'lost', 'damaged'])->default('available');
            $table->enum('condition', ['new', 'good', 'fair', 'poor'])->default('good');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_copies');
    }
};
