<?php

namespace Database\Seeders;

use App\Models\InvoiceDetails;
use App\Models\Invoices;
use App\Models\Payments;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invoices::create([
            'customer_id' => '1',
            'invoice_number' => '0001',
            'invoice_date' => '2024-11-03',
            'discount' => 0,
            'subtotal' => 2000.00,
            'vat' => 240.00,
            'grand_price' => 2240.00,
            'balance' => 740.00,
            'created_by' => '1',
            'updated_by' => '1'
        ]);

        InvoiceDetails::create([
            'invoice_id' => 1,
            'customer_id' => '1',
            'product_type' => 'Type 1',
            'product_name' => 'B',
            'product_qty' => 1,
            'base_price' => 2000.00,
            'subtotal' => 2000.00, 
            'created_by' => '1',
            'updated_by' => '1'

        ]);

        Payments::create([
            'invoice_id' => '1',
            'customer_id' => '1',
            'payment_number' => '0001',
            'payment_date' => '2024-11-03',
            'or_no' => '158156',
            'amount_paid' => 750.00,
            'current_balance' => 2240.00,
            'payment_type' => 'Credit Card', 
            'created_by' => '1',
            'updated_by' => '1'
        ]);

        Invoices::create([
            'customer_id' => '1',
            'invoice_number' => '0002',
            'invoice_date' => '2024-11-03',
            'discount' => 0,
            'subtotal' => 2000.00,
            'vat' => 240.00,
            'grand_price' => 2240.00,
            'balance' => 2240.00,
            'created_by' => '1',
            'updated_by' => '1'
        ]);

        InvoiceDetails::create([
            'invoice_id' => 2,
            'customer_id' => '1',
            'product_type' => 'Type 1',
            'product_name' => 'B',
            'product_qty' => 1,
            'base_price' => 1000.00,
            'subtotal' => 1000.00, 
            'created_by' => '1',
            'updated_by' => '1'

        ]);

        InvoiceDetails::create([
            'invoice_id' => 2,
            'customer_id' => '1',
            'product_type' => 'Type 1',
            'product_name' => 'EWQ',
            'product_qty' => 1,
            'base_price' => 1000.00,
            'subtotal' => 1000.00, 
            'created_by' => '1',
            'updated_by' => '1'

        ]);

        Payments::create([
            'invoice_id' => '1',
            'customer_id' => '1',
            'payment_number' => '0002',
            'payment_date' => '2024-11-03',
            'or_no' => '158156',
            'amount_paid' => 750.00,
            'current_balance' => 1490.00,
            'payment_type' => 'Credit Card', 
            'created_by' => '1',
            'updated_by' => '1'
        ]);

        Invoices::create([
            'customer_id' => '2',
            'invoice_number' => '0003',
            'invoice_date' => '2024-11-03',
            'discount' => 0,
            'subtotal' => 1000.00,
            'vat' => 120.00,
            'grand_price' => 1120.00,
            'balance' => 1120.00,
            'created_by' => '1',
            'updated_by' => '1'
        ]);

        InvoiceDetails::create([
            'invoice_id' => 3,
            'customer_id' => '2',
            'product_type' => 'Type 1',
            'product_name' => 'B',
            'product_qty' => 1,
            'base_price' => 1000.00,
            'subtotal' => 1000.00, 
            'created_by' => '1',
            'updated_by' => '1'

        ]);
    }
}
