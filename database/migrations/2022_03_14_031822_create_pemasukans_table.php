<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemasukansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasukans', function (Blueprint $table) {
            $table->id();
            $table->string('namapemasukan', 100);
            $table->string('deskripsi')->nullable();
            $table->double('nominal');
            $table->string('is_pemasukansantri',10);
            $table->bigInteger('tingkat_id')->nullable();
            $table->bigInteger('tahunakademik_id')->nullable();
            $table->date('tglmulai')->nullable();
            $table->date('tglakhir')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemasukans');
    }
}
