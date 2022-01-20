<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('t_product_pro')) return;
        Schema::create('t_product_pro', function (Blueprint $table) {
            $table->id('pro_id');
            $table->string('pro_name');
            $table->text('pro_description')->index('pro_description_index');
            $table->longText('pro_article')->index('pro_article_index');
            $table->string('pro_cover')->default('default_product.webp');
            $table->enum('pro_status', ['ACTIVE', 'INACTIVE', 'OUT_OF_STOCK'])->default('INACTIVE')->index('pro_status_index');
            $table->float('pro_price')->default(0);
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
        Schema::dropIfExists('t_product_pro');
    }
}
