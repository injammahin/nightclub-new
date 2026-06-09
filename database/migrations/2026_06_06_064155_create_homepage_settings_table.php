<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage_settings', function (Blueprint $table) {
            $table->id();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->string('hero_video')->nullable();
            $table->string('hero_poster')->nullable();
            $table->string('hero_eyebrow')->nullable();
            $table->string('hero_title_top')->nullable();
            $table->string('hero_title_highlight')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_primary_button_text')->nullable();
            $table->string('hero_primary_button_url')->nullable();
            $table->string('hero_secondary_button_text')->nullable();
            $table->string('hero_secondary_button_url')->nullable();

            $table->string('call_label')->nullable();
            $table->string('call_phone')->nullable();
            $table->string('call_phone_link')->nullable();

            $table->text('marquee_text')->nullable();

            $table->string('happy_image')->nullable();
            $table->string('happy_eyebrow')->nullable();
            $table->string('happy_title')->nullable();
            $table->text('happy_description')->nullable();
            $table->json('happy_cards')->nullable();

            $table->string('why_eyebrow')->nullable();
            $table->string('why_title')->nullable();
            $table->text('why_description')->nullable();
            $table->json('why_cards')->nullable();
            $table->string('why_image')->nullable();

            $table->string('entertainment_eyebrow')->nullable();
            $table->string('entertainment_title')->nullable();
            $table->text('entertainment_description')->nullable();
            $table->json('entertainment_cards')->nullable();

            $table->string('contact_eyebrow')->nullable();
            $table->string('contact_title')->nullable();
            $table->text('contact_description')->nullable();
            $table->string('contact_button_text')->nullable();
            $table->string('contact_button_url')->nullable();
            $table->string('contact_secondary_button_text')->nullable();
            $table->string('contact_secondary_button_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_settings');
    }
};