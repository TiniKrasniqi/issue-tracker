<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('issue_tag', function (Blueprint $table) {
            $table->foreignId('issue_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();

            $table->primary(['issue_id', 'tag_id']);
            $table->index(['tag_id', 'issue_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('issue_tag');
    }
};
