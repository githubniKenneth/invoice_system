

@extends('template.main')


@section('content')   
            <form action="/invoice/update" method="POST">
                @method('PUT') 
                @csrf
                <h3>Edit Invoice</h3>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Invoice Information
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                        <div class="accordion-body">
                            <div class="row pb-2"> 
                                <div class="form-group col-4">
                                    <label class="form-label">Invoice Number</label>
                                    <input type="text" class="form-control" name="invoice_number" value="{{ $data->invoice_number }}" readonly>
                                </div> 
                                <div class="form-group col-4">
                                    <label class="form-label">Invoice Date</label>
                                    <input type="date" class="form-control" name="invoice_date" value="{{ $data->invoice_date }}">
                                </div>
                            </div>

                            <div class="row pb-2"> 
                                <div class="form-group col-4">
                                    <label class="form-label">Customer Name</label>
                                    <select name="customer_id" class="form-select">
                                        <option value="" selected>Select Customer</option> 
                                        @foreach ($customers as $customer) 
                                            <option value="{{$data->customer_id}}" {{ $data->customer_id == $customer->id ? "selected": ""}}>{{ $customer->full_name }}</option>
                                        @endforeach
                                    </select> 
                                </div>  
                                <div class="form-group col-8">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" value="{{ $data->customer->full_address }}" readonly>
                                </div>  
                            </div>

                            <div class="row pb-2"> 
                                <div class="form-group col-4">
                                    <label class="form-label">Discount</label>
                                    <input type="text" class="form-control" name="discount" id="discount" value="{{ $data->discount }}">
                                </div> 
                                <div class="form-group col-4">
                                    <label class="form-label">VAT</label>
                                    <input type="text" class="form-control" name="vat" id="vat" value="{{ $data->vat }}" readonly>
                                </div> 
                                <div class="form-group col-4">
                                    <label class="form-label">Grand Total</label>
                                    <input type="text" class="form-control" name="grand_total" id="grandTotal" value="{{ $data->grand_price }}" readonly>
                                </div> 
                            </div> 
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item mt-2 border">
                        <h2 class="accordion-header" id="headingTwo">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            Payment Information
                          </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                            <div class="accordion-body" id="itemList">
                                <div class="p-3 d-flex flex-column">
                                    <label for="">Total Amount Paid: <b>₱{{ number_format($totalAmountPaid, 2) }}</b></label>
                                    <label for="">Remaining Balance: <b>₱{{ number_format($data->balance, 2)}}</b></label>
                                </div>
                                <div class="d-flex flex-row-reverse">
                                    <button class="btn btn-success" id="addItem" type="button">Add Payment</button>
                                </div>
                                <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-2">Payment Number</th>
                                        <th class="col-3">Date</th>
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
                                        <td>{{ $payment->payment_date }}</td>
                                        <td>{{ $payment->or_no }}</td>
                                        <td>{{ $payment->payment_type }}</td> 
                                        <td>₱{{ number_format($payment->amount_paid,2 ) }}</td>
                                        <td> 
                                            <a href="/payment/edit/{{$payment->id}}" class="btn btn-warning me-2">View</a> 
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
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                          Item Details
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse" aria-labelledby="headingTwo">
                        <div class="accordion-body" id="itemList">
                            <div class="d-flex flex-row-reverse">
                                <button class="btn btn-success" id="addItem" type="button">Add Item Row</button>
                            </div>
                            <div class="row my-3">
                                <div class="col-3">
                                    <label class="form-label">Type</label>

                                </div>
                                <div class="col-4">
                                    <label class="form-label">Product</label>

                                </div>
                                <div class="col-1">
                                    <label class="form-label">Qty</label>

                                </div>
                                <div class="col-2">
                                    <label class="form-label">Base Price</label>

                                </div>
                                <div class="col-2">
                                    <label class="form-label">Sub Total</label>

                                </div>
                            </div>
                                @foreach($invoice_details as $detail)
                                    <div class="row my-3 itemRow" data-counter="0"> 
                                        <div class="form-group col-3">
                                            <select name="item[0][product_type]" id="" class="form-select">
                                                <option value="">Select Product Type</option>
                                                @foreach ($item_types as $key => $value) 
                                                    <option value="{{ $detail->product_type }}" {{ $key == $detail->product_type ? "selected" : ''}}>{{$value}}</option>
                                                @endforeach
                                            </select> 
                                        </div> 
                                        <div class="form-group col-4">
                                            <input type="text" class="form-control" name="item[0][product_name]" value="{{ $detail->product_name }}" readonly>
                                        </div> 
                                        <div class="form-group col-1">
                                            <input type="text" class="form-control qty" name="item[0][product_qty]" id="qty-0" value="{{ $detail->product_qty }} " readonly>
                                        </div> 
                                        <div class="form-group col-2">
                                            <input type="text" class="form-control basePrice" name="item[0][base_price]" id="basePrice-0" value="{{ $detail->base_price }}" readonly>
                                        </div> 
                                        <div class="form-group col-2">
                                            <input type="text" class="form-control subTotal" name="item[0][subtotal]" id="subTotal-0" value="{{ $detail->subtotal }}" readonly>
                                        </div> 
                                    </div>
                                @endforeach 
                        </div>
                        <div class="row my-3">
                            <div class="col-3">
                                <label class="form-label"></label> 
                            </div>
                            <div class="col-4">
                                <label class="form-label"></label>

                            </div>
                            <div class="col-1">
                                <label class="form-label"></label>

                            </div>
                            <div class="col-2">
                                <label class="form-label"><b>Subtotal</b></label>

                            </div>
                            <div class="col-2">
                                <label class="form-label"><span id="subTotalText"><b>₱{{ number_format($data->subtotal, 2) }}</b></span></label>

                            </div>
                        </div>
                      </div>
                    </div> 
                </div>
                
                <div class="d-flex justify-content-end p-3">
                    <input type="hidden" id="subTotalInput" name="subtotal" value="{{ $data->subtotal }}">
                    <a href="{{ route('invoice-index')}}" class="btn btn-light border">Cancel</a>
                    <button type="submit" class="btn btn-primary ms-2 border">Save</button>
                </div>
            </form>
        </div> 
    </div>
    

@endsection

@section('script') 
    <script src="{{asset('js/amountFunction.js')}}"></script>

    <script> 
        $(document).ready(function(){ // get employee details
            $('body').on('change', '#selectCustomer', function (e){
                var _self = $(this);
                $.ajax({
                    type: "GET",
                    url: _baseUrl + 'customer/address/' + _self.val(),
                    success: function(response) {
                        console.log(response);
                        
                        $('#customerAddress').val(response.full_address); 
                    },
                    async: false
                }); 
            });
        }); 
    </script>
@endsection