<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkoffs', function (Blueprint $table) {
            $table->id();
            $table->boolean('checked')->default(true);
            $table->integer('student_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('checkoffable_id');
            $table->string('checkoffable_type');
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
        Schema::dropIfExists('checkoffs');
    }
}
