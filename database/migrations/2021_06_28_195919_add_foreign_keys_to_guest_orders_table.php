<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGuestOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guest_orders', function (Blueprint $table) {
            $table->foreign('order_category_id', 'FK_guest_orders_order_categories')->references('id')->on('order_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('order_format_id', 'FK_guest_orders_order_formats')->references('id')->on('order_formats')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('order_language_id', 'FK_guest_orders_order_languages')->references('id')->on('order_languages')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_orders', function (Blueprint $table) {
            $table->dropForeign('FK_guest_orders_order_categories');
            $table->dropForeign('FK_guest_orders_order_formats');
            $table->dropForeign('FK_guest_orders_order_languages');
        });
    }
}
