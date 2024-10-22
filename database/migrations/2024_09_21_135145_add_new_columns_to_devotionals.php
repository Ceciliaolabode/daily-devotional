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
        Schema::table('devotionals', function (Blueprint $table) {
            //$table->integer('total_views');
            $table->integer('total_views')->nullable()->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devotionals', function (Blueprint $table) {
            $table->dropColumn('total_views');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
};
