<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDueDate2ToAssignmentsAndQuizzes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dateTime('due_old')->nullable()->default(null);
        });
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dateTime('due_old')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn('due_old');
        });
        Schema::table('assignments', function (Blueprint $table) {
            $table->dropColumn('due_old');
        });
    }
}
