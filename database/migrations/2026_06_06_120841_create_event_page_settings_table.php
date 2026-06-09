<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_page_settings', function (Blueprint $table) {
            $table->id();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->string('hero_video')->nullable();
            $table->string('hero_eyebrow')->nullable();
            $table->string('hero_title_top')->nullable();
            $table->string('hero_title_highlight')->nullable();
            $table->text('hero_description')->nullable();

            $table->string('hero_primary_button_text')->nullable();
            $table->string('hero_primary_button_url')->nullable();
            $table->string('hero_secondary_button_text')->nullable();
            $table->string('hero_secondary_button_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_page_settings');
    }
};