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
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->string('borrow_code')->unique();
            $table->unsignedBigInteger('patron_id');
            $table->foreign('patron_id')->references('id')->on('patrons')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('librarian');
            $table->foreign('librarian')->references('id')->on('librarians')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamp('borrowed_at');
            $table->date('due_date');
            $table->enum('status', ['borrowed', 'returned', 'overdue', 'lost']);
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};
