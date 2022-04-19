<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('qte');
            $table->text('prix');
            $table->text('ref_created')->nullable();
            $table->boolean('approve')->nullable();
            $table->boolean('execute')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('ordergroup_id');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreign('ordergroup_id')->references('id')->on('ordergroups')->onUpdate('cascade') ->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
