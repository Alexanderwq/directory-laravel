<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('building_id')
                ->nullable()
                ->constrained('buildings')
                ->onDelete('cascade');
            $table->string('office_number')->nullable();
            $table->float('lat');
            $table->float('long');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['building_id']);
            $table->dropColumn(['building_id', 'office_number']);
        });
    }
};
