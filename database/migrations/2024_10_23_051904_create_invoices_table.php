<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('invoice_number');
            $table->date('invoice_date'); 
            $table->decimal('discount', $precision = 11, $scale = 2)->nullable();
            $table->decimal('vat', $precision = 11, $scale = 2);
            $table->decimal('subtotal', $precision = 11, $scale = 2);
            $table->decimal('grand_price', $precision = 11, $scale = 2);
            $table->decimal('balance', $precision = 11, $scale = 2);
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
        Schema::dropIfExists('invoices');
    }
}
