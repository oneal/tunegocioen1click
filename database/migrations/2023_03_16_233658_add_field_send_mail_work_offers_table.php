<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldSendMailWorkOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_offers', function (Blueprint $table) {
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
        Schema::dropColumns('work_offers', ['send_email_expired_15_days','send_email_expired_10_days','send_email_expired_5_days']);
    }
}
