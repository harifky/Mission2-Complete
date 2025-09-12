<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->cascadeOnDelete();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->cascadeOnDelete();
            $table->timestamp('enroll_date')->useCurrent();
            $table->timestamps();

            $table->unique(['mahasiswa_id','mata_kuliah_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
}
