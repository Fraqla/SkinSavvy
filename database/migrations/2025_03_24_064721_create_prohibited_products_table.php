<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('prohibited_products', function (Blueprint $table) {
        $table->id();
        $table->string('product_name');
        $table->string('detected_poison')->nullable();
        $table->text('effect')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prohibited_products');
    }
};
