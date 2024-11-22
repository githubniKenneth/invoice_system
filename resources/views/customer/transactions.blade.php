

@extends('template.main')


@section('content')   
                <h3>Transactions</h3>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item mt-2 border">
                        <h2 class="accordion-header" id="headingOne">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Invoice Information
                          </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse" aria-labelledby="headingOne">
                            <div class="accordion-body">
                                <div class="p-3 d-flex flex-column"> 
                                    <label for="">Open Invoice: <b>{{ $openInvoiceCount }}</b></label>
                                </div>
                                <div class="d-flex flex-row-reverse">
                                    <a href="{{ route('invoice-create') }}" target="_blank" class="btn btn-success">Add Invoice</a> 
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-2">Invoice Number</th>
                                            <th class="col-1">Date</th>
                                            <th class="col-1">Discount</th>
                                            <th class="col-1">Vat</th>
                                            <th class="col-1">Subtotal</th>
                                            <th class="col-2">Grand Price</th>
                                            <th class="col-2">Balance</th>
                                            <th class="col-2">Action</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    @foreach($invoices as $invoice)
                                    <tr> 
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->invoice_date }}</td>
                                        <td>₱{{ number_format($invoice->discount, 2) }}</td>
                                        <td>₱{{ number_format($invoice->vat, 2)}}</td>
                                        <td>₱{{ number_format($invoice->subtotal, 2)}}</td>
                                        <td>₱{{ number_format($invoice->grand_price, 2)}}</td> 
                                        <td>₱{{ number_format($invoice->balance, 2)}}</td>
                                        <td> 
                                            <a href="/invoice/edit/{{$invoice->id}}" target="_blank" class="btn btn-warning me-2">View</a> 
                                        </td>
                                    </tr>
                                    @endforeach 
                                </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                    <div class="accordion-item mt-2 border">
                        <h2 class="accordion-header" id="headingTwo">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Payment Information
                          </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse" aria-labelledby="headingTwo">
                            <div class="accordion-body" id="itemList">
                                <div class="p-3 d-flex flex-column"> 
                                    <label for="">Total Amount Paid: <b>₱{{ number_format($totalAmountPaid, 2) }}</b></label>
                                </div>
                                <div class="d-flex flex-row-reverse">
                                    <a href="{{ route('payment-create') }}" target="_blank" class="btn btn-success">Add Payment</a>  
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-2">Payment Number</th>
                                            <th class="col-2">Invoice Number</th>
                                            <th class="col-1">Date</th>
                                            <th class="col-1">O.R. No.</th>
                                            <th class="col-2">Type</th>
                                            <th class="col-2">Amount</th>
                                            <th class="col-2">Action</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                    <tr> 
                                        <td>{{ $payment->payment_number }}</td>
                                        <td>{{ $payment->invoice->invoice_number }}</td>
                                        <td>{{ $payment->payment_date }}</td>
                                        <td>{{ $payment->or_no }}</td>
                                        <td>{{ $payment->payment_type }}</td> 
                                        <td>₱{{ number_format($payment->amount_paid, 2) }}</td>
                                        <td> 
                                            <a href="/payment/edit/{{$payment->id}}" target="_blank" class="btn btn-warning me-2">View</a> 
                                        </td>
                                    </tr>
                                    @endforeach 
                                </tbody>
                                </table>
                            </div> 
                        </div>
                    </div> 
                </div>
                
                <div class="d-flex justify-content-end p-3">
                    <a href="{{ route('customer-index')}}" class="btn btn-light border">Cancel</a>
                </div>
    

@endsection

@section('script') 
@endsection