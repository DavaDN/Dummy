<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_modules', function (Blueprint $table) {
            $table->foreignUuid('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignUuid('module_id')->constrained('modules')->onDelete('cascade');
            $table->primary(['project_id', 'module_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_modules');
    }
};
