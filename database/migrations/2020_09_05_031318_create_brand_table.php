<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->increments('brand_id')->comment("商品id");
            $table->string('brand_name')->unique()->comment("商品名称");
            $table->string('brand_logo')->comment("商品logo");
            $table->string('brand_url')->comment("商品网址");
            $table->string('brand_desc')->comment("商品简介");
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
        Schema::dropIfExists('brand');
    }
}
