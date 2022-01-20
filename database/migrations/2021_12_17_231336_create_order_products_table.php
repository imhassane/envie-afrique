<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('t_order_products_opr')) return;
        Schema::create('t_order_products_opr', function (Blueprint $table) {
            $table->id('opr_id');
            $table->integer('ord_id');
            $table->integer('pro_id');
            $table->foreign('ord_id')->on('t_order_ord')->references('ord_id');
            $table->foreign('pro_id')->on('t_product_pro')->references('pro_id');
            $table->integer('opr_quantity')->default(1);
            $table->float('opr_price')->default(0);
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
        Schema::dropIfExists('t_order_products_opr');
    }
}
