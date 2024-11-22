<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoices;
use App\Models\Customer; 
use App\Models\Payments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $data = Payments::select('*')->get();
        return view('payment.index')->with('data', $data);
    }

    public function customerPayments($id)
    {
        $data = Payments::select('*')->where('customer_id', $id)->get();
        return view('payment.index')->with('data', $data);
    }

    public function create()
    {
        $invoices = Invoices::select('*')->where('balance', '>=', 1)->get();
        return view('payment.create')->with('invoices', $invoices);
    }

    public function store(Request $request)
    { 

        $lastPaymentNumber = Payments::selectRaw('CAST(payment_number AS INTEGER) as numeric_value')->orderBy('numeric_value', 'desc')->first();   

        if ($lastPaymentNumber) {
            $payment_number = str_pad($lastPaymentNumber->numeric_value + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $payment_number = '0001';
        }

        Payments::Create([
            'invoice_id' => $request->invoice_id,
            'customer_id' => $request->customer_id,
            'payment_date' => $request->payment_date,
            'payment_number' => $payment_number,
            'or_no' => $request->or_no,
            'amount_paid' => $request->amount_paid,
            'current_balance' => $request->current_balance,
            'payment_type' => $request->payment_type,
            'created_by' => Auth::user()->id, 
        ]); 

        // get Invoice data
        // subtract invoice.grand_price to payments.amount_paid
        // then update the difference into invoice.balance 
        $invoice = Invoices::select('*')->where('id', $request->invoice_id)->first();
        if ($invoice->grand_price == $invoice->balance)
        { 
            $balance = $invoice->grand_price - $request->amount_paid;
        }
        else
        {
            $balance = $invoice->balance - $request->amount_paid;
        }
        Invoices::where('id', $request->invoice_id)->update(['balance' => $balance]);

        return redirect()->route('payment-index')->with('success', 'Invoice created successfully.'); 
    }

    public function edit($id)
    {
        $data = Payments::select('*')->where('id', $id)->first();
        $invoices = Invoices::select('*')->where('balance', '>=', 1)->get();
        $payment_types = config('constant.payment_types'); 
        return view('payment.edit')->with(compact('invoices', 'data', 'payment_types'));
    }
}
