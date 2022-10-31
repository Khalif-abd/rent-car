<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {


    public function up(): void
    {
        Schema::create('cars_models', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->foreignId('brand_id')->constrained('cars_brands')->cascadeOnDelete();
            $table->timestamps();
        });
    }



    public function down(): void
    {
        Schema::dropIfExists('models');
    }
};
