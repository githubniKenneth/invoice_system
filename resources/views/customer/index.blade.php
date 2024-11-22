@extends('template.main')
@extends('template.delete-modal')


@section('content')

    <div class="d-flex justify-content-between py-3"> 
        <h2>Customer List</h2>
        <div> 
            <a href="{{ route('customer-create')}}" class="btn btn-success">Add Customer</a>
        </div>
    </div>
    <div class="p-3"> 
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="col-1">No</th>
                    <th class="col-5">Name</th>
                    <th class="col-5">Address</th>
                    <th class="col-1">Action</th>
                </tr>
            </thead>
            <tbody class="text-secondary">
                @foreach($data as $customer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $customer->full_name }}</td>
                    <td>{{ $customer->full_address }}</td>
                    <td>
                        <div class="d-flex justify-content-between"> 
                            <a href="/customer/edit/{{$customer->id}}" class="btn btn-warning me-2">Edit</a>
                            <a href="/customer/transaction/{{$customer->id}}" class="btn btn-primary me-2">Transactions</a> 
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

    
    <form id="deleteForm" action="/customer/delete/{{$customer->id}}" method="POST" style="display: none;">
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
    @if(session('success'))
        <script src="{{asset('js/sweetAlert.js')}}"></script>
        <script>
            showSuccessMessage();
        </script>
    @endif
@endsection



