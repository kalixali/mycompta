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
        Schema::create('stockactu', function (Blueprint $table) {
            $table->id();
            $table->string("refprod")->unique();
            $table->string("prod")->unique();
            $table->integer("qtite");
            $table->integer("pu");
            $table->double("mont", 8, 0);
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
        Schema::dropIfExists('stockactu');
    }
};
