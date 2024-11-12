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
        Schema::table('forms', function (Blueprint $table) {
            $table->string('document3_additional_info')->nullable(); // ลบช่องว่าง
            $table->string('document4_additional_info')->nullable(); // ลบช่องว่าง
        });
    }

    public function down(): void
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->dropColumn('document3_additional_info');
            $table->dropColumn('document4_additional_info');
        });
    }
};
