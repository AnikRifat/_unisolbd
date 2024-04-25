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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('subsubcategory_id')->nullable();
            $table->text('product_name');
            $table->text('quotation_product_name');
            $table->string('product_slug');
            $table->string('product_code')->nullable();
            $table->string('purchase_price');
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->string('opening_qty')->nullable();
            $table->string('product_tags')->nullable();
            $table->text('short_descp')->nullable();
            $table->text('quotation_short_descp')->nullable();
            $table->longText('long_descp')->nullable();
            $table->longText('specification_descp')->nullable();
            $table->string('product_thambnail');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('barcode')->nullable();
            $table->tinyInteger('on_sale')->nullable();
            $table->tinyInteger('is_expireable')->nullable();
            $table->tinyInteger('featured')->nullable();
            $table->tinyInteger('special_offer')->nullable();
            $table->tinyInteger('top_rated')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('type');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('products');
    }
};
