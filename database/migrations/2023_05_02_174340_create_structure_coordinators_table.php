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
        Schema::create('structure_coordinators', function (Blueprint $table) {
            $table->id();

            $table->foreignId('election_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('position_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();            
            $table->foreignId('structure_coordinator_id')->nullable();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('entity_key')->length(5);
            $table->string('entity', 255);            
            $table->integer('federal_district')->length(5)->nullable();
            $table->integer('local_district')->length(5)->nullable();
            $table->integer('municipality_key')->length(5)->nullable();
            $table->string('municipality', 255)->nullable(); 
            $table->integer('zone_key')->length(5)->nullable();
            $table->string('zone', 255)->nullable();  
            $table->integer('section')->length(5)->nullable();
            
            $table->integer('goal')->length(11)->nullable(); 

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structure_coordinators');
    }
};
