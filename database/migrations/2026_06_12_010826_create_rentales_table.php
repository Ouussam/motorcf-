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
        Schema::create('rentales', function (Blueprint $table) {
           $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('total_price');
            $table->string('status');
            $table->string('nom_guets');
            $table->string('prenom_guets');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('rentales');
    }
};
