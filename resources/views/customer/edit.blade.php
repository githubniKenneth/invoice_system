

@extends('template.main')


@section('content')
    <form action="/customer/update/{{$data->id}}" method="POST">
        @csrf
        
        <h3>Edit Customer</h3>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Personal Information
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                <div class="accordion-body">
                    <div class="row pb-2"> 
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="{{ $data->first_name }}">
                        </div>
                    </div>
                    <div class="row pb-2"> 
                        <div class="form-group">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="middle_name" value="{{ $data->middle_name }}">
                        </div>
                    </div>
                    <div class="row pb-2"> 
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="{{ $data->last_name }}">
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="accordion-item mt-2 border">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Address Information
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse" aria-labelledby="headingTwo">
                <div class="accordion-body">
                    <div class="row pb-2"> 
                        <div class="form-group">
                            <label class="form-label">Street</label>
                            <input type="text" class="form-control" name="street" value="{{ $data->street }}">
                        </div>
                    </div>
                    <div class="row pb-2"> 
                        <div class="form-group">
                            <label class="form-label">Barangay</label>
                            <input type="text" class="form-control" name="barangay" value="{{ $data->barangay }}">
                        </div>
                    </div>
                    <div class="row pb-2"> 
                        <div class="form-group">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" name="city" value="{{ $data->city }}">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>


        <div class="d-flex justify-content-end p-3">
            <a href="{{ route('customer-index')}}" class="btn btn-light border">Cancel</a>
            <button type="submit" class="btn btn-primary ms-2 border">Save</button>
        </div>
    </form> 
    

@endsection