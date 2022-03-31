<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('designation');
            $table->string('adresse')->nullable();
            $table->unsignedBigInteger('stock_id');
            $table->timestamps();
        });

        Schema::table('enterprises', function (Blueprint $table) {
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
        Schema::dropIfExists('enterprises');
    }
}
