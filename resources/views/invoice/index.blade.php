@extends('template.main')
@extends('template.delete-modal')

@section('content')

    <div class="d-flex justify-content-between py-3"> 
        <h2>Invoice List</h2>
        <div> 
            <a href="{{ route('invoice-create')}}" class="btn btn-success">Add Invoice</a>
        </div>
    </div> 
    <div class="p-3"> 
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="col-1">No.</th>
                    <th class="col-2">Invoice Number</th>
                    <th class="col-3">Full Name</th>
                    <th class="col-1">Date</th>
                    <th class="col-1">Amount</th>
                    <th class="col-1">Balance</th>
                    <th class="col-1">Action</th>
                </tr>
            </thead>
            <tbody class="text-secondary">
                @foreach($data as $invoice)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $invoice->invoice_number }}</td>
                        <td>
                            <a href="{{ route('invoice-customer-index', $invoice->customer_id) }}" target="_blank" class="customer-link">
                                {{ $invoice->customer->full_name }} 
                            </a>
                        </td>
                        <td>{{ $invoice->invoice_date }}</td>
                        <td>₱{{ number_format($invoice->grand_price, 2) }}</td>
                        <td>₱{{ number_format($invoice->balance, 2) }}</td>
                        <td>
                            <div class="d-flex justify-content-between"> 
                                <a href="{{ route('invoice-edit', $invoice->id) }}" class="btn btn-warning">Edit</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>

    <form id="deleteForm" action="/invoice/delete/{{$invoice->id}}" method="POST" style="display: none;">
        @csrf
        @method("delete")
    </form>
@endsection

@section('script')
    <script>
        document.getElementById('confirmDeleteButton').addEventListener('click', function () {
            document.getElementById('deleteForm').submit();
        });
    </script>
@endsection