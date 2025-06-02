<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('user_skin_quiz_answers', function (Blueprint $table) {
        $table->integer('score')->after('user_answer')->default(0);
    });
}

public function down()
{
    Schema::table('user_skin_quiz_answers', function (Blueprint $table) {
        $table->dropColumn('score');
    });
}

};
