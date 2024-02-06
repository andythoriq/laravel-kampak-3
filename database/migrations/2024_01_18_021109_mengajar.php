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
        Schema::create('trx_teachings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('m_teachers')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('m_subjects')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedInteger('class_id');
            $table->foreign('class_id')->references('id')->on('m_classes')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
