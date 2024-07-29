<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    // $("#customer").select2({
    //     ajax: { 
    //         url: "{{ route('ajax.customers') }}",
    //         type: "get",
    //         dataType: "json",
    //         delay: 250,
    //         data: function (params) {
    //             return {
    //                 _token: CSRF_TOKEN,
    //                 search: params.term
    //             };
    //         },
    //         processResults: function (response) {
    //             return {
    //                 results: response
    //             };
    //         },
    //         cache: true
    //     },
    //     templateSelection: function (data, container) {
    //         $(data.element).attr('data-currency', JSON.stringify(data.currency));
    //         $(data.element).attr('data-billing_address', data.billing_address);
    //         $(data.element).attr('data-shipping_address', data.shipping_address);
    //         return data.text;
    //     }
    // });

    // $("#customer").change(function() {
    //     setupCustomer();            
    // });

    // $("#add_product_row").click(function() {
    //     addProductRow();
    // });

    // $(".save_form_button").click(function() {
    //     var form = $(this).closest('form');
       
    //     // Remove price mask from values
    //     var price_inputs = form.find('.price_input');
    //     price_inputs.each(function (index, elem) {
    //         var price_input = $(elem);
    //         price_input.val(price_input.unmask());
    //     });

    //     // remove template from form
    //     var itemTemplate = $('#product_row_template');
    //     itemTemplate.remove()

    //     // replace all name="taxes[]" with name="taxes[rowId][]"
    //     $('tbody tr').each(function (index, element) {
    //         var row = $(element);
    //         var taxesInput = row.find('[name="taxes[]"]');
    //         taxesInput.attr('name', 'taxes[' + index + '][]');
    //     });
        
    //     // Submit form
    //     form.submit();
    // });

    $("#client_id").select2({
        ajax: { 
            url: "{{ route('ajax.clients') }}",
            type: "get",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    _token: CSRF_TOKEN,
                    search: params.term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        },
        templateSelection: function (data, container) {
            $(data.element).attr('data-currency', JSON.stringify(data.currency));
            $(data.element).attr('data-billing_address', data.billing_address);
            $(data.element).attr('data-shipping_address', data.shipping_address);
            return data.text;
        }
    });

    // $("#client_id").change(function() {
    //     setupCustomer();            
    // });

    $("#add_product_row").click(function() {
        addProductRow();
    });

    $(".save_form_button").click(function() {
        var form = $(this).closest('form');
       
        // Remove price mask from values
        var price_inputs = form.find('.price_input');
        price_inputs.each(function (index, elem) {
            var price_input = $(elem);
            price_input.val(price_input.unmask());
        });

        // remove template from form
        var itemTemplate = $('#product_row_template');
        itemTemplate.remove()

        // replace all name="taxes[]" with name="taxes[rowId][]"
        $('tbody tr').each(function (index, element) {
            var row = $(element);
            var taxesInput = row.find('[name="taxes[]"]');
            taxesInput.attr('name', 'taxes[' + index + '][]');
        });
        
        // Submit form
        form.submit();
    });

    $("#drafs").click(function() {
        var form = $(this).closest('form');
        $("#drafs_input").val("2");
       // Remove price mask from values
       var price_inputs = form.find('.price_input');
       price_inputs.each(function (index, elem) {
           var price_input = $(elem);
           price_input.val(price_input.unmask());
       });

       // remove template from form
       var itemTemplate = $('#product_row_template');
       itemTemplate.remove()

       // replace all name="taxes[]" with name="taxes[rowId][]"
       $('tbody tr').each(function (index, element) {
           var row = $(element);
           var taxesInput = row.find('[name="taxes[]"]');
           taxesInput.attr('name', 'taxes[' + index + '][]');
       });
       
       // Submit form
       form.submit();
    });
    
    function calculatePercent(percent, amount) {
        var factor = Number(percent) / Number(100);
        return Number(amount) * Number(factor);
    }

    // function setupCustomer(billing_address, shipping_address) {
    //     var customer_id = $("#customer").val();
    //     var currency = $('#customer').find(':selected').data('currency');
        
    //     // Setup currency
    //     window.sharedData.company_currency = currency;
    //     setupPriceInput(window.sharedData.company_currency);

    //     // Setup Address
    //     var billing_address = $('#customer').find(':selected').data('billing_address');
    //     var shipping_address = $('#customer').find(':selected').data('shipping_address');
    //     $("#billing_address").text(billing_address);
    //     $("#shipping_address").text(shipping_address);
    //     $("#address_component").removeClass('d-none');
    // }

    function initializeProductSelect2(elem) {
        var n = $("#siteid").val();  
        console.log(n);
        elem.select2({
            ajax: { 
                url: "/ajax/products/"+n,
                type: "get",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            },
            templateSelection: function (data, container) {
                $(data.element).attr('data-taxes', JSON.stringify(data.taxes));
                $(data.element).attr('data-price', data.price);
                return data.text;
            }
        });

        elem.change(function() {
            var element = $(this);
            var selectedOption = element.find(':selected');
            var taxesSelect = element.closest('tr').find('[name="taxes[]"]');
            var priceInput = element.closest('tr').find('.price_input');

            // Set selected taxes from product
            var taxIds = [];
            var taxes = selectedOption.data('taxes');
            taxes.forEach(tax => {
                taxIds.push(tax.tax_type_id);
            });
            taxesSelect.val(taxIds);
            taxesSelect.trigger('change');

            // Set product price for price input
            priceInput.val(selectedOption.data('price'));
            priceInput.focusout();

            calculateRowPrice();
        });
    }

    function initializeTaxSelect2(elem) {
        elem.select2({
            placeholder: "{{ __('messages.select_taxes') }}",
        });
    }

    function round(num,dec)
    {
      num = Math.round(num+'e'+dec)
      return Number(num+'e-'+dec)
    }

    function calculateRowPrice() {
        var subTotal = 0;
        var taxes = {};

        $('tbody tr').each(function(index, element) {
            var row = $(element);

            // If the row is template just continue
            if(row.attr('id') == 'product_row_template') return;

            // quantity
            var quantity = Number(row.find('[name="quantity[]"]').val());

            // price
            var price = Number(row.find('.price_input').unmask()) / 100;

            // amount
            var amount = (quantity * price);
            amount = round(amount, 3);
            //console.log(amount);
            amount = round(amount, 2);

            
            //console.log(amount);

            // Calculate taxes
            var totalTaxAmount = Number(0);
            var selected_taxes = row.find('[name="taxes[]"]').find(':selected');
            selected_taxes.each(function (index, tax) {
                var percent = $(tax).data('percent');
                var taxAmount = calculatePercent(percent, amount);
                console.log("taxAmount", taxAmount);
                totalTaxAmount += Number(taxAmount);
            });

            // Add tax amount to Item Total
            amount = Number(amount) + Number(totalTaxAmount);

            // discount
            var discount = Number(row.find('[name="discount[]"]').val());

            // calculate discount
            if(!isNaN(discount) && discount != undefined && discount != 0) {
                var discountAmount = calculatePercent(discount, amount);
                amount = Number(amount) - Number(discountAmount);
            }

            // Add Item Total to Sub Total
            subTotal += Number(amount);

            var amountPrice = Number(amount);



            // Set price input value
            row.find('.amount_price').val(amountPrice.toFixed(2));
            row.find('.amount_price').focusout();
        });

        calculateTotalPrice(subTotal, taxes);
    }

    function calculateTotalPrice(subTotal, taxes) {
        // Total value
        total = 0;
        total += subTotal;

        // Set subtotal value
        subtotal = Number(subTotal);
        $('#sub_total').val(subtotal.toFixed(2));

        // total taxes
        var total_taxes = $('#total_taxes').find(':selected');
        total_taxes.each(function (index, tax) {
            var taxName = $(tax).text();
            var percent = $(tax).data('percent');
            var taxAmount = calculatePercent(percent, subTotal);

            // push tax to taxes array
            if(taxes[taxName]) {
                taxes[taxName] += Number(taxAmount);
            } else {
                taxes[taxName] = Number(taxAmount);
            }
        });
 
        // Display total tax list
        $('.total_tax_list').empty();
        for (var [name, amount] of Object.entries(taxes)) {
            var template = '<div class="d-flex align-items-center mb-3">' +
                '<div class="h6 mb-0 w-50">' +
                '    <strong class="text-muted">' + name + '</strong>' +
                '</div>' +
                '<div class="ml-auto h6 mb-0">' +
                '    <input type="text" class="price_input price-text w-100 fs-inherit" value="'+ Number(amount).toFixed(2) +'" disabled>' +
                '</div>' +
            '</div>';

            $('.total_tax_list').append(template);

            total = Number(total) + Number(amount);
        }
 
        // total discount
        var total_discount = $('#total_discount').val();
        if(total_discount != undefined && total_discount != 0) {
            total_discount = parseFloat(total_discount);
            var discountAmount = calculatePercent(total_discount, subTotal)
            total = Number(total) - Number(discountAmount)
        }

        $('#grand_total').val(Number(total).toFixed(2));
        setupPriceInput(window.sharedData.company_currency);
    }

    function initializePriceListener() {
        $(".priceListener").change(function() {
            calculateRowPrice()    
        });
    }

    function addProductRow() {
        var productItems = $('#items');
        var template = $('#product_row_template')
                .clone()
                .removeAttr('id')
                .removeClass('d-none');
        productItems.append(template);

        var product_select = template.find('[name="product[]"]');
        initializeProductSelect2(product_select);

        var tax_select = template.find('[name="taxes[]"]');
        initializeTaxSelect2(tax_select);

        initializePriceListener();
        calculateRowPrice();
    }

    function removeRow(elem) {
        $(elem).closest('tr').remove();
        calculateRowPrice();
    }

    function validateForm() {
        $('tbody tr').each(function(index, element) {
            var row = $(element);
            var product = row.find('[name="product[]"]')
        });
    }
        $(document).ready(function() {
      $('#driver_id').on('change', function() {
          var stateID = $(this).val();
          if(stateID) {
              $.ajax({
                  url: '/driverdepandcontract/'+stateID,
                  type: "GET",
                  data : {"_token":"{{ csrf_token() }}"},
                  dataType: "json",
                  success:function(data) {
                      console.log(data);
                    if(data){
                      $('#plate_number_id').empty();
                      $('#plate_number_id').focus;
                      $('#plate_number_id').append('<option disabled selected value="">Select Plate No.</option>'); 
                      $.each(data, function(key, value){
                      $('select[name="plate_number_id"]').append('<option value="'+ value.id +'">' + value.number_plate +' | '+value.weight + 'Tan'+'</option>');
                  });
                }else{
                  $('#plate_number_id').empty();
                }
                }
              });
          }else{
            $('#plate_number_id').empty();
          }
      });
 });

     $(document).ready(function() {

     $('#driver_id').on('change', function() {
         var stateID = $(this).val();
         if(stateID) {
             $.ajax({
                 url: '/checkdriver/'+stateID,
                 type: "GET",
                 data : {"_token":"{{ csrf_token() }}"},
                 dataType: "json",
                 success:function(data) {
                    console.log(data);
                if(data.type  == "false")
                {
                    
                }
                if(data.type  == 1)
                {
                    $("#exampleModal1").modal('show');
                    $('#plate').val(data.data[0].number_plate);
                    $('#driver_name').val(data.data[0].name);
                    $('#driver').val(data.data[0].driver_id);
                    $('#invoices').val(data.data[0].invoice_number);
                    $('#datetime').val(Date(data.data[0].created_at));
                    $('#suppose').val(data.data[0].total_qun/1);
                    //$('#arrived').val(data[0].accurate_remark);

                }
                if(data.type  == 2)
                {
                    $("#exampleModal2").modal('show');
                    $('#plate1').val(data.data[0].number_plate);
                    $('#driver_name1').val(data.data[0].name);
                    $('#driver1').val(data.data[0].driver_id);
                    $('#invoices1').val(data.data[0].invoice_number);
                    $('#datetime1').val(Date(data.data[0].created_at));
                    $('#arrived1').val(data.data[0].accurate_remark);
                    $('#suppose1').val(data.data[0].total_qun/1);  
                }
               }
             });

              $('#close2').on('click', function() {
                  window.location.reload(true);
              });

                $('#submit').on('click', function (event) {
                //console.log("here accurate");
                event.preventDefault();
                var plate_number = $('#plate').val();
                var driver_name = $('#driver_name').val();
                var driver_id = $('#driver').val();
                var invoices = $("#invoices").val();
                var suppose = $("#suppose").val();
                var datetime = $('#datetime').val();
                var reason = $('#reason').val();
                //console.log(id)
  

                $.ajax({
                url: '/checkdriverreason',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    plate_number: plate_number,
                    driver_name: driver_name,
                    driver_id: driver_id,
                    suppose: suppose,
                    invoices: invoices,
                    datetime: datetime,
                    reason: reason,
                },
                dataType: 'json',
                success: function (data) {
                console.log(data);  
                //window.location.reload(true);


                },
                error: function (data) {
                    //console.log(data.responseJSON.message);  
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.responseJSON.message,
                    })
                    //console.log(data);
                    //window.location.reload(true);
                }
            });
            });
 
              $('#close1').on('click', function() {
                  window.location.reload(true);
              });

            $('#submit1').on('click', function (event) {

                //console.log("here accurate");
                event.preventDefault();
                var plate_number = $('#plate1').val();
                var driver_id = $('#driver1').val();
                var driver_name = $('#driver_name1').val();
                var invoices = $("#invoices1").val();
                var arrived = $('#arrived1').val();
                var suppose = $("#suppose1").val();
                var datetime = $('#datetime1').val();
                var reason = $('#reason1').val();
                //console.log(id)
                $.ajax({
                url: '/checkdriverreason',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    plate_number: plate_number,
                    driver_id: driver_id,
                    driver_name: driver_name,
                    invoices: invoices,
                    arrived: arrived,
                    suppose:  suppose,
                    datetime: datetime,
                    reason: reason,
                },
                dataType: 'json',
                success: function (data) {
                console.log(data);  
                //window.location.reload(true);


                },

                error: function (data) {
                    window.location.reload(true);
                    //console.log(data.responseJSON.message);  
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.responseJSON.message,
                
                    })

                    //console.log(data);
                }
            } );
            });

         }else{
         }
     });

    });

         $(document).ready(function() {

     $('#plate_number_id').on('change', function() {
         var id = $(this).val();
         var plate = $("#plate_number_id option:selected").text();
         var noplate = plate.split('|');
         var noplate1 = noplate[0];
         $("#plate_number").val(noplate1);
         if(id) {
             $.ajax({
                 url: '/checklori/'+noplate1,
                 type: "GET",
                 data : {"_token":"{{ csrf_token() }}"},
                 dataType: "json",
                 success:function(data) {
                    console.log(data);
                if(data.type == "false")
                {
                    $('#create_invoices').show();
                }
                if(data.type == 1){
                    $("#exampleModal3").modal('show');
                    //alert(data.type);
                    $('#plate2').val(data.data[0].number_plate);
                    $('#driverid2').val(data.data[0].driver_id);
                    $('#driver2').val(data.data[0].name);
                    $('#invoices2').val(data.data[0].invoice_number);
                    $('#datetime2').val(Date(data.data[0].created_at));
                    $('#suppose2').val(data.data[0].total_qun/1); 
                    $('#create_invoices').hide();

                }
                if(data.type == 2){
                    $("#exampleModal4").modal('show');
                    //alert(data.type);
                    $('#plate3').val(data.data[0].number_plate);
                    $('#driverid3').val(data.data[0].driver_id);
                    $('#driver3').val(data.data[0].name);
                    $('#invoices3').val(data.data[0].invoice_number);
                    $('#datetime3').val(Date(data.data[0].created_at));
                    $('#suppose3').val(data.data[0].total_qun/1); 
                    $('#arrived3').val(data.data[0].accurate_remark);  
                    $('#create_invoices').show();
                }
               }
             });

              $('#close3').on('click', function() {
                  window.location.reload(true);
              });

                $('#close4').on('click', function() {
                  window.location.reload(true);
              });

              $('#submit3').on('click', function (event) {

                //console.log("here accurate");
                event.preventDefault();
                var plate_number = $('#plate3').val();
                var driver_id = $('#driverid3').val();
                var driver_name = $('#driver3').val();
                var invoices = $("#invoices3").val();
                var suppose = $("#suppose3").val();
                var arrived = $("#arrived3").val();
                var datetime = $('#datetime3').val();
                var reason = $('#reason3').val();
                //console.log(id)
                $.ajax({
                url: '/checkdriverreason',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    plate_number: plate_number,
                    driver_id: driver_id,
                    driver_name: driver_name,
                    suppose: suppose,
                    arrived: arrived,
                    invoices: invoices,
                    datetime: datetime,
                    reason: reason,
                },
                dataType: 'json',
                success: function (data) {
                console.log(data);  
                //window.location.reload(true);


                },
                error: function (data) {
                    //console.log(data.responseJSON.message);  
                     window.location.reload(true);
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.responseJSON.message,
                    })
                    //console.log(data);
                }
            });
            });

         }else{
         }
     });
    });

    $(document).ready(function() {
     $('#transporter_id').on('change', function() {
         var stateID = $(this).val();
         if(stateID) {
             $.ajax({
                 url: '/transporlocationterdepend/'+stateID,
                 type: "GET",
                 data : {"_token":"{{ csrf_token() }}"},
                 dataType: "json",
                 success:function(data) {
                    // console.log(data);
                   if(data){
                     $('#location_id').empty();
                     $('#location_id').focus;
                     $('#location_id').append('<option disabled selected value="">Select Dropoff Location</option>'); 
                     $.each(data, function(key, value){
                     $('select[name="location_id"]').append('<option value="'+ value.id +'">' + value.name+'</option>');
                 });
               }else{
                 $('#location_id').empty();
               }
               }
             });
         }else{
           $('#location_id').empty();
         }
     });
});

    $(document).ready(function() {
     $('#client').on('change', function() {
         var stateID = $(this).val();
         //console.log(stateID);
         if(stateID) {
             $.ajax({
                 url: '/checktransport/'+stateID,
                 type: "GET",
                 data : {"_token":"{{ csrf_token() }}"},
                 dataType: "json",
                 success:function(data) {
                    // console.log(data.transporter);
                   if(data.use_transporter[0].transport == 2){
                    document.getElementById("transporter_id").disabled=false;
                    document.getElementById("location_id").disabled=false;
                    $('#transporter').val(data.use_transporter[0].transport);
                    $('#transporter_id').empty();
                     $('#transporter_id').focus;
                     $('#transporter_id').append('<option disabled selected value="">Select Transporter Name</option>'); 
                     $.each(data.transporter, function(key, value){
                     $('select[name="transporter_id"]').append('<option value="'+ value.id +'">' + value.company_name+'</option>'); 

                     }); 

               }else{
                $('#transporter_id').append('<option disabled selected value="">Select Transporter Name</option>');
                $('#location_id').append('<option disabled selected value="">Select Dropoff Location</option>');
                $('#transporter').val('');
                document.getElementById("transporter_id").disabled=true;
                document.getElementById("location_id").disabled=true;
                
               }
               }
             });
         }else{
            $('#transporter_id').empty();
            $('#location_id').empty();
         }
     });
});
</script>