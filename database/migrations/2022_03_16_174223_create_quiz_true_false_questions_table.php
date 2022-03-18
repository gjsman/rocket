<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizTrueFalseQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_true_false_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_id');
            $table->string('name');
            $table->text('summary')->nullable();
            $table->integer('correct_answer')->default(false);
            $table->boolean('visible')->default(true);
            $table->integer('order')->nullable();
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
        Schema::dropIfExists('quiz_true_false_questions');
    }
}
