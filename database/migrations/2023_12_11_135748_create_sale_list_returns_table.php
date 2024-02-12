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
        Schema::create('sale_list_returns', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->longText('reason');
            $table->integer('quantity')->default(1);
            $table->decimal('total',12,2);
            $table->tinyInteger('reason_id')->unsigned()->index();
            $table->foreign('reason_id')->references('id')->on('dropdowns')->onDelete('cascade');
            $table->integer('salelist_id')->unsigned()->index();
            $table->foreign('salelist_id')->references('id')->on('sale_lists')->onDelete('cascade');
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
        Schema::dropIfExists('sale_list_returns');
    }
};
