<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->default(0)->primary();
            $table->string('email', 50)->default('0')->unique('email');
            $table->string('remember_token', 200)->default('0');
            $table->integer('user_level')->nullable()->default(0);
            $table->text('name');
            $table->text('password');
            $table->string('image_file', 400)->default('public/imgs/users/default.png');
            $table->integer('status')->default(1);
            $table->integer('archived')->default(0);
            $table->char('admin', 1)->default('N');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('email_verified_at')->useCurrent();
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
}
