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
        Schema::create('cotficpat', function (Blueprint $table) {
            $table->id();
            $table->string("matricule");
            $table->string("nom")->nullable();
            $table->string("prenoms")->nullable();
            $table->string("nation")->nullable();
            $table->integer("salbimp")->nullable();
            $table->integer("t_is_p")->nullable();
            $table->integer("is_p")->nullable();
            $table->integer("t_ta_fdfp")->nullable();
            $table->integer("ta_fdfp")->nullable();
            $table->integer("t_fpc_fdfp")->nullable();
            $table->integer("fpc_fdfp")->nullable();
            $table->string("cptabiliser_fisc")->nullable();
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
        Schema::dropIfExists('cotficpat');
    }
};
