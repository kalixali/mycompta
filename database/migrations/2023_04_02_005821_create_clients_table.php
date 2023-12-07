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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string("sigleclt")->nullable();
            $table->string("client")->nullable();
            $table->string("cptec")->nullable();
            $table->string("contactc1")->nullable();
            $table->string("contactc2")->nullable();
            $table->string("emailc")->nullable();
            $table->string("adressec")->nullable();
            $table->string("sitgeoc")->nullable();
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
        Schema::dropIfExists('clients');
    }
};
