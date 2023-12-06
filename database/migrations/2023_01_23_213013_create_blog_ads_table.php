<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs_ads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('blog_id')->default(0);
            $table->string('image', 150)->nullable();
            $table->boolean('visible')->default(0);
            $table->dateTime('date_start')->nullable();
            $table->string('visible_text',10)->default('no')->nullable();
            $table->dateTime('date_end')->nullable();
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
        Schema::dropIfExists('blog_ads');
    }
};
