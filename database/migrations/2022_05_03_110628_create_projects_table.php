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
            $table->string('project_name',255);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('total_hours',10);
            $table->integer('project_manager_id')->unsigned();
            $table->enum('project_type', ['REST_API_MD', 'REST_API_WD', 'EMPTY_TEMPLATE'])->nullable();
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
