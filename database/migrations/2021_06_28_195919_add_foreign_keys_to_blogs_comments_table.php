<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBlogsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs_comments', function (Blueprint $table) {
            $table->foreign('blog_id', 'FK_blogs_comments_blogs')->references('id')->on('blogs')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs_comments', function (Blueprint $table) {
            $table->dropForeign('FK_blogs_comments_blogs');
        });
    }
}
