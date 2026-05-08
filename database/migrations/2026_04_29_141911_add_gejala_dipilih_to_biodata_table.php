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
        Schema::table('biodata', function (Blueprint $table) {
            if (!Schema::hasColumn('biodata', 'gejala_dipilih')) {
                $table->longText('gejala_dipilih')->nullable()->after('jenis');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodata', function (Blueprint $table) {
            if (Schema::hasColumn('biodata', 'gejala_dipilih')) {
                $table->dropColumn('gejala_dipilih');
            }
        });
    }
};
