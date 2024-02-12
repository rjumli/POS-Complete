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
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('brand')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('reorder')->default(0);
            $table->integer('lead')->default(0);
            $table->integer('safety')->default(0);
            $table->integer('demand')->default(0);
            $table->boolean('is_active')->default(1);
            $table->decimal('price',12,2);
            $table->longText('description');
            $table->string('warranty')->nullable();
            $table->integer('percentage_id')->unsigned()->index();
            $table->foreign('percentage_id')->references('id')->on('pricings')->onDelete('cascade');
            $table->tinyInteger('pricing_id')->unsigned()->index();
            $table->foreign('pricing_id')->references('id')->on('dropdowns')->onDelete('cascade');
            $table->string('size')->nullable();
            $table->tinyInteger('unit_id')->unsigned()->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->tinyInteger('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
};
