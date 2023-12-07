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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string("siglefourn")->nullable();
            $table->string("fournisseur")->nullable();
            $table->string("cptef")->nullable();
            $table->string("contactf1")->nullable();
            $table->string("contactf2")->nullable();
            $table->string("emailf")->nullable();
            $table->string("adressef")->nullable();
            $table->string("sitgeof")->nullable();
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
        Schema::dropIfExists('fournisseurs');
    }
};
