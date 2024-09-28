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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('milestone_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
            $table->date('due_date');
            $table->foreignId('assigned_to')->nullable()->constrained('team_members')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
