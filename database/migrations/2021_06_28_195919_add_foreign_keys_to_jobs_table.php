<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->foreign('job_category_id', 'FK_jobs_job_categories')->references('id')->on('job_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('job_industry_id', 'FK_jobs_job_industries')->references('id')->on('job_industries')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'FK_jobs_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign('FK_jobs_job_categories');
            $table->dropForeign('FK_jobs_job_industries');
            $table->dropForeign('FK_jobs_users');
        });
    }
}
