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
        Schema::table('acceuil_interfaces', function (Blueprint $table) {
            $table->string('suprimer')->nullable()->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acceuil_interfaces', function (Blueprint $table) {
            $table->dropColumn('suprimer');
        });
    }
};
