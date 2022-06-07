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
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->Increments('Product_id');
            $table->string('product_name', 100);
            $table->Integer('category_id');
            $table->Integer('Brand_id');
            $table->string('product_desc');
            $table->text('product_content');
            $table->string('product_price');
            $table->string('product_image');
            $table->Integer('product_status');
            $table->Integer('product_quantity');
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
        Schema::dropIfExists('tbl_product');
    }
};
