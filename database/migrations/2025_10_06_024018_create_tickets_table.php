<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 200);
            $table->text('description');
            $table->enum('status', ['pending', 'approved', 'completed'])->default('pending');
            $table->enum('type', ['call', 'chat', 'meet_offline', 'meet_online']);
            $table->foreignUuid('client_id')->nullable()->constrained('clients')->onDelete('set null');
            $table->foreignUuid('approved_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignUuid('project_id')->nullable()->constrained('projects')->onDelete('cascade');
            $table->timestamp('meeting_schedule')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('status', 'idx_ticket_status');
            $table->index('project_id', 'idx_ticket_project');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
