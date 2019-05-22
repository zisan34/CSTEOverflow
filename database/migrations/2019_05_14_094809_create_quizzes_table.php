<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->string('topic');
            $table->unsignedInteger('time');
            $table->boolean('enabled')->default('0');
            $table->integer('total_marks');
            $table->boolean('show_correct')->default('1');
            $table->boolean('multiple_attempt')->default('0');
            $table->string('key');
            $table->unsignedInteger('mcq');
            $table->unsignedInteger('fig');
            $table->unsignedInteger('true_false');            
            $table->unsignedInteger('short_ques');
            $table->string('message')->nullable();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE quizzes AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}
