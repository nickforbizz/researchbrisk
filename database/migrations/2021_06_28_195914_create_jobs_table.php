<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('uuid', 100)->nullable();
            $table->integer('user_id')->default(1)->index('FK_job_categories_users');
            $table->integer('job_category_id')->nullable()->index('FK_jobs_job_categories');
            $table->integer('job_industry_id')->nullable()->index('FK_jobs_job_industries');
            $table->string('title', 100)->default('');
            $table->mediumText('description')->nullable();
            $table->string('email_apply', 100)->nullable();
            $table->string('working_time', 100)->nullable();
            $table->string('salary', 100)->nullable();
            $table->string('location', 100)->nullable();
            $table->string('company', 100)->nullable();
            $table->integer('active')->nullable()->default(1);
            $table->integer('archived')->nullable()->default(0);
            $table->integer('status')->nullable()->default(1);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
