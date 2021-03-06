<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('adresse');
            $table->string('tel');
            $table->string('status')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->nullable();
            $table->boolean('is_magasinier')->nullable();
            $table->tinyInteger('isban')->default('0');
            $table->unsignedBigInteger('enterprise_id');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('enterprise_id')->references('id')->on('enterprises')->onUpdate('cascade') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn('control');
            Schema::dropIfExists('users');
        });

    }
}
