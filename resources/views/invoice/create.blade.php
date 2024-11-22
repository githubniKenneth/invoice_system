

@extends('template.main')


@section('content')  
            <form action="/invoice/store" method="POST">
                @csrf
                <h3>Create Invoice</h3>
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
                                    <input type="text" class="form-control" name="invoice_number" readonly>
                                </div> 
                                <div class="form-group col-4">
                                    <label class="form-label">Invoice Date</label>
                                    <input type="date" class="form-control" name="invoice_date">
                                </div>
                            </div>

                            <div class="row pb-2"> 
                                <div class="form-group col-4">
                                    <label class="form-label">Customer Name</label>
                                    <select name="customer_id" id="selectCustomer" class="form-select">
                                        <option value="" selected>Select Customer</option> 
                                        @foreach ($customers as $customer) 
                                            <option value="{{$customer->id}}">{{ $customer->full_name }}</option>
                                        @endforeach
                                    </select> 
                                </div>  
                                <div class="form-group col-8">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" id="customerAddress" readonly>
                                </div>  
                            </div>

                            <div class="row pb-2"> 
                                <div class="form-group col-4">
                                    <label class="form-label">Discount</label>
                                    <input type="text" class="form-control" name="discount" id="discount" value="0">
                                </div> 
                                <div class="form-group col-4">
                                    <label class="form-label">VAT</label>
                                    <input type="text" class="form-control" name="vat" id="vat" value="0" readonly>
                                </div> 
                                <div class="form-group col-4">
                                    <label class="form-label">Grand Total</label>
                                    <input type="text" class="form-control" name="grand_total" id="grandTotal" value="0" readonly>
                                </div> 
                            </div> 
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item mt-2 border">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
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
                            <div class="row my-3 itemRow" data-counter="0"> 
                                <div class="form-group col-3">
                                    <select name="item[0][product_type]" id="" class="form-select">
                                        <option value="">Select Product Type</option>
                                        @foreach ($item_types as $key => $value) 
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select> 
                                </div> 
                                <div class="form-group col-4">
                                    <input type="text" class="form-control" name="item[0][product_name]">
                                </div> 
                                <div class="form-group col-1">
                                    <input type="text" class="form-control qty" name="item[0][product_qty]" id="qty-0" value="1">
                                </div> 
                                <div class="form-group col-2">
                                    <input type="text" class="form-control basePrice" name="item[0][base_price]" id="basePrice-0" value="0">
                                </div> 
                                <div class="form-group col-2">
                                    <input type="text" class="form-control subTotal" name="item[0][subtotal]" id="subTotal-0" value="0" readonly>
                                </div> 
                            </div>
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
                                <label class="form-label"><b>Total</b></label>

                            </div>
                            <div class="col-2">
                                <label class="form-label"><span id="subTotalText"><b>0</b></span></label> 
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end p-3">    
                    <input type="hidden" id="subTotalInput" name="subtotal" value="0">
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