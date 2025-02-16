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
        Schema::table('users', function (Blueprint $table) {

            

           // $table->foreignId('class_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('academic_year_id')->constrained()->onDelete('cascade');
            $table->string('admission_date')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mobno')->nullable();
            $table->string('dob')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('class_id');
        Schema::dropColumns('academic_year_id');
        Schema::dropColumns('admission_date');
        Schema::dropColumns('father_name');
        Schema::dropColumns('mother_name');
        Schema::dropColumns('mobno');
        Schema::dropColumns('dob');

    }
};
