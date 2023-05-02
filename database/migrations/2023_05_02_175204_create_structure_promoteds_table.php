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
        Schema::create('structure_promoteds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('structure_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();;
            $table->foreignId('structure_coordinator_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();;      
            $table->foreignId('member_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();;      
            $table->boolean('confirmation')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structure_promoteds');
    }
};
