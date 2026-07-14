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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('cost');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');
            $table->string('nom_guets')->nullable();
            $table->string('prenom_guets')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('motor_id');
            $table->foreign('motor_id')->references('id')->on('motorcycles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
