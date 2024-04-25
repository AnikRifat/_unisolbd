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
        Schema::create('customer_package_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_package_id');
            $table->string('component')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('unit_id');
            $table->text('description');
            $table->integer('user_id');
            $table->string('qty');
            $table->string('price');
            $table->string('discount')->nullable();
            $table->string('total');
            $table->tinyInteger('delete')->default(0);
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
        Schema::dropIfExists('customer_package_items');
    }
};
