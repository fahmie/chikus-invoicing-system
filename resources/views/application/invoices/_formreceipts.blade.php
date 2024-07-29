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

<div class="card card-form" style="box-shadow: none !important; margin-bottom: 0;">
    <div class="float-right card-form__body card-body" style="padding-top: 0;">
        <div class="row">
            <div class="col mb-3">
                @if(!empty($invoices))
                
                <div class="card mb-20" style="box-shadow: none; border: 1px solid #eee; margin-bottom: 10px;background: #fff;">
                    <div class="card-body p-0">
                    <p style="padding: 10px 0 0 10px; font-size: 14px; font-style: italic;">Note: Please choose the invoice(s) for this payment</p>
                    <hr>
                    <div class="table-responsive" data-toggle="lists">
                        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
                            <thead>
                                <tr>
                                    <th class="w-5">Check All<br /><input type="checkbox" id="checkall" /></th>
                                    <th class="w-20">Invoices</th>
                                    <th class="w-20">Delivery Orders</th>
                                    <th class="w-10">Qty Start</th>
                                    <th class="w-10">Qty Arrived</th>
                                    <th class="w-20">Amount</th>
                                    <th class="w-40">Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                <tr>
                                @if($invoice->status == "COMPLETED")
                                    <td class="w-5">
                                    
                                        <div class="custom-control custom-checkbox mt-sm-2">
                                        <input type="checkbox" class="custom-control-input individual" type="checkbox" name="ids[{{$invoice->id}}]" name2="opt" id="{{$invoice->id}}" value="{{  isset($invoice->blance) ? $invoice->blance : $invoice->total }}">
                                        <label class="custom-control-label" for="{{$invoice->id}}"></label>
                                        </div>
                                    </td>
                                        <td class="w-20">{{$invoice->invoice_number}}</td>
                                        <td class="w-20">{{$invoice->do_number}}</td>
                                        <td class="w-10"  style="font-weight: 600;">
                                            <?php
                                            $sum=0;
                                            foreach($invoice->items as $data)
                                            {
                                                $sum+= $data->quantity;
                                            }
                                            echo $sum;
                                            ?>
                                        </td>
                                        <td class="w-10" style="color: red;font-weight: 600;">
                                            {{ $invoice->accurate_remark }}
                                        </td> 
                                        <td class="w-20"> {{ money($invoice->total, "MYR") }}</td>
                                        @if(empty($invoice->blance))
                                        <td class="w-40" style="font-style:italic;font-size: 11px">-</td>
                                        @else
                                        <td class="w-40" style="font-style:italic;font-size: 11px">Balance amount <b>{{ money($invoice->blance, "MYR") }}</b></td>
                                        @endif
                                @else
                                    
                                @endif
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    
                                    <td></td>
                                    <td> 
                                    <label style="text-transform: none;">Total Amount (RM)</label>
                                        <!-- <input name="amount" id="total" type="text" class="form-control" autocomplete="off" value="0"> -->
                                        <!-- <h6 id="total" style="border: 1px solid #DBDFE4; padding: 10px;"></h6> -->
                                        <h6 id="total"></h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                @endif
                
            </div>

        </div>
        <div class="row">
            <div class="col">
                <div class="form-group required">
                    <label for="payment_date">{{ __('messages.payment_date') }}</label>
                    <input name="payment_date" type="text" class="form-control input" data-toggle="flatpickr" data-flatpickr-default-date="{{ $payment->payment_date ?? now() }}" placeholder="{{ __('messages.payment_date') }}" readonly="readonly" required>
                </div>
            </div> 
            <div class="col"> 
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
            <div class="col">
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
            <div class="col"> 
                <div class="form-group required">
                    <label for="amount">Payment Amount Received</label>
                    <input name="amount" id="amount" type="text" class="form-control price_input priceListener" autocomplete="off" value="0" required>
                </div>
            </div>
        </div>
        

        
        
        
        <div class="row">
            
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
        <input type="hidden" id="total2" name="total" value="">
        <div class="form-group text-center mt-3">
            <button type="submit" id="submit"  class="btn btn-primary form_with_price_input_submit">Save Payment</button>
        </div>
    </div>
</div>
@section('page_body_scripts')
<script>
    
//    var total = 0;
//    function CalculateTotal(){
//        $("input:checkbox").each(function(){
//            if($(this).is(":checked")){
//                total += parseFloat($(this).val());
//                
//            }
//        });

//
//        
//        
//    }
//    $("input:checkbox").change(function(){
//        total = 0;
//        CalculateTotal();
//    }).trigger("change");

$("#checkall").change(function() {
    toggleCheckAll(this.checked)
    totalCount = calculateAll()
    //alert(totalCount);
    $("#total").html(totalCount/100);
    $("#total2").val(totalCount/100);
  });    
    
  $("input[name2='opt']").change(function() {
      totalCount = calculateAll()
      //alert(totalCount);
      $("#total").html(totalCount/100);
      $("#total2").val(totalCount/100);
  });
    
  function toggleCheckAll(checked){
    $("input[name2='opt']").prop('checked', checked)
  }
    
  function calculateAll(){
    count = 0;
    $("input[name2='opt']").each(function(index, checkbox){
      if(checkbox.checked)
        count += parseInt(checkbox.value)
    })
    return count;  
    };


      $( "#submit" ).click(function() {
        var a = $("#amount").val();
        var b = a.replace( /^\D+/g, '');
        var c = b.replace(/[^\w\s]/gi, '');
        var total = c/100;
        $("#totalamount").val(total);
        
    });

   $(document).ready(function() {
    $('#payment_status').on('change', function() {
        var value = $(this).val();
        if(value == "2") {
       var x = document.getElementById('div_blance');
         x.style.display = "";
         
             $( "#submit" ).click(function() {
                   var a = $("#amount").val();
                   var b = a.replace( /^\D+/g, '');
                   var c = b.replace(/[^\w\s]/gi, '');
                   //blance
                   var bla = $("#blance").val()
                   var blan = bla.replace( /^\D+/g, '');
                   var blance = blan.replace(/[^\w\s]/gi, '');
                   var total = c/100;
                   var total2 = blance/100;
                   var total3 = total2*100;
                   var total1 = total + total3;
                   //alert("bla"+total1);
                   $("#totalamount").val(total1);
                   
               })
        }else{
       var x = document.getElementById('div_blance');
         x.style.display = "none";
         }
       if(value == "3") {
       var x = document.getElementById('div_dis');
         x.style.display = ""
               $( "#submit" ).click(function() {
                   var a = $("#amount").val();
                   var b = a.replace( /^\D+/g, '');
                   var c = b.replace(/[^\w\s]/gi, '');
                   //disccount
                   var dis = $("#discount").val();
                   var disc = dis.replace( /^\D+/g, '');
                   var discount = disc.replace(/[^\w\s]/gi, '');
                   var total = c/100;
                   var total2 = discount/100;
                   var total3 = total2*100;
                   var total1 = total + total3;
                   //alert("dis"+total1);
                   $("#totalamount").val(total1);       
               })
        }else{
       var x = document.getElementById('div_dis');
         x.style.display = "none";
       }
   });
 });
</script>
@endsection