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
        Schema::disableForeignKeyConstraints();
        Schema::create('maintenance_piecereche', function (Blueprint $table) {
          
    $table->foreignId('maintenance_id')->constrained()->cascadeOnDelete();

    $table->foreignId('piece_id')->constrained()->cascadeOnDelete();

    $table->primary(['maintenance_id', 'piece_id']);

    $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_piecereche');
    }
};
