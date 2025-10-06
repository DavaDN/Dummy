<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['DP', 'lunas', 'bulanan', 'tahunan']);
            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->foreignUuid('approved_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignUuid('project_id')->nullable()->constrained('projects')->onDelete('cascade');
            $table->date('due_date');
            $table->timestamp('created_at')->useCurrent();

            $table->index('due_date', 'idx_invoice_due_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
