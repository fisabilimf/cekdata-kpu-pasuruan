<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTampungDataBarusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tampung_data_barus', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("nkk");
            $table->string("nik");
            $table->string("nama");
            $table->string("tempat_l");
            $table->date("tanggal_l");
            $table->string("status");
            $table->string("jenkel");
            $table->string("jln_dukuh");
            $table->integer("rt");
            $table->integer("rw");
            $table->integer("disabilitas");
            $table->foreignId('data_baru_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tampung_data_barus');
    }
}
