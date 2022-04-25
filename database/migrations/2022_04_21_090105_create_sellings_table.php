<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('qte_vendu');
            $table->string('ca');
            $table->string('srd'); //stock restant du
            $table->string('vs');  //valeur du stock
            $table->string('ecart');  //ecart (ca - montant total de cmde obtenue)
            $table->string('status');  //il y a ecart ou non
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade') ->onDelete('cascade');
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
        Schema::dropIfExists('sellings');
    }
}
