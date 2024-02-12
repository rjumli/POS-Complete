<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_list_returns', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->longText('reason');
            $table->integer('quantity')->default(1);
            $table->decimal('total',12,2);
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->boolean('from_inventory')->default(0);
            $table->tinyInteger('reason_id')->unsigned()->index();
            $table->foreign('reason_id')->references('id')->on('dropdowns')->onDelete('cascade');
            $table->bigInteger('managed_by')->unsigned()->index();
            $table->foreign('managed_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_list_returns');
    }
};
