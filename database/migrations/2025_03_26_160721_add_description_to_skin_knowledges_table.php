<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    if (!Schema::hasColumn('skin_knowledges', 'description')) {
        Schema::table('skin_knowledges', function (Blueprint $table) {
            $table->text('description')->after('best_ingredient');
        });
    }
}


    public function down()
    {
        Schema::table('skin_knowledges', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
