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
        Schema::create('borrow_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patron_type_id');
            $table->foreign('patron_type_id')->references('id')->on('patron_types')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedTinyInteger('max_books');
            $table->unsignedTinyInteger('borrow_days');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_settings');
    }
};
