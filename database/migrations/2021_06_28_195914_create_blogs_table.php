<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->default(0)->index('FK_blogs_users');
            $table->integer('blog_category_id')->default(0)->index('FK_blogs_blog_categories');
            $table->string('uuid', 500)->unique('rowid');
            $table->string('slug', 70)->unique('slug');
            $table->mediumText('title');
            $table->text('description');
            $table->text('body');
            $table->mediumText('media_link');
            $table->string('media_name')->default('');
            $table->string('media_type', 50)->default('');
            $table->char('jobs', 1)->default('N');
            $table->integer('archived')->nullable()->default(0);
            $table->integer('status')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
