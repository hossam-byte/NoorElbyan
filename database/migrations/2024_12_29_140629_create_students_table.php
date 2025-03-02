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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->date('birthdate');
            $table->string('father_phone');
            $table->string('alt_father_phone')->nullable();
            $table->string('address');
            $table->date('submission_date')->default(now());
            $table->string('duration');
            $table->foreignId('academy_class_id')->constrained('academy_classes');
            $table->string('bus_name')->nullable();
            $table->string('pricing_plan');
            $table->string('img')->nullable();
            $table->boolean('is_archive')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
