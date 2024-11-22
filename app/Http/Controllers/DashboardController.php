<?php

namespace App\Http\Controllers;
use App\Models\Invoices;
use App\Models\Payments;

use Illuminate\Http\Request; 
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // public function index()
    // { 
    //     return view('dashboard');
    // }

    public function index()
    {
        $months = range(1, 12);  
        $invoiceData = []; 
        $paymentData = []; 
        foreach ($months as $month) {
            $invoice_amount = DB::table('invoices')
                        ->whereMonth('invoice_date', $month)
                        ->sum('grand_price'); 
            $invoiceData[] = $invoice_amount;  

            $payment_amount = DB::table('payments')
                        ->whereMonth('payment_date', $month)
                        ->sum('amount_paid');  
            $paymentData[] = $payment_amount;  
        }
        return view('dashboard', compact('invoiceData', 'paymentData'));
    }
}
