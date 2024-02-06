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
        Schema::create('trx_assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teaching_id');
            $table->foreign('teaching_id')->references('id')->on('trx_teachings')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('id')->on('m_students')->cascadeOnDelete()->cascadeOnUpdate();

            $table->double('uh');
            $table->double('uts');
            $table->double('uas');
            $table->double('na');
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
