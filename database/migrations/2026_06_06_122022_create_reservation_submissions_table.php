<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservation_submissions', function (Blueprint $table) {
            $table->id();

            $table->string('selected_package')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('event_date')->nullable();
            $table->string('request_type')->nullable();
            $table->string('guests')->nullable();
            $table->text('message')->nullable();

            $table->string('status')->default('new'); // new, contacted, confirmed, cancelled
            $table->timestamp('read_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation_submissions');
    }
};