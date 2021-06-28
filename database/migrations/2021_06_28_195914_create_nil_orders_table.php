<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nil_orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('order_category_id')->default(0);
            $table->integer('order_format_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('order_language_id')->default(0);
            $table->integer('pages')->default(0);
            $table->integer('word_count')->default(0);
            $table->text('order_number');
            $table->text('title');
            $table->text('notes');
            $table->string('email', 50)->default('0');
            $table->integer('status')->default(1);
            $table->char('nil', 1)->default('Y');
            $table->integer('archived')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nil_orders');
    }
}
