<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->string("numfact")->nullable();
            $table->string("sigleclt")->nullable();
            $table->string("refprod")->nullable();
            $table->string("prod")->nullable();
            $table->integer("qtite")->nullable();
            $table->integer("pu")->nullable();
            $table->integer("mont")->nullable();
            $table->integer("t_remise")->nullable();
            $table->integer("remise")->nullable();
            $table->integer("netccial")->nullable();
            $table->string("t_escpte")->nullable();
            $table->string("escpte")->nullable();
            $table->integer("netfcier")->nullable();
            $table->integer("ttva")->nullable();
            $table->integer("mtva")->nullable();
            $table->integer("mttc")->nullable();
            $table->string("fr_vte")->nullable();
            $table->string("netpay")->nullable();
            $table->string("cptevte")->nullable();
            $table->string("cptec")->nullable();
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
        Schema::dropIfExists('ventes');
    }
};
