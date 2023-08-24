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
        Schema::create('countries', function (Blueprint $table) {
            $table->string('id')->nullable(false)->primary();;
            $table->string('name');
            $table->string('youtube_video_title')->nullable();
            $table->text('youtube_video_description')->nullable();
            $table->string('thumbnail_default_url')->nullable();
            $table->integer('thumbnail_default_width')->nullable();
            $table->integer('thumbnail_default_height')->nullable();
            $table->string('thumbnail_high_url')->nullable();
            $table->integer('thumbnail_high_width')->nullable();
            $table->integer('thumbnail_high_height')->nullable();
            $table->text('country_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
