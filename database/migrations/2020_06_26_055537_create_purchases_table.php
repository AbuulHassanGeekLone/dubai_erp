<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->string('uom');
            $table->integer('unit_price');
            $table->integer('sale_price');
            $table->integer('discount');
            $table->integer('total_items');
            $table->integer('total_quantity');
            $table->integer('subtotal');
            $table->integer('total');
            $table->integer('paid');
            $table->integer('balance');
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
        Schema::dropIfExists('purchases');
    }
}
