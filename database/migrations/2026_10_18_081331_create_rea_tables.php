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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('external'); // 'internal', 'external', 'organization'
            $table->string('role')->nullable();
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->string('website')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type'); // 'project', 'skill', 'strength', 'certification', 'education'
            $table->string('category')->nullable();
            $table->string('year')->nullable();
            $table->text('description')->nullable();
            $table->json('points')->nullable();
            $table->json('stack')->nullable();
            $table->string('image_url')->nullable();
            $table->string('external_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->nullable()->constrained('agents')->nullOnDelete();
            $table->string('title');
            $table->string('type'); // 'work_experience', 'project_milestone', 'education_milestone', 'contact_inquiry'
            $table->string('organization')->nullable();
            $table->string('role_title')->nullable();
            $table->string('period')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->text('summary')->nullable();
            $table->json('details')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('event_resource', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('resource_id')->constrained('resources')->cascadeOnDelete();
            $table->string('relationship_type')->default('uses'); // 'uses', 'produces', 'showcases'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_resource');
        Schema::dropIfExists('events');
        Schema::dropIfExists('resources');
        Schema::dropIfExists('agents');
    }
};
