<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->foreign('blog_category_id', 'FK_blogs_blog_categories')->references('id')->on('blog_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'FK_blogs_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign('FK_blogs_blog_categories');
            $table->dropForeign('FK_blogs_users');
        });
    }
}
