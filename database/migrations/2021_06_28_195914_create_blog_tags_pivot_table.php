<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTagsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_tags_pivot', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('uuid', 100)->nullable();
            $table->string('blog_title', 100)->nullable();
            $table->string('tag_title', 100)->nullable();
            $table->integer('blog_id')->nullable()->index('FK_blog_tags_pivot_blogs');
            $table->integer('tag_id')->nullable()->index('FK_blog_tags_pivot_blog_tags');
            $table->integer('user_id')->default(1)->index('FK_blog_tags_pivot_users');
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
        Schema::dropIfExists('blog_tags_pivot');
    }
}
