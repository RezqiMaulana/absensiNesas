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
    Schema::create('exit_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('teacher_id')->constrained(); // Guru pengajar yang mengizinkan
            $table->foreignId('piket_id')->constrained('users'); // Piket yang memvalidasi
            $table->string('reason'); // Alasan keluar
            $table->time('leave_at'); // Jam keluar
            $table->time('return_at')->nullable(); // Jam kembali
            $table->enum('status', ['pending', 'approved', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exit_permissions');
    }
};
