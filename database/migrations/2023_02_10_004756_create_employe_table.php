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
        Schema::create('employe', function (Blueprint $table) {
            $table->id();
            $table->string("matricule");
            $table->string("nom")->nullable();
            $table->string("prenoms")->nullable();
            $table->string("datenais")->nullable();
            $table->string("lieunais")->nullable();
            $table->string("nation")->nullable();
            $table->string("poste")->nullable();
            $table->string("datearriv")->nullable();
            $table->string("datemb")->nullable();
            $table->string("ancien")->nullable();
            $table->string("sitmat")->nullable();
            $table->integer("nbrenft")->nullable();
            $table->double("nbrepart", 8, 1)->nullable();
            $table->string("categ")->nullable();
            $table->double("txhorair", 8, 2)->nullable();
            $table->integer("salbase")->nullable();
            $table->integer("sursal")->nullable();
            $table->string("photo", 300)->nullable();
            $table->string("description")->nullable();
            $table->integer("avg_logement")->nullable();
            $table->integer("avg_vehicule")->nullable();
            $table->integer("avg_otr")->nullable();
            $table->integer("prime_ancien")->nullable();
            $table->integer("prime_diplo")->nullable();
            $table->integer("prime_rendement")->nullable();
            $table->integer("prim_risq")->nullable();
            $table->integer("prime_otr")->nullable();
            $table->integer("ind_salissure")->nullable();
            $table->integer("ind_trsport")->nullable();
            $table->integer("ind_outillage")->nullable();
            $table->integer("ind_tournee")->nullable();
            $table->integer("ind_otr")->nullable();
            $table->integer("ind_logement")->nullable();
            $table->integer("ind_nourriture")->nullable();
            $table->integer("ind_otrtax")->nullable();
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
        Schema::dropIfExists('employe');
    }
};
