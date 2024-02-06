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
        Schema::create('m_students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nis')->unique();
            $table->string('name');
            $table->enum('gender',['L','P']);
            $table->text('address');
            $table->unsignedInteger('class_id');
            $table->foreign('class_id')->references('id')->on('m_classes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('password');
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
