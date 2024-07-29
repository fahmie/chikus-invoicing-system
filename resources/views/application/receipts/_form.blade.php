<style>
    .box {
        padding: 0;
        display: none;
        margin-top: 10px;
        margin-bottom: 20px;
        /* border: 1px solid #DBDFE4; */
    }
    .red{ background: #00000000; }
    .green{ background: #00000000; }
    .blue{ background: #00000000; }
    .choose{background: #ffffff;}                                           
</style>
<?php 
    if(empty($_GET)){
        $name = null;
    }else{
        $name = $_GET ['contractname'];
    }
?>
<div class="card card-form" style="box-shadow: none !important; margin-bottom: 0;">
    <div class="float-right card-form__body card-body" style="padding-top: 0;">
        <div class="row">
            <div class="col mb-3">
                @if(!empty($invoices))
                
                <div class="card mb-20" style="box-shadow: none; border: 1px solid #eee; margin-bottom: 10px;background: #fff;">
                    <div class="card-body p-0">
                        <p style="padding: 10px 0 0 10px; font-size: 14px; font-style: italic;">Note: Please choose the invoice(s) for this payment</p>
                        {{-- <div style=" margin: 10px;">
                            <a class="btn btn-success"  href="{{ route('receipts.report', $name) }}">Export to PDF</a>
                        </div> --}}
                    <hr>
                    @if($invoices->count() > 0)
                    <div class="table-responsive" data-toggle="lists">
                        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
                            <thead>
                                <tr>
                                    <th class="w-5" style="padding:0.35rem 10px 0.35rem 1rem;">ID</th>
                                    <th style="padding:0.35rem 10px;">Invoices</th>
                                    <th style="padding:0.35rem 10px;">Delivery Orders</th>
                                    <th style="padding:0.35rem 10px;">Unit Price (RM)</th>
                                    <th style="padding:0.35rem 10px;">Qty Start (Tan)</th>
                                    <th style="padding:0.35rem 10px;">Qty Arrived (Tan)</th>
                                    <th style="padding:0.35rem 10px;">Qty Shortage (Tan)</th>
                                    <th style="padding:0.35rem 10px;">Amount</th>
                                    <th style="padding:0.35rem 10px;">Shortage Amount</th>
                                    <th class="w-50" style="padding:0.35rem 1rem 0.35rem 10px;">Remarks</th>
                                    <th class="w-5">
                                        <div class="custom-control custom-checkbox ">
                                        <input class="custom-control-input" style="margin: 0 !important; border: 1px solid #EFEFEF;" name="all" type="checkbox" id="checkall">
                                            <label class="custom-control-label" for="checkall" ></label>
                                            </div>
                                    </th>   
                                </tr>
                            </thead>

                            <tbody>
                    @foreach ($invoices as $k => $invoice)
                                <tr>

                                        <td class="w-5" style="font-size: 14px;padding:0.35rem 10px;">{{ $k+1 }}</td>
                                        <td style="font-size: 14px">
                                            <a href="{{ route('invoices.details', $invoice->id) }}">
                                                {{ $invoice->invoice_number }}
                                            </a>
                                        </td>
                                        <td style="font-size: 14px;padding:0.35rem 10px;">
                                            <a href="{{ route('invoices.detailsdocontract', $invoice->id) }}">
                                            {{ $invoice->do_number }}
                                            </a>
                                        </td>
                                        <td class="w-15" style="font-weight: 600;font-size: 14px;padding:0.35rem 10px;">
                                            <?php
                                                foreach($invoice->items as $data)
                                                {
                                                    $data->price;
                                                }

                                                $price_unit = $data->price/100
                                            ?>
                                            {{$price_unit}}
                                        </td> 
                                        <td class="w-10"  style="font-weight: 600;font-size: 14px;padding:0.35rem 10px;">
                                            <?php
                                                $sum=0;
                                                foreach($invoice->items as $data)
                                                {
                                                    $sum+= $data->quantity;
                                                }
                                                echo $sum;
                                            ?>
                                        </td>
                                        @if($invoice->accurate == "Accurate Quantity")
                                            <td class="p" style="color: green;font-weight: 600; font-size: 14px;padding:0.35rem 10px;">
                                                {{$invoice->accurate_remark}}
                                            </td>  
                                        @else
                                            <td class="p" style="color: red;font-weight: 600; font-size: 14px;padding:0.35rem 10px;">
                                                {{$invoice->accurate_remark}}
                                            </td>  
                                        @endif
                                        @if(empty($invoice->accurate))
                                            <td class="p" style="font-size: 14px;font-weight: 600;padding:0.35rem 10px;">
                                                0
                                            </td>
                                        @elseif($invoice->accurate == "Accurate Quantity")
                                            <td class="p" style="font-size: 14px;font-weight: 600;padding:0.35rem 10px;">
                                                0
                                            </td>
                                        @else
                                            <td class="p" style="font-size: 14px;font-weight: 600;padding:0.35rem 10px;">
                                                {{ (round(($sum - $invoice->accurate_remark), 3)) }}
                                            </td>
                                        @endif

                                        <td class="w-20" style="font-size: 14px;font-weight: 600;padding:0.35rem 10px;"> {{ money($invoice->total, "MYR") }}</td>
                                        <td class="w-10"  style="font-weight: 600;font-size: 14px;padding:0.35rem 10px;">
                                            {{ money($invoice->accurate_amount, "MYR") }}
                                        </td>
                                        @if(empty($invoice->blance))
                                        <td class="w-50" style="font-style:italic;font-size: 11px;padding:0.35rem 1rem 0.35rem 10px;">-</td>
                                        @else
                                        <td class="w-50" style="font-style:italic;font-size: 11px;padding:0.35rem 1rem 0.35rem 10px;">Balance amount <b>{{ money($invoice->blance, "MYR") }}</b></td>
                                        @endif
                                        <td class="w-5" style="padding:0.35rem 10px 0.35rem 1rem;">
                                            <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input individual" type="checkbox" name="ids[{{$invoice->id}}]" name2="opt" id="{{$invoice->id}}" value="{{  isset($invoice->blance) ? $invoice->blance : $invoice->total }}" data-value2="{{ $invoice->accurate_remark*$price_unit }}" data-value3="{{ round(($sum - $invoice->accurate_remark)*$price_unit,2) }}">
                                            <label class="custom-control-label" for="{{$invoice->id}}"></label>
                                            </div>
                                        </td>
                                </tr>
                                
                    @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <!-- <td></td> -->
                                    <!-- <td></td> -->
                                    <td class="w-50" colspan="4" style="padding:0.35rem 1rem 0.35rem 10px;"> 
                                        <div class="row mt-2" style="float:right; margin-right: 2px;">
                                            <label style="text-transform: none;">Supposed Amount: RM</label>
                                            <span><h6 style="color: green; padding: 0 5px; margin-bottom: 0;" id="total"></h6></span>
                                        </div>
                                        <div class="row" style="float:right;margin-right: 2px; border-bottom: 1px solid #abb4bc; margin-bottom: 10px;">
                                            <label style="text-transform: none;">(-) Arrived Amount: RM </label>
                                            <h6 style=" color: blue; padding: 0 5px; margin-bottom: 0;" id="total_amount_arrived"></h6>
                                            
                                        </div>
                                        <div class="row mb-2" style="float:right;margin-right: 2px;">
                                            <label style="text-transform: none;">Shortage Amount: RM </label>
                                            <h6 style="color: red; padding: 0 5px; margin-bottom: 0;" id="total_amount_shortage"></h6>
                                        </div>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    
                    @else
                        <div class="row justify-content-center card-body pb-0 pt-5">
                            <i class="material-icons fs-64px">description</i>
                        </div>
                        <div class="row justify-content-center card-body pt-1 pb-5">
                            <p class="h4">No data yet</p>
                        </div>
                    @endif
                    </div>
                </div>
                @endif
                
                
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group required">
                    <label for="payment_date">{{ __('messages.payment_date') }}</label>
                    {{-- <input name="payment_date" type="text" class="form-control input" data-toggle="flatpickr" data-flatpickr-default-date="{{ $payment->payment_date ?? now() }}" placeholder="{{ __('messages.payment_date') }}" readonly="readonly" required> --}}
                    <input name="payment_date" readonly="readonly" type="text" maxlength="6" class="form-control form-control-prepended"  value="<?php echo date("Y/m/d") ?>">
                </div>
            </div> 
            <div class="col-md-6"> 
                <div class="form-group required">
                    <label for="payment_number">Cheque/Reference Number</label>
                    <div class="input-group input-group-merge">
                        <input name="payment_prefix" type="hidden" value="">
                        <input name="payment_number" type="text"  class="form-control form-control-prepended" value="" autocomplete="off" required>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group required">
                    <label for="payment_method_id">{{ __('messages.payment_type') }}</label>
                    <select id="payment_method_id" name="payment_method_id" data-toggle="select">
                        <option disabled selected>Select Payment Type</option>
                        @foreach ($payment_type as $payment)
                        <option value="{{ $payment->id}}">{{$payment->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="form-group required">
                    <label for="payment_status">Payment Status</label>
                    <select id="payment_status" name="payment_status" data-toggle="select">
                    <option disabled selected>Select Payment Status</option>
                    @foreach ($payment_status as $payment_status)
                    <option value="{{ $payment_status->id}}">{{$payment_status->name}}</option>
                    @endforeach
                        <!-- <option value="blue">Partial</option> -->
                    </select>
                </div>
            </div>
        </div>
        

        
        
        
        <div class="row">
            
            <div class="col-md-6">
                <div id="div1" class="form-group required">
                    <label for="amount">Payment Amount Received</label>
                    <input name="amount" id="amount" type="text" class="form-control" autocomplete="off" value="0" required>
                </div>

                <div id="div2" style="display: none;" class="form-group required">
                    <label for="amount">Payment Amount Received</label>
                    <input name="amount" id="amount1" type="text" class="form-control price_input priceListener" autocomplete="off" value="0" required>
                </div>


                <div id="div_blance" style="display: none;" class="form-group">
                    <label for="blance">Balance (RM)</label>
                    <input name="blance" id="blance" type="text" class="form-control price_blance priceListener" autocomplete="off" value="0" required>
                </div>

                <div id="div_dis" style="display: none;" class="form-group">
                    <label for="discount">Discount (RM)</label>
                    <input name="discount" id="discount" type="text" class="form-control price_discount priceListener" autocomplete="off" value="0" required>
                </div>
            </div>
            
            
            
        </div>

        
        
        
        
        
        {{-- <div id="total"></div> --}}
        <input type="hidden" id="totalamount" name="total_amount" value="">
        <input type="hidden" id="totalamount2" name="total_amount_pay" value="">
        <input type="hidden" id="totalamount3" name="total_pay" value="">
        <input type="hidden" id="total2" name="total" value="">
        <div class="form-group text-center mt-3">
            <button type="button" id="submit1"  class="btn btn-primary form_with_price_input_submit">Save Payment</button>
        </div>
    </div>
</div>
@section('page_body_scripts')
<script>
$('#submit1').click(function(){ 
   // alert("here");
    $('#receipt').submit();
});
    
$("#checkall").change(function() {
    toggleCheckAll(this.checked)
    totalCount = calculateAll()
    totalCount2 = calculateAll2()
    totalCount3 = calculateAll3()
    //alert(totalCount);
    $("#total").html(totalCount/100);
    $("#total_amount_arrived").html(totalCount2);
    $("#total_amount_shortage").html(totalCount3);
    $("#total2").val(totalCount/100);
  });    
    
  $("input[name2='opt']").change(function() {
      totalCount = calculateAll()
      totalCount2 = calculateAll2()
      totalCount3 = calculateAll3()
      //alert(totalCount2);
      $("#total_amount_arrived").html(totalCount2);
      $("#total_amount_shortage").html(totalCount3);
      $("#total").html(totalCount/100);
      $("#total2").val(totalCount/100);
  });
    
  function toggleCheckAll(checked){
    $("input[name2='opt']").prop('checked', checked)
  }
    
  function calculateAll(){
    count = 0;
    total = 0;
    $("input[name2='opt']").each(function(index, checkbox){
      if(checkbox.checked)
        count += parseInt(checkbox.value)
        total = count.toFixed(2);
    })
    return total;  
    };

    function calculateAll2(){
    count1 = 0;
    total = 0;
    $("input[name2='opt']").each(function(index, checkbox){
      if(checkbox.checked)
        count1 += parseFloat(checkbox.getAttribute("data-value2"));
        total = count1.toFixed(2);
    })
    return total;  
    };

    function calculateAll3(){
    count2 = 0;
    total = 0;
    $("input[name2='opt']").each(function(index, checkbox){
      if(checkbox.checked)
        count2 += parseFloat(checkbox.getAttribute("data-value3"));
        total = count2.toFixed(2);
    })
    return total;  
    };




   $(document).ready(function() {
        $('#payment_status').on('change', function() {
            var value = $(this).val(); 
            console.log(value);
            if(value == "1") {
                var v = document.getElementById('div1');
            v.style.display = ""
                var v = document.getElementById('div2');
                v.style.display = "none"
                $(document).mousemove(function(event){
                    var a = $("#total2").val();
                    $("#amount").val(a);

                    $( "#submit" ).click(function() {

                    var a = $("#amount").val();
                    $("#totalamount").val(a);
                    
                });

                });

                $( "#submit" ).click(function() {

                var a = $("#amount").val();
                $("#totalamount").val(a);

                });

                var a = $("#total2").val();
                $("#amount").val(a);
                //alert(a);
                var x = document.getElementById('div1');
                x.style.display = "";
                document.getElementById("amount").readOnly =true;
            }else{
                var x = document.getElementById('div1');
                x.style.display = "none";
                document.getElementById("amount").readOnly =false;
            }
            
            if(value == "2") {
            var x = document.getElementById('div_blance');
            x.style.display = "";
            var v = document.getElementById('div2');
            v.style.display = ""
            var x = document.getElementById('div1');
                x.style.display = "none";
                document.getElementById("blance").readOnly =true;
                $(document).mousemove(function(event){
                    var a = $("#total2").val(); //total perlu dibayar
                    var b = $("#amount1").val(); //total hendak bayar
                    var b1 = b.replace( /^\D+/g, '');
                    var b2 = b1.replace(/[^\w\s]/gi, '');
                    var total = parseFloat(a) - parseFloat(b2/100);
                        $("#blance").val(total.toFixed(2))
                    var bla = Math.abs(total)
                    var total1 = parseFloat(b2/100) + (parseFloat(bla));
                    console.log(total1);
                    $("#amount").val(a);
                    $("#totalamount2").val(total1);

                });
            }else{
            var x = document.getElementById('div_blance');
            x.style.display = "none";
            }
        if(value == "3") {
        var x = document.getElementById('div_dis');
            x.style.display = ""
            var v = document.getElementById('div2');
            v.style.display = ""

            document.getElementById("discount").readOnly =true;
                $(document).mousemove(function(event){
                    var a = $("#total2").val(); //total perlu dibayar
                    var b = $("#amount1").val(); //total hendak bayar
                    var b1 = b.replace( /^\D+/g, '');
                    var b2 = b1.replace(/[^\w\s]/gi, '');
                    var total = parseFloat(a) - parseFloat(b2/100);
                        $("#discount").val(total.toFixed(2))
                    var bla = Math.abs(total)
                    var total1 = parseFloat(b2/100) + (parseFloat(bla));
                    console.log(total1);
                    $("#amount").val(a);
                    $("#totalamount3").val(total1);

                });

                // $( "#submit" ).click(function() {
                //     var a = $("#amount1").val();
                //     var b = a.replace( /^\D+/g, '');
                //     var c = b.replace(/[^\w\s]/gi, '');
                //     //alert(c);
                //     //disccount
                //     var dis = $("#discount").val();
                //     var total = c/100;
                //     var total1 = parseFloat(total) + parseFloat(dis);
                //     $("#totalamount").val(total1);   
                // })
            }else{
        var x = document.getElementById('div_dis');
            x.style.display = "none";

        }
        });
    });
    
//     $(document).ready(function(){
//  $("#submit").click(function(){
//  var bulan = $('#month').val();
//   var tahun = $('#year').val();
//   var contractname = $('#contractname').val();
//   if(bulan == ""){
//     alert("Please Select Month.");
//   }
//   if(tahun == ""){
//     alert("Please Select Year.");
//   }
//   $.ajax({
//    url: '{{route('receipts.report', $name)}}',
//    type: 'GET',
//    data: {bulan:bulan,tahun:tahun,contractname:contractname},
//    beforeSend: function(){
//     // Show image container
//     //$("#loader").show();
//     $('#semak').button('loading');
//    },
//    success: function(response){
//     $('.response').empty();
//     $('.response').append(response);
//    }
//   });
//   });
//     });
// </script>
{{-- <script>
    $(document).ready(function () {

    $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });


    $('body').on('click', '#submit', function (event) {
        event.preventDefault()
        var tahun = $("#year").val();
        var bulan = $("#month").val();
        var contractname = $("#contractname").val();
    
        $.ajax({
        url: '/report/'+ contractname,
        type: "GET",
        data: {
            id:contractname,
            tahun: tahun,
            bulan: bulan,
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
       // window.location.reload(true);


        },            
        error: function (data) {
            //console.log(data.responseJSON.message);  
            // Swal.fire({
            // icon: 'error',
            // title: 'Oops...',
            // text: data.responseJSON.message,
            // })
            console.log(data);
        }
    });
    });

    }); 
</script> --}}
@endsection