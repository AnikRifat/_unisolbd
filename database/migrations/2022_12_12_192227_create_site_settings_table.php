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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable(); 
            $table->string('phone_one')->nullable(); 
            $table->string('phone_two')->nullable(); 
            $table->string('email')->nullable(); 
            $table->string('company_name')->nullable(); 
            $table->string('company_address')->nullable(); 
            $table->string('copyright')->nullable(); 
            $table->text('about_us')->nullable(); 
            $table->text('faqs')->nullable(); 
            $table->text('terms_condition')->nullable(); 
            $table->text('quotation_notice')->nullable();
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
        Schema::dropIfExists('site_settings');
    }
};
