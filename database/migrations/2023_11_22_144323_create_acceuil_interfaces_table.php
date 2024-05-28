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
        Schema::create('acceuil_interfaces', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->longText('contenu_1');
            $table->string('image')->nullable();
            $table->longText('liste')->nullable();
            $table->longText('contenu_2')->nullable();
            $table->string('status')->nullable()->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acceuil_interfaces');
    }
};
