<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTampungDataTmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tampung_data_tms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('kode');
            $table->foreignId('data_pemilih_id');
            $table->foreignId('data_tms_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tampung_data_tms');
    }
}
