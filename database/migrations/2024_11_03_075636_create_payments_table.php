<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id');
            $table->integer('customer_id');
            $table->date('payment_date'); 
            $table->string('payment_number');
            $table->string('or_no');
            $table->decimal('amount_paid', $precision = 11, $scale = 2);
            $table->decimal('current_balance', $precision = 11, $scale = 2);
            $table->string('payment_type');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable(); 
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
        Schema::dropIfExists('payments');
    }
}
