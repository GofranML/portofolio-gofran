
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('agents')) {
            Schema::create('agents', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('type')->default('external');
                $table->string('role')->nullable();
                $table->string('company_name')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->string('avatar')->nullable();
                $table->string('website')->nullable();
                $table->json('metadata')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('resources')) {
            Schema::create('resources', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('type');
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
        }

        if (!Schema::hasTable('events')) {
            Schema::create('events', function (Blueprint $table) {
                $table->id();
                $table->foreignId('agent_id')
                    ->nullable()
                    ->constrained('agents')
                    ->nullOnDelete();
                $table->string('title');
                $table->string('type');
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
        }

        if (
            !Schema::hasTable('event_resource')
            && Schema::hasTable('events')
            && Schema::hasTable('resources')
        ) {
            Schema::create('event_resource', function (Blueprint $table) {
                $table->id();
                $table->foreignId('event_id')
                    ->constrained('events')
                    ->cascadeOnDelete();
                $table->foreignId('resource_id')
                    ->constrained('resources')
                    ->cascadeOnDelete();
                $table->string('relationship_type')->default('uses');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // Sengaja tidak menghapus tabel produksi.
    }
};
