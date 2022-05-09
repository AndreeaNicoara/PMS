<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('task_id',11);
            $table->integer('project_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('task_name',255);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['NEW', 'OPEN', 'INPROGRESS', 'COMPLETED'])->nullable()->default('NEW');
            $table->integer('added_by')->unsigned();
            $table->timestamp('added_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('updated_by')->nullable()->unsigned();
            $table->timestamp('updated_date')->nullable();
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
};
