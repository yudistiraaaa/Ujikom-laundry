<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_paket');
            $table->unsignedBigInteger('harga');
            $table->enum('jenis_paket', ['kiloan', 'selimut', 'bed_cover', 'kaos']);
            $table->bigInteger('outlet_id')->unsigned()->nullable();
            $table->foreign('outlet_id')->references('id')->on('outlets')->onDelete('cascade')->onIpfate('cascade');
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
        Schema::dropIfExists('packets');
    }
}
