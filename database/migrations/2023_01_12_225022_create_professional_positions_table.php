<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_positions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->default(0);
            $table->bigInteger('province_id')->default(0);
            $table->bigInteger('professional_id')->default(0);
            $table->string('name', 10);
            $table->boolean('in_used')->default(0);
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
        Schema::dropIfExists('professional_positions');
    }
}
