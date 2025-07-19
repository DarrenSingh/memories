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
        Schema::create('memories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loved_one_id')->constrained()->onDelete('cascade');
            $table->string('photo_upload')->nullable();
            $table->text('content');
            $table->unsignedInteger('likes')->default(0);
            $table->boolean('is_anonymous')->default(false);
            $table->string('submitter_name')->nullable();
            $table->string('submitter_email')->nullable();
            $table->timestamp('submission_date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memories');
    }
};
