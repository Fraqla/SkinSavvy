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
    Schema::table('skin_knowledges', function (Blueprint $table) {
        $table->json('characteristics')->nullable()->after('skin_type');
    });
}

public function down()
{
    Schema::table('skin_knowledges', function (Blueprint $table) {
        $table->dropColumn('characteristics');
    });
}

};
