<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();

            // The crucial relationship columns
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('users'); // <-- This is the column it was looking for!

            // Vitals
            $table->string('blood_pressure')->nullable();
            $table->integer('heart_rate')->nullable();
            $table->decimal('temperature', 4, 1)->nullable();
            $table->decimal('weight_kg', 5, 1)->nullable();

            // Medical Data
            $table->text('chief_complaint')->nullable();
            $table->text('assessment')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('prescription')->nullable();

            // Workflow
            $table->string('status')->default('Pending Doctor Review');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
