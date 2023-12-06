<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('position_id');
            $table->string('num_fact')->nullable();
            $table->string('code', 20)->nullable();
            $table->string('phone', 9)->nullable();
            $table->string('email', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('address', 150)->nullable();
            $table->string('image', 150)->nullable();
            $table->string('icon', 150)->nullable();
            $table->boolean('visible')->default(0);
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
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
        Schema::dropIfExists('homes');
    }
}
