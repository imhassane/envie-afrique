<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('t_order_ord')) return;
        Schema::create('t_order_ord', function (Blueprint $table) {
            $table->id('ord_id');
            $table->float('ord_price')->default(0);
            $table->enum('ord_status',
                ['ACCEPTED', 'REJECTED', 'CANCELLED', 'SAVED', 'PREPARATION', 'WAITING_DELIVERY', 'DELIVERY', 'DELIVERED', 'RETRIEVED']
            )->default('SAVED');
            $table->date('ord_date');
            $table->time('ord_time');
            $table->integer("cus_id");
            $table->foreign('cus_id')->references('cus_id')->on('t_customer_cus')->onDelete('restrict');
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
        Schema::dropIfExists('t_order_ord');
    }
}
