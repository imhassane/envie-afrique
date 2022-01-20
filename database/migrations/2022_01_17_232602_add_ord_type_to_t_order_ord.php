<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrdTypeToTOrderOrd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_order_ord', function (Blueprint $table) {
            $table->string('ord_type')->default('VAE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_order_ord', function (Blueprint $table) {
            $table->dropColumn('ord_type');
        });
    }
}
