<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldSendMailHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->boolean('send_email_expired_15_days')->default(0);
            $table->boolean('send_email_expired_10_days')->default(0);
            $table->boolean('send_email_expired_5_days')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('hotels', ['send_email_expired_15_days','send_email_expired_10_days','send_email_expired_5_days']);
    }
}
