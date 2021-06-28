<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaperPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paper_prices', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->nullable()->index('FK_paper_prices_users');
            $table->string('name', 100)->nullable();
            $table->string('price', 100)->nullable();
            $table->string('pages', 100)->nullable();
            $table->mediumText('description')->nullable();
            $table->integer('archived')->nullable()->default(0);
            $table->integer('status')->nullable()->default(1);
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paper_prices');
    }
}
