<?php

use App\Models\Teacher;
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
        Schema::create('academy_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('number_of_seats')->default(30);
            $table->integer('taken_seats')->default(0);
            $table->integer('available_seats')->default(30);
            $table->string('duration');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academy_classes');
    }
};
