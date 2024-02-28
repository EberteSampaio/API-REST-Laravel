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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_name',150);
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('genre_id');
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table){
            $table->dropForeign(['author_id']);
        });

        Schema::table('books', function (Blueprint $table){
            $table->dropForeign(['genre_id']);
        });

        Schema::dropIfExists('books');
    }
};
