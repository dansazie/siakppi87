<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRombelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rombels', function (Blueprint $table) {
            $table->id();
            $table->string('rombel');
            $table->bigInteger('tingkat_id')->nullable();
            $table->bigInteger('jurusan_id')->nullable();
            $table->bigInteger('tahunakademik_id')->nullable();
            $table->bigInteger('asatidz_id')->nullable();
            $table->string('status')->default('Aktif');
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
        Schema::dropIfExists('rombels');
    }
}
