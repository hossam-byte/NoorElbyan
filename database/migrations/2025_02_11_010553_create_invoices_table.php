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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->string('term');
            $table->string('kind');
            $table->integer('bus_subscription');
            $table->integer('uniform_subscription');
            $table->integer('discount');
            $table->integer('main_subscription');
            $table->integer('total_amount');
            $table->integer('paied_amount');
            $table->integer('remaining_amount')->default(0);
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
