<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedFloat('shipping')->default(0);
            $table->unsignedFloat('discound')->default(0);
            $table->unsignedFloat('tax')->default(0);
            $table->unsignedFloat('total')->default(0);
            $table->enum('stutas',['pending','cancelled','processing','shipped','completed'])->default('pending');
            $table->enum('payment_status',['unpaid','paid']);
            $table->string('shiping_firstname');
            $table->string('shiping_lastname');
            $table->string('shiping_email');
            $table->string('shiping_phone');
            $table->string('shiping_address');
            $table->string('shiping_city');
            $table->string('shiping_country');

            $table->string('shiping_email');


            $table->string('billing_firstname');
            $table->string('billing_lastname');
            $table->string('billing_email');
            $table->string('billing_phone');
            $table->string('billing_address');
            $table->string('billing_email');
            $table->string('billing_city');
            $table->string('billing_country');

            $table->text('notes')->nullable();



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
        Schema::dropIfExists('orders');
    }
}
