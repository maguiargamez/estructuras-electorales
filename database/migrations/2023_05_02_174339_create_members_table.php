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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('firstname', 255);
            $table->string('lastname', 255);            
            $table->boolean('sex')->default(true);
            $table->date('birth_date');

            $table->string('electoral_key', 255)->unique();
            $table->string('electoral_key_validity', 255);
            $table->string('curp', 18);
            $table->string('section', 255);
            $table->string('section_type', 255);
            $table->string('address', 255);
            $table->string('neighborhood', 255);
            $table->string('zip_code', 255);
            $table->boolean('membership')->default(false);
            $table->boolean('political_organization')->default(false);
            $table->foreignId('school_grade_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('activity_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('mobile_phone', 255);
            $table->string('house_phone', 255)->nullable();
            $table->string('email', 255);
            $table->boolean('has_social_networks')->default(false);

            $table->string('facebook', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('tiktok', 255)->nullable();

            $table->boolean('is_validated')->default(false);
            $table->boolean('was_supported')->default(false);
            
            $table->string('credential_front', 255)->nullable();
            $table->string('credential_back', 255)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
