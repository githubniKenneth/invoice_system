@extends('template.main')


@section('content')

    <div class="d-flex justify-content-between py-3"> 
        <h2>Payment List</h2>
        <div> 
            <a href="{{ route('payment-create')}}" class="btn btn-success">Add Payment</a>
        </div>
    </div>
    <div class="p-3"> 
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="col-1">No.</th>
                    <th class="col-2">Payment No.</th>
                    <th class="col-2">Invoice No.</th>
                    <th class="col-2">Customer Name</th>
                    <th class="col-2">Amount</th>
                    <th class="col-1">Date</th>
                    <th class="col-2">Action</th>
                </tr>
            </thead>
            <tbody class="text-secondary">
                @foreach($data as $payment)
                <tr> 
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $payment->payment_number }}</td>
                    <td>{{ $payment->invoice->invoice_number }}</td>
                    <td>
                        <a href="{{ route('payment-customer-index', $payment->id) }}" target="_blank" class="customer-link">
                            {{ $payment->invoice->customer->full_name }}
                        </a>
                    </td>
                    <td>₱{{ number_format($payment->amount_paid, 2) }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td> 
                        <a href="/payment/edit/{{$payment->id}}" class="btn btn-warning me-2">Edit</a>
                        <a href="/payment/delete/{{$payment->id}}" class="btn btn-danger">Delete</a> 
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
@endsection


