$(document).ready(function(){  
    $('#addItem').on("click", function(e) {
        e.preventDefault(); 
        var itemCount = $('#itemList .itemRow').length;  

        var html = '<div class="row my-3 itemRow" data-counter="'+itemCount+'">'+ 
                            '<div class="form-group col-3">'+ 
                                '<input type="text" class="form-control" name="item['+itemCount+'][product_type]">'+
                            '</div>'+ 
                            '<div class="form-group col-4">'+ 
                                '<input type="text" class="form-control" name="item['+itemCount+'][product_name]">'+
                            '</div>'+ 
                            '<div class="form-group col-1">'+ 
                                '<input type="text" class="form-control qty" name="item['+itemCount+'][product_qty]" id="qty-'+itemCount+'" value="1">'+
                            '</div>'+ 
                            '<div class="form-group col-2">'+ 
                                '<input type="text" class="form-control basePrice" name="item['+itemCount+'][base_price]" id="basePrice-'+itemCount+'" value="0">'+
                            '</div>'+ 
                            '<div class="form-group col-2"> '+ 
                                '<input type="text" class="form-control subTotal" name="item['+itemCount+'][subtotal]" id="subTotal-'+itemCount+'" value="0" readonly> '+
                            '</div> '+ 
                    '</div> '; 
        $("#itemList").append(html);
    });

    $(document).on('input', '.qty, .basePrice, #discount', function() {
        var counterValue = $(this).closest('div[data-counter]').data('counter');
        var qtyValue = $('#qty-'+counterValue).val(); 
        var basePriceValue = $('#basePrice-'+counterValue).val(); 

        qtyValue = parseFloat(qtyValue) || 0;
        basePriceValue = parseFloat(basePriceValue) || 0; 

        var subTotalProduct = qtyValue * basePriceValue;   
        $('#subTotal-'+counterValue).val(subTotalProduct);  
        updateGrandTotal();
    });

    function updateGrandTotal()
    {
        // subTotalSum = add all items subtotal
        // difference = subTotalSum - discount
        // vat = difference * .12
        // grand total = sum - difference + vat
        
        var subtotal = 0;  
        var discount = $('#discount').val(); 

        // sum
        $('.itemRow').each(function() {
            var qty = parseFloat($(this).find('.qty').val()) || 0;
            var basePrice = parseFloat($(this).find('.basePrice').val()) || 0;
            subtotal += qty * basePrice;
        });

        // difference
        subtotal = parseFloat(subtotal) || 0;
        discount = parseFloat(discount) || 0; 

        difference = subtotal - discount;
        difference = parseFloat(difference) || 0;

        // vat
        vatAmount = difference * .12;
        vatAmount = parseFloat(vatAmount) || 0;
        // $('#grandTotal').val(grandTotalValue);

        // grand total 
        grandTotalValue = difference + vatAmount; 
        // console.log('grandTotalValue:', grandTotalValue); 
        $('#vat').val(vatAmount);
        $('#grandTotal').val(grandTotalValue);
        $('#subTotalText').html(subtotal);
        $('#subTotalInput').val(subtotal);

    }

});