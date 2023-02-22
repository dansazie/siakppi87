<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Pendidikan;
use App\Models\User;

class CreateAsatidzsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asatidzs', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20)->unique();
            $table->string('nik', 20)->nullable();
            $table->string('nuptk', 20)->nullable();
            $table->string('namalengkap', 100);
            $table->string('tmplahir', 100);
            $table->date('tgllahir');
            $table->string('kelamin', 2)->default('L');
            $table->string('alamat', 100);
            $table->foreignIdFor(Provinsi::class);
            $table->foreignIdFor(Kabupaten::class);
            $table->foreignIdFor(Kecamatan::class);
            $table->foreignIdFor(Desa::class);
            $table->foreignIdFor(Pendidikan::class);
            $table->foreignIdFor(User::class);
            $table->string('photo')->nullable();
            $table->string('status', 20)->default('Aktif');
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
        Schema::dropIfExists('asatidzs');
    }
}
