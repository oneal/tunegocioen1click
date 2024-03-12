<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOfferPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_offer_positions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->default(0);
            $table->bigInteger('province_id')->default(0);
            $table->bigInteger('work_offer_id')->default(0);
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
        Schema::dropIfExists('work_offer_positions');
    }
}
