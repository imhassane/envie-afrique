<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('t_customer_cus')) return;
        Schema::create('t_customer_cus', function (Blueprint $table) {
            $table->id('cus_id');
            $table->string('cus_fullname')->index();
            $table->string('cus_phone')->unique();
            $table->string('cus_address')->index();
            $table->integer('cus_nb_orders')->default(0);
            $table->float('cus_total_spendings')->default(0);
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
        Schema::dropIfExists('t_customer_cus');
    }
}
