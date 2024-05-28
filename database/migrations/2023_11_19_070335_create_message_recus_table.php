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
        Schema::create('message_recus', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenon');
            $table->string('email');
            $table->string('sujet');
            $table->longText('introduction');
            $table->longText('contenu');
            $table->longText('fin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_recus');
    }
};
