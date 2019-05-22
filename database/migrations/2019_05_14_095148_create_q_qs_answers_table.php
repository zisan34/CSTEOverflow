<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQQsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_qs_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('quiz_question_id');
            $table->text('answer');
            $table->boolean('correct')->default('0');
            $table->integer('marks')->nullable();
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
        Schema::dropIfExists('q_qs_answers');
    }
}
