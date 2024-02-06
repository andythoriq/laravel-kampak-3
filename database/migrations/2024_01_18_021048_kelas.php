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
        Schema::create('m_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('grade',['X', 'XI', 'XII','XIII']);
            $table->enum('major',['DKV','BKP', 'DPIB', 'RPL', 'SIJA', 'TKJ', 'TOI', 'TKR', 'TFLM']);
            $table->enum('group',['1','2','3','4']);
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
