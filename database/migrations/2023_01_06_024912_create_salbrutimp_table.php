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
        Schema::create('salbrutimp', function (Blueprint $table) {
            $table->id();
            $table->string("matricule");
            $table->integer("salbase");
            $table->integer("sursal")->nullable();
            $table->integer("totprimes")->nullable();
            $table->integer("totavtagenat")->nullable();
            $table->integer("totmhs")->nullable();
            $table->integer("totindemnite")->nullable();
            $table->integer("totindemnitetax")->nullable();
            $table->integer("totsocemp")->nullable();
            $table->integer("totficemp")->nullable();
            $table->integer("salbimp");
            $table->integer("salnet")->nullable();
            $table->integer("salpaye")->nullable();
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
        Schema::dropIfExists('salbrutimp');
    }
};
