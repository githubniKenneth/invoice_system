

@extends('template.main')


@section('content') 
        <form action="/payment/store" method="POST">
            @csrf
            
            <h3>Create Payment</h3>
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
                                <select name="invoice_id" class="form-select" id="selectInvoice">
                                    <option value="" selected>Select Invoice</option> 
                                    @foreach ($invoices as $invoice) 
                                        <option value="{{$invoice->id}}">{{ $invoice->invoice_number }}</option>
                                    @endforeach
                                </select> 
                            </div>
                            <div class="form-group col-4">
                                <label class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="customer_name" readonly>
                            </div> 
                        </div> 

                        <div class="row pb-2"> 
                            <div class="form-group col-4">
                                <label class="form-label">Grand Price</label>
                                <input type="text" class="form-control" id="grand_price" readonly>
                            </div> 
                            <div class="form-group col-4">
                                <label class="form-label">Remaining Balance</label>
                                <input type="text" class="form-control" name="current_balance" id="balance" readonly>
                            </div>
                        </div>  
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
                    <div class="accordion-body">
                        <div class="row pb-2"> 
                            <div class="form-group col-4">
                                <label class="form-label">Payment Number</label>
                                <input type="text" class="form-control" name="payment_number" readonly>
                            </div>

                            <div class="form-group col-4">
                                <label class="form-label">Payment Date</label>
                                <input type="date" class="form-control" name="payment_date">
                            </div>
                        </div>   
                        <div class="row pb-2"> 
                            <div class="form-group col-4">
                                <label class="form-label">O.R. Number</label>
                                <input type="text" class="form-control" name="or_no">
                            </div>

                            <div class="form-group col-4">
                                <label class="form-label">Payment Type</label>
                                <select name="payment_type" class="form-select">
                                    <option value="" selected>Select Payment Type</option> 
                                    <option value="Credit Card">Credit Card</option> 
                                    <option value="Cash">Cash</option> 
                                    <option value="Check">Check</option> 
                                    <option value="Direct Debit">Direct Debit</option>  
                                    <option value="Bank Transfer">Bank Transfer</option>  
                                </select> 
                            </div>

                            <div class="form-group col-4">
                                <label class="form-label">Amount Paid</label>
                                <input type="text" class="form-control" name="amount_paid">
                            </div>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>
            </div>


            <div class="d-flex justify-content-end p-3">
                <input type="hidden" id="customer_id" name="customer_id">
                <a href="{{ route('payment-index')}}" class="btn btn-light border">Cancel</a>
                <button type="submit" class="btn btn-primary ms-2 border">Save</button>
            </div>
        </form> 
    

@endsection


@section('script')
<script>
    $(document).ready(function(){ // get employee details
        $('body').on('change', '#selectInvoice', function (e){
            var _self = $(this);
            $.ajax({
                type: "GET",
                url: _baseUrl + 'customer/details/' + _self.val(),
                success: function(response) {
                    console.log(response);
                    
                    $('#grand_price').val(response.grand_price);
                    $('#balance').val(response.balance);
                    $('#customer_name').val(response.full_name);
                    $('#customer_id').val(response.customer_id); 
                },
                async: false
            }); 
        });
    });
</script>
@endsection