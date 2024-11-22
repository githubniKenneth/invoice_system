<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\InvoiceDetails;
use App\Models\Invoices;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $data = DB::table('customers')->select('*')->get();
        return view('customer.index')->with('data', $data);
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $middle_name_data = $request->middle_name ? $request->middle_name . " " : "";
        $full_name = $request->first_name . " " . $middle_name_data . $request->last_name;         
        $full_address = $request->street . " " . $request->barangay . " " . $request->city;
        // dd($full_name);
        DB::table('customers')->insert([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'full_name' => $full_name,
            'street' => $request->street,
            'barangay' => $request->barangay,
            'city' => $request->city,
            'full_address' => $full_address,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('customer-index')->with('success', 'Customer created successfully.'); 
    }

    public function edit($id)
    { 
        $data = Customer::findOrFail($id);
        return view('customer.edit')->with('data', $data);
    }

    public function update($id, Request $request)
    { 
        $middle_name_data = $request->middle_name ? $request->middle_name . " " : "";
        $full_name = $request->first_name . " " . $middle_name_data . $request->last_name;

        DB::table('customers')->where('id', $id)->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'full_name' => $full_name,
            'updated_by' => Auth::user()->id,
        ]);

        return back()->with('message','Data has been saved successfully');
    }

    public function customerDetailsByInvoiceId($id)
    {
        return DB::table('invoices')
            ->join('customers', 'invoices.customer_id', '=', 'customers.id')
            ->where('invoices.id', $id)
            ->select('invoices.*', 'customers.id', 'customers.full_name', 'customers.full_address')
            ->first();
        
        // Invoices::select('customer_id')->where('id', $id)->first();
        // return $customer = Customer::select('customer_id')->where('id', $id)->first();
    }

    public function customerDetailsById($id)
    {
        return DB::table('customers') 
            ->where('customers.id', $id)
            ->select('customers.full_address')
            ->first();
        
        // Invoices::select('customer_id')->where('id', $id)->first();
        // return $customer = Customer::select('customer_id')->where('id', $id)->first();
    }

    
    public function customerTransaction($customer_id)
    {
        $invoices = Invoices::select('*')->where('customer_id', $customer_id)->get();
        $payments = Payments::select('*')->where('customer_id', $customer_id)->get();
        $openInvoiceCount = Invoices::where('balance', '>=', 1)->where('customer_id', $customer_id)->count();
        $totalAmountPaid = Payments::where('customer_id', $customer_id)->sum('amount_paid');
        return view('customer.transactions')->with(compact('invoices', 'payments', 'openInvoiceCount', 'totalAmountPaid'));
    }

    public function delete($customer_id)
    {
        Customer::where('id', $customer_id)->delete();
        Payments::select('id')->where('customer_id', $customer_id)->delete();
        Invoices::select('id')->where('customer_id', $customer_id)->delete();
        InvoiceDetails::select('id')->where('customer_id', $customer_id)->delete();
        return redirect()->route('customer-index')->with('message', 'Data Deleted Successfully');
    }

}
