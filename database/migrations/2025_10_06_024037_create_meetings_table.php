<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('ticket_id')->unique()->constrained('tickets')->onDelete('cascade');
            $table->timestamp('schedule_date');
            $table->text('summary')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
