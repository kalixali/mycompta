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
        Schema::create('cotsocpats', function (Blueprint $table) {
            $table->id();
            $table->string("matricule");
            $table->integer("salbimp")->nullable();
            $table->integer("t_prest_fam")->nullable();
            $table->integer("prest_fam")->nullable();
            $table->integer("t_acc_trv")->nullable();
            $table->integer("acc_trv")->nullable();
            $table->integer("t_cr_p")->nullable();
            $table->integer("cr_p")->nullable();
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
        Schema::dropIfExists('cotsocpat');
    }
};
