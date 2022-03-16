<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizTrueFalseAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_true_false_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_true_false_question_id');
            $table->integer('user_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->boolean('selection')->default(false);
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
        Schema::dropIfExists('quiz_true_false_answers');
    }
}
