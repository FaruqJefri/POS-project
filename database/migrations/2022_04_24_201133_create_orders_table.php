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
            $table->string('reference_no')->nullable();
            $table->decimal('tax', 9, 2)->nullable();
            $table->decimal('service_charge', 9, 2)->nullable();
            $table->decimal('total_amount_cents', 9, 2)->nullable();
            $table->boolean('is_walkin')->default(1);
            $table->string('status')->default('Pending');
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
