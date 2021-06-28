<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGuestOrderDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guest_order_docs', function (Blueprint $table) {
            $table->foreign('order_id', 'FK_guest_order_docs_guest_orders')->references('id')->on('guest_orders')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_order_docs', function (Blueprint $table) {
            $table->dropForeign('FK_guest_order_docs_guest_orders');
        });
    }
}
