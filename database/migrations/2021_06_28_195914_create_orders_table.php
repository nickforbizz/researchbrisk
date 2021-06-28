<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->default(0)->index('FK_orders_users');
            $table->integer('order_category_id')->default(0)->index('FK_orders_order_categories');
            $table->integer('order_format_id')->default(0)->index('FK_orders_order_formats');
            $table->integer('order_language_id')->default(0)->index('FK_orders_order_languages');
            $table->text('title');
            $table->string('email', 1000)->default('');
            $table->string('pages', 1000)->default('');
            $table->string('wordcount', 1000)->default('');
            $table->date('duedate');
            $table->string('notes', 1000)->default('');
            $table->text('description');
            $table->integer('status')->default(1);
            $table->integer('archived')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
