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
        Schema::create('salaire', function (Blueprint $table) {
            $table->id();
            $table->string("matricule");
            $table->string("nom")->nullable();
            $table->string("prenoms")->nullable();
            $table->string("poste")->nullable();
            $table->string("categ")->nullable();
            $table->double("nbrepart", 8, 1)->nullable();
            $table->integer("salbase")->nullable();
            $table->integer("sursal")->nullable();
            $table->string("nation")->nullable();
            $table->integer("avg_logement")->nullable();
            $table->integer("avg_vehicule")->nullable();
            $table->integer("avg_otr")->nullable();
            $table->integer("totavtagenat")->nullable();
            $table->integer("prime_ancien")->nullable();
            $table->integer("prim_risq")->nullable();
            $table->integer("prime_otr")->nullable();
            $table->integer("totprimes")->nullable();
            $table->double("txhorair", 8, 2)->nullable();
            $table->integer("hsup15")->nullable();
            $table->integer("hsup50")->nullable();
            $table->integer("hsup75")->nullable();
            $table->integer("hsup100")->nullable();
            $table->integer("msup15")->nullable();
            $table->integer("msup50")->nullable();
            $table->integer("msup75")->nullable();
            $table->integer("msup100")->nullable();
            $table->integer("totmhs")->nullable();
            $table->integer("ind_nourriture")->nullable();
            $table->integer("ind_logement")->nullable();
            $table->integer("ind_otrtax")->nullable();
            $table->integer("totindemnitetax")->nullable();
            $table->integer("salbimp")->nullable();
            $table->integer("cr")->nullable();
            $table->integer("imps")->nullable();
            $table->integer("cn")->nullable();
            $table->integer("igr")->nullable();
            $table->integer("totficemp")->nullable();
            $table->integer("salnet")->nullable();
            $table->integer("ind_trsport")->nullable();
            $table->integer("ind_salissure")->nullable();
            $table->integer("ind_otr")->nullable();
            $table->integer("totindemnite")->nullable();
            $table->integer("accompte")->nullable();
            $table->integer("avance")->nullable();
            $table->integer("autres")->nullable();
            $table->integer("totretenues")->nullable();
            $table->integer("salpaye")->nullable();
            $table->string("cptabiliser")->nullable();
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
        Schema::dropIfExists('salaire');
    }
};
