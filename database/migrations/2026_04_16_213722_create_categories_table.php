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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();                                      // primary key
            $table->foreignId('parent_id');                    // 0 = top-level, otherwise points to parent category id
            $table->string('title');                           // category name e.g. "Electronics"
            $table->string('slug');                            // URL-friendly version e.g. "electronics"
            $table->string('keywords')->nullable();            // SEO keywords
            $table->text('description')->nullable();           // category description
            $table->string('image')->nullable();               // category image filename
            $table->tinyInteger('status')->default(1);         // 1 = active, 0 = inactive
            $table->timestamps();                              // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
