<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomprod');
            $table->string('nbpv');
            $table->string('prixpartenaire');
            $table->string('prixclient');
            $table->string('qte');
            $table->string('image');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('stock_id');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::table('products', function (Blueprint $table) {
            $table->foreign('categorie_id')->references('id')->on('categories')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stocks')->onUpdate('cascade') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
