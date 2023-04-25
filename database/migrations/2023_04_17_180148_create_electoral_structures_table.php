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
        Schema::create('electoral_structures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('electoral_structure_id')->nullable();
            $table->integer('local_district')->length(5);
            $table->integer('federal_district')->length(5)->nullable();
            $table->foreignId('state_id');
            $table->foreignId('municipality_id')->nullable();
            $table->foreignId('section_id')->nullable();
            $table->foreignId('zone_id')->nullable();
            $table->string('description', 255);
            $table->integer('goal')->length(11);
            $table->integer('members')->length(11);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electoral_structures');
    }
};
