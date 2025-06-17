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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique(); //Judul dari project
            $table->string('slug'); //Alamat dari Project yang akan ditampilkan di URL
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('user_id')->constrained(  //Foreign key ke tabel Users
                table: 'users', indexName: 'works_user_id'
            );
            $table->foreignId('category_id')->constrained(  //Foreign key ke tabel categories
                table: 'categories', indexName: 'works_category_id'
            );
            $table->string('thumbnail')->nullable(); //Gambar thumbnail dari project
            $table->text('excerpt')->nullable(); //Ringkasan pendek
            $table->string('link')->nullable(); //Link menuju project yg ada diplatform lain (behance, dribbble, dll)
            $table->boolean('has_page')->default(false); //Kondisi apakah project ini memiliki halaman detail atau tidak
            $table->text('description')->nullable(); // deskripsi isi lengkap dari project 
            $table->timestamp('published_at')->nullable(); //Waktu kapan project di Upload
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
