<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs_comments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('uuid', 100)->nullable();
            $table->integer('user_id')->default(0);
            $table->integer('blog_id')->nullable()->index('FK_blogs_comments_blogs');
            $table->integer('parent_id')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('name', 100)->nullable();
            $table->mediumText('comment');
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
        Schema::dropIfExists('blogs_comments');
    }
}
