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
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->string('fine_code')->unique(); //FIN-2026-0001
            $table->unsignedBigInteger('patron_id');
            $table->foreign('patron_id')->references('id')->on('patrons')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('borrow_item_id');
            $table->foreign('borrow_item_id')->references('id')->on('borrow_items')->onDelete('restrict')->onUpdate('cascade');
            $table->enum('type', ['overdue', 'lost', 'damaged']);
            $table->decimal('amount', 8, 2);
            $table->enum('status', ['unpaid', 'paid', 'waived']);
            $table->timestamp('paid_at')->nullable();
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
        Schema::dropIfExists('fines');
    }
};
