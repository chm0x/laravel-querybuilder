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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            # Llave Foranea
            // $table->unsignedBigInteger('user_id');
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->text('excerpt')
                  ->comment('Summary of the Post');
            $table->longText('description');
            $table->boolean('is_published')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('min_to_read')->nullable();

            $table->softDeletes();
            $table->timestamps();

            # COnstraints para Foreign Key
            // $table->foreign('user_id')
            //       ->references('id')
            //       ->on('users')
            //       ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
