<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\Customer;
use App\Models\InvoiceDetails;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $data = Invoices::select('*')->get();
        return view('invoice.index')->with('data', $data);
    }

    public function customerInvoices($id)
    {
        $data = Invoices::with('customer')->select('*')->where('customer_id', $id)->get();
        return view('invoice.index')->with('data', $data);
    }

    public function create()
    {
        $customers = DB::table('customers')->select('*')->get();
        $item_types = config('constant.item_types'); 
        return view('invoice.create')->with(compact('customers', 'item_types'));
    }

    public function store(Request $request)
    { 
        $lastInvoiceNumber = Invoices::selectRaw('CAST(invoice_number AS INTEGER) as numeric_value')->orderBy('numeric_value', 'desc')->first();   

        if ($lastInvoiceNumber) {
            $invoice_number = str_pad($lastInvoiceNumber->numeric_value + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $invoice_number = '0001';
        }

        $inserted_data = Invoices::Create([
            'customer_id' => $request->customer_id,
            'invoice_number' => $invoice_number,
            'invoice_date' => $request->invoice_date,
            'discount' => $request->discount,
            'subtotal' => $request->subtotal,
            'vat' => $request->vat,
            'grand_price' => $request->grand_total,
            'balance' => $request->grand_total,
            'created_by' => Auth::user()->id,
        ]);

        foreach ($request->item as $item) {  
            DB::table('invoice_details')->insert([
                'invoice_id' => $inserted_data->id,
                'customer_id' => $inserted_data->customer_id,
                'product_name' => $item['product_name'],
                'product_type' => $item['product_type'],
                'product_qty' => $item['product_qty'],
                'base_price' => $item['base_price'],
                'subtotal' => $item['subtotal'],
                'created_by' => 1,
            ]);
        };
        

        return redirect()->route('invoice-index')->with('success', 'Invoice created successfully.'); 
    }

    public function edit($id)
    {
        $customers = DB::table('customers')->select('*')->get();
        $data = Invoices::select('*')->where('id', $id)->first();
        $invoice_details = InvoiceDetails::select('*')->where('invoice_id', $id)->get();
        $payments = Payments::select('*')->where('invoice_id', $id)->get();
        $totalAmountPaid = Payments::where('invoice_id', $id)->sum('amount_paid');
        $item_types = config('constant.item_types'); 
        
        return view('invoice.edit')->with(compact('customers', 'data', 'invoice_details', 'payments', 'totalAmountPaid', 'item_types'));
    }

    public function delete($invoice_id)
    { 
        Invoices::select('id')->where('id', $invoice_id)->delete();
        InvoiceDetails::select('id')->where('invoice_id', $invoice_id)->delete();
        Payments::select('id')->where('invoice_id', $invoice_id)->delete(); 
        return redirect()->route('invoice-index')->with('message', 'Data Deleted Successfully');
    }
}
