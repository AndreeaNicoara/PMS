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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id',11);
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('username',255);
            $table->string('password',255);
            $table->string('confirmation_code',255);
            $table->enum('user_type', ['USER', 'ADMIN'])->nullable()->default('USER');
            $table->rememberToken();
            $table->enum('status', ['0', '1'])->nullable()->default('0')->comment = '0 = Active & 1 = Inactive';
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
        Schema::dropIfExists('users');
    }
};
