<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('element_id')->default(0);
            $table->integer('type')->default(0);
            $table->string('num_invoice')->nullable();
            $table->string('num_fact')->nullable();
            $table->bigInteger('invoice_client_id')->default(0);
            $table->integer('total')->default(0);
            $table->boolean('paid')->default(0);
            $table->string('paid_text')->default('no');
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
        Schema::dropIfExists('invoices');
    }
};
