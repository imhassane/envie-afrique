<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('t_category_cat')) return;
        Schema::create('t_category_cat', function (Blueprint $table) {
            $table->id('cat_id');
            $table->string('cat_name');
            $table->text('cat_description');
            $table->text('cat_avatar');
            $table->boolean('cat_visible');
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
        Schema::dropIfExists('category');
    }
}
