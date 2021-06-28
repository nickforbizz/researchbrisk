<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestOrderDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_order_docs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->nullable();
            $table->integer('order_id')->nullable()->index('FK_guest_order_docs_guest_orders');
            $table->string('name')->default('0');
            $table->mediumText('media_link')->nullable();
            $table->string('extension')->nullable();
            $table->string('type')->nullable();
            $table->integer('remember_token')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->integer('archived')->nullable()->default(0);
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_order_docs');
    }
}
