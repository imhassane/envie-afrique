<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatesToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_order_ord', function (Blueprint $table) {
            $table->dateTime('ord_preparation_date')->nullable();
            $table->dateTime('ord_ready_date')->nullable();
            $table->dateTime('ord_delivery_date')->nullable();
            $table->dateTime('ord_end_date')->nullable();
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
            $table->dropColumn('ord_preparation_date');
            $table->dropColumn('ord_ready_date');
            $table->dropColumn('ord_delivery_date');
            $table->dropColumn('ord_end_date');
        });
    }
}
