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
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('project_id',11);
            $table->string('project_code',50);
            $table->string('project_name',255);
            $table->string('project_description',255)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('total_hours',10);
            $table->string('stakeholder',255)->nullable();
            $table->string('attachment',255)->nullable();
            $table->string('git_repository',255)->nullable();
            $table->integer('leader_id')->unsigned();
            $table->enum('project_type', ['REST_API_MD', 'REST_API_WD', 'EMPTY_TEMPLATE'])->nullable();
            $table->enum('project_status', ['NEW', 'OPENED', 'INPROGRESS','COMPLETED'])->nullable()->default('NEW');
            $table->enum('status', ['0', '1'])->nullable()->default('0')->comment = '0 = Active & 1 = Deactive';
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
        Schema::dropIfExists('projects');
    }
};
