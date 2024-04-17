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
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('sale_person_id')->nullable();
            $table->tinyInteger('type');
            $table->string('invoice_no');
            $table->string('purchase_date');
            $table->string('grand_total');
            $table->string('vat_on_invoice')->nullable();;
            $table->string('total');
            $table->string('discount')->nullable();;
            $table->string('net_payable');
            $table->string('total_paid')->nullable();;
            $table->string('total_due');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('purchase_invoices');
    }
};
