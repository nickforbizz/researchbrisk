<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBlogTagsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_tags_pivot', function (Blueprint $table) {
            $table->foreign('tag_id', 'FK_blog_tags_pivot_blog_tags')->references('id')->on('blog_tags')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('blog_id', 'FK_blog_tags_pivot_blogs')->references('id')->on('blogs')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'FK_blog_tags_pivot_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_tags_pivot', function (Blueprint $table) {
            $table->dropForeign('FK_blog_tags_pivot_blog_tags');
            $table->dropForeign('FK_blog_tags_pivot_blogs');
            $table->dropForeign('FK_blog_tags_pivot_users');
        });
    }
}
