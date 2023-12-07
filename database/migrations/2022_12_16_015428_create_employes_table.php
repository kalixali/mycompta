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
        Schema::create('employes', function (Blueprint $table) {
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
            $table->string("description")->nullable();
            $table->string("photo", 300)->nullable();
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
        Schema::dropIfExists('employes');
    }
};
