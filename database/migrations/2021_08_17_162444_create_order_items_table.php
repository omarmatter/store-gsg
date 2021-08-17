<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->foreignId('prder_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('product')->restrictOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedFloat('price');

$table->primary(['order_id','product_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
