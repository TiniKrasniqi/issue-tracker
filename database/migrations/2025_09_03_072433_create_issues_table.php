<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')->constrained()->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();

            // store as string + add check constraints (portable)
            $table->string('status', 20)->default('open')->index();
            $table->string('priority', 20)->default('medium')->index();

            $table->date('due_date')->nullable()->index();

            $table->timestamps();

            $table->index(['project_id', 'status']);
            $table->index(['project_id', 'priority']);
        });

        try {
            DB::statement("ALTER TABLE issues ADD CONSTRAINT chk_issues_status CHECK (status IN ('open','in_progress','closed'))");
            DB::statement("ALTER TABLE issues ADD CONSTRAINT chk_issues_priority CHECK (priority IN ('low','medium','high'))");
        } catch (\Throwable $e) {
            
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
