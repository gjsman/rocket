<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizMultipleChoiceQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_multiple_choice_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_id');
            $table->string('name');
            $table->text('summary')->nullable();
            $table->integer('correct_answer')->default(1);
            $table->string('choice1');
            $table->string('choice2')->nullable();
            $table->string('choice3')->nullable();
            $table->string('choice4')->nullable();
            $table->string('choice5')->nullable();
            $table->string('choice6')->nullable();
            $table->string('choice7')->nullable();
            $table->string('choice8')->nullable();
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
        Schema::dropIfExists('quiz_multiple_choice_questions');
    }
}
