<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSchoolProductsTable extends Migration
{
    const VALUE_PRECISION = 10;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_products', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('price')->default(0);
            $table->decimal('value', self::VALUE_PRECISION, self::VALUE_PRECISION)->default(0);
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_products');
    }
}
