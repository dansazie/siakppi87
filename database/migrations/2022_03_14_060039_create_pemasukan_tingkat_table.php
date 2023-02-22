<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemasukanTingkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasukan_tingkat', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pemasukan_id');
            $table->bigInteger('tingkat_id');
            $table->string('status');
            $table->bigInteger('tahunakademik_id');
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
        Schema::dropIfExists('pemasukan_tingkat');
    }
}
