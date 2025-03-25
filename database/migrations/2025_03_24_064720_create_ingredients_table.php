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
    Schema::create('ingredients', function (Blueprint $table) {
        $table->id();
        $table->string('ingredient_name');
        $table->text('function');
        $table->text('facts')->nullable();
        $table->text('benefits')->nullable();
        $table->string('image')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
