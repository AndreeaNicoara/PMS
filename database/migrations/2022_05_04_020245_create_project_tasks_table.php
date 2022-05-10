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
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->increments('project_task_id',11);
            $table->integer('project_id')->unsigned();
            $table->integer('user_id')->nullable()->unsigned();
            $table->string('project_task',255);
            $table->enum('task_status', ['NEW', 'OPENED','INPROGRESS','CLOSED'])->nullable()->default('NEW');
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
        Schema::dropIfExists('project_tasks');
    }
};
