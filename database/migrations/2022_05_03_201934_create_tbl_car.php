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
        Schema::create('tbl_cart', function (Blueprint $table) {
            $table->Increments('cart_id');
            $table->Integer('product_id');
            $table->Integer('id_khachhang');
            $table->string('product_name', 100);
            $table->string('product_price');
            $table->Integer('product_quantity_cart');
            $table->string('product_image');
            $table->Integer('product_total');
            $table->Integer('ck_pay');
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
        Schema::dropIfExists('tbl_cart');
    }
};
