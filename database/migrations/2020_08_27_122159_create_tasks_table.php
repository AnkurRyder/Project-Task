<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->string('id');
            $table->primary('id');
            $table->string('idt');
            $table->foreign('idt')->references('id')->on('teams');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('assignee_id')->nullable();
            $table->foreign('assignee_id')->references('id')->on('members');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
