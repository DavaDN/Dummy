<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('type', ['email', 'push']);
            $table->text('content');
            $table->foreignUuid('client_id')->nullable()->constrained('clients')->onDelete('set null');
            $table->foreignUuid('admin_id')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamp('sent_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
