<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiPerTahunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_per_tahuns', function (Blueprint $table) {
            $table->integer('tahun');
            $table->foreign('tahun')->references("tahun")->on('years')->onDelete('cascade');
            $table->float('nilai', 9, 2);
            $table->foreignId('indikator_satuan_id')->constrained('indikator_satuans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_per_tahuns');
    }
}
