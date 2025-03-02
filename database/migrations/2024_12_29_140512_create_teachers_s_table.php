<?php

use App\Models\AcademyClass;
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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->date('birthdate');
            $table->string('phone_number');
            $table->string('education');
            $table->string('address');
            $table->date('hiring_date')->default(now());
            $table->string('subject');
            $table->string('duration');
            $table->foreignId('academy_class_id')->constrained('academy_classes');
            $table->integer('salary');
            $table->boolean('is_archive')->default(false);
            $table->string('img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
