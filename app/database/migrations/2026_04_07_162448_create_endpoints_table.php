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
        Schema::create('endpoints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('url');
            $table->string('method', 10)->default('GET');

            $table->jsonb('headers')->nullable();
            $table->jsonb('body')->nullable();

            $table->integer('expected_status')->default(200);
            $table->integer('timeout_ms')->default(5000);
            $table->integer('interval_seconds')->default(60);

            $table->boolean('is_active')->default(true);

            $table->timestamp('last_checked_at')->nullable();
            $table->boolean('last_status')->nullable();
            $table->integer('last_response_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endpoints');
    }
};
