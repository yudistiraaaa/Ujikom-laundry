<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_invoice')->unique();
            $table->date('invoice_created');
            $table->date('invoice_expire');
            $table->date('tgl_bayar');
            $table->string('status_laundry')->default('PROSES');
            $table->string('status_pembayaran')->default('UNPAID');
            $table->bigInteger('outlet_id')->unsigned()->nullable();
            $table->foreign('outlet_id')->references('id')->on('outlets')->onDelete('cascade')->onIpfate('cascade');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onIpfate('cascade');
            $table->bigInteger('member_id')->unsigned()->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade')->onIpfate('cascade');
            $table->bigInteger('packet_id')->unsigned()->nullable();
            $table->foreign('packet_id')->references('id')->on('packets')->onDelete('cascade')->onIpfate('cascade');
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
        Schema::dropIfExists('transactions');
    }
}
