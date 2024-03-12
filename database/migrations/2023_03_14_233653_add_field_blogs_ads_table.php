<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldBlogsAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs_ads', function (Blueprint $table) {
            $table->string('email')->nullable()->after('blog_id');
            $table->string('phone')->nullable()->after('blog_id');
            $table->string('address')->nullable()->after('blog_id');
            $table->string('name')->nullable()->after('blog_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('blogs_ads', ['name','phone','phone','email']);
    }
}
