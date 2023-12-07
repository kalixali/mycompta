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
        Schema::create('entreprise', function (Blueprint $table) {
            $table->id();
            $table->string("sigle");
            $table->string("nom_complet")->nullable();
            $table->string("numCC")->nullable();
            $table->string("numRC")->nullable();
            $table->string("adresse")->nullable();
            $table->string("contact1")->nullable();
            $table->string("contact2")->nullable();
            $table->string("email")->nullable();
            $table->string("sitgeo")->nullable();
            $table->string("logo", 300)->nullable();
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
        Schema::dropIfExists('entreprise');
    }
};
