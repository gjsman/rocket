<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizMultipleChoiceAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_multiple_choice_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_multiple_choice_question_id');
            $table->integer('quiz_submission_id');
            $table->integer('user_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('selection')->nullable();
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
        Schema::dropIfExists('quiz_multiple_choice_answers');
    }
}
