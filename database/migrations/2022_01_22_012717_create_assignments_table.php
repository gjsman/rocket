<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id');
            $table->string('name');
            $table->text('summary')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('visible')->default(true);
            $table->dateTime('due')->nullable();
            $table->boolean('show_due_date')->default(true);
            $table->boolean('allow_late_submissions')->default(true);
            $table->integer('gradeable_category_id');
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
        Schema::dropIfExists('assignments');
    }
}
