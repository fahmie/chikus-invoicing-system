
<!-- transporter -->
<style>
    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        overflow-x: hidden;
        scroll-behavior: smooth;
        text-align: center;
    }
    .custom-navbar {
        position: -webkit-sticky;
        position: sticky;
        top: -1px;
        width: 100%;
        height: auto;
        padding: 0px 10px;
        z-index: 9;
        background-color: transparent;
    }
    .custom-navbar li{
        text-decoration: none;
        list-style: none;
        padding: 12px 0px;
        display:inline-block;
        list-style-type: none;
        letter-spacing: 1.2px;
    }
    .custom-navbar li a{
        color: #000;
        font-size: 14px;
        padding: 9px 5px;
        border-radius: 4px 4px;
    }
    .custom-navbar li a:hover{
        color: #404040;
        text-decoration: none;
        cursor: pointer;
        background-color: rgba(0,0,0,0.1111);
        -webkit-box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
    }
    .custom-navbar li a:focus, .custom-navbar li a.focus, .custom-navbar li a.active, .custom-navbar li a:active{
        color: #E4E4E4;
        text-decoration: none;
        cursor: pointer;
        background-color: rgba(0,0,0,0.8);
        -webkit-box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
    }
    .custom-navbar li img{
        width: 30px;
        height: 30px;
    }

    .titletip {
    position: relative;
    display: inline-block;
    }

    .titletip .textTop {
    visibility: hidden;
    min-width: 120px;
    max-width: 150px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 5px;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
    }

    .titletip .textTop::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
    }

    .titletip .textBottom {
    visibility: hidden;
    min-width: 120px;
    max-width: 150px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 5px;
    position: absolute;
    z-index: 1;
    top: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
    }

    .titletip .textBottom::after {
    content: " ";
    position: absolute;
    bottom: 100%;  /* At the top of the tooltip */
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent transparent black transparent;
    }

    .titletip:hover .textTop, .titletip:hover .textBottom {
    visibility: visible;
    opacity: 0.85;
    }
    /* Blink for Webkit and others
    (Chrome, Safari, Firefox, IE, ...)
    */

    @-webkit-keyframes blinker {
    from {opacity: 1.0;}
    to {opacity: 0.0;}
    }
    .blink{
        text-decoration: blink;
        -webkit-animation-name: blinker;
        -webkit-animation-duration: 0.8s;
        -webkit-animation-iteration-count:infinite;
        -webkit-animation-timing-function:ease-in-out;
        -webkit-animation-direction: alternate;
    }
    .modal {
        text-align: center;
    }

    @media screen and (min-width: 768px) { 
    .modal:before {
        display: inline-block;
        vertical-align: middle;
        content: " ";
        height: 100%;
    }
    }

    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
    }
    .size-filter{
        width: 20% !important;
    }
    @media screen and (max-width: 768px) {
        .size-filter{
            width: 100% !important;
        }
    }
    @media screen and (max-width: 1440) {
        .size-filter{
            width: 50% !important;
        }
    }
</style>
@extends('layouts.app', ['page' => 'transporter'])

@section('title', __('Details Transporter'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('transporter') }}">Transporter</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List Transaction</li>
                </ol>
            </nav>
            <h1 class="m-0">List Delivery</h1>
        </div>
    </div>
@endsection
@section('content')
@include('application.transporter._filters2')

<div class="card">
    <div class="card-header bg-white p-0">
        <div class="row no-gutters flex nav">
            
            <a href="{{ route('transporter.show',['id' => $id, 'tab' => 'due']) }}" class="col-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab ?? '' == 'due' ? 'active' : '' }}">
                <span class="card-header__title m-0">
                    Unpaid
                </span>
            </a>
            <a href="{{ route('transporter.show',['id' => $id, 'tab' => 'all']) }}" class="col-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab ?? '' == 'all' ? 'active' : '' }}">
                <span class="card-header__title m-0">
                Paid
                <!-- <span class="badge" style="margin-left: 10px; border-radius: 10px;">1</span> -->
                </span>
            
                
            </a>
        </div>
    </div>
    <!-- <div class="card"> -->
        <!-- <div class="card-header card-header-large bg-white">
            <h4 class="card-header__title">Completed Transactions</h4>
        </div> -->
        <!-- <div class="card-body p-0"> -->
            <!-- <div class="card-form__body" style="background:#fff; padding-top: 0;"> -->
                
                <div class="table-responsive p-0" data-toggle="lists">
                    <table class="table table-xl mb-0 thead-border-top-0 table-striped p-0">
                        <thead>
                            <tr>
                                
                                <th class="text-center w-10px">{{ __('messages.#id') }}</th>
                                <th>Driver Name</th>
                                <th>Plate No.</th>
                                <th>Invoice Number</th>
                                <th>DO Number</th>
                                <th class="text-center w-20px">Unit Price (RM)</th>
                                <th class="text-center w-20px">Qty Start (Tan)</th>
                                <th class="text-center w-20px">Qty Arrive (Tan)</th>
                                <th class="text-center w-20px">Qty Shortage (Tan)</th>
                                <th class="text-center w-30px">Transport Cost (RM)</th>
                                <th class="w-30px">Location</th>
                                <th>Arrival Status</th>
                                <th>Status Transporter Payment</th>
                                @if ($tab=="all")
                                <th>Receipt</th>
                                @endif
                                @if ($tab=="due")
                                <th class="w-60">
                                    <div class="text-center custom-control custom-checkbox ">
                                        <input class="custom-control-input" style="margin: 0 !important; border: 1px solid #EFEFEF;" name="all" type="checkbox" id="checkall">
                                        <label class="custom-control-label" for="checkall" ></label>
                                    </div>
                                </th> 
                                @endif
                            </tr>
                        </thead>
                        <tbody class="list" id="expenses">
                                <tr>
                                    @php
                                        $sum =0;
                                    @endphp
                                @foreach($invoices as $key => $invoice)
                    
                                    <td class="p text-center w-30px" style="font-size: 14px">
                                        <a>
                                        {{$key+1}}
                                        </a>
                                    </td>
                                    <td class="p" style="font-size: 12px; text-transform: uppercase;">
                                        {{$invoice->drivers->name}}
                                    </td>
                                    <td class="p" style="font-size: 14px">
                                        <div class="badge badge-dark">
                                            {{$invoice->platenumbers->number_plate}}
                                        </div>
                                    </td>
                                    <td class="p" style="font-size: 12px">
                                        {{ $invoice->invoice_number }}
                                    </td>
                                    <td class="p" style="font-size: 12px">
                                        {{ $invoice->do_number }}
                                    </td>
                                    
                                    <td class="p text-center" style="font-weight: 600; font-size: 14px">
                                    {{ $invoice->total_price/100 }}
                                    </td>
                                    <td class="p text-center" style="font-weight: 600; font-size: 14px">
                                    {{ $invoice->total_quantity/1 }}
                                    </td>
                                    <td class="p text-center" style="font-weight: 600; font-size: 14px">
                                    @php
                                        if($invoice->total_inaccurate == NULL){
                                            $invoice->total_inaccurate = $invoice->total_quantity/1;
                                        }
                                        $sum +=$invoice->total_inaccurate;
                                    @endphp
                                    {{ $invoice->total_inaccurate}}
                                    </td>
                                    <td class="p text-center" style="color: red; font-weight: 600; font-size: 14px">
                                    {{ ($invoice->total_quantity/1) - $invoice->total_inaccurate}}
                                    </td>
                                    <td class="p text-center" style="font-weight: 600; font-size: 14px">
                                    {{ $invoice->price_transporter/100}}
                                    </td>
                                    <td class="p" style="font-weight: 600; text-transform: uppercase; font-size: 12px">
                                        {{ $invoice->transporter_location}}
                                    </td>
                                    <td class="p" style="font-size: 13px">
                                        <div class="badge badge-success">
                                        {{ $invoice->status }}
                                        </div>
                                    </td>   
                                    <td class="p" style="font-size: 13px">
                                        <div class="badge badge-success">
                                        @if($invoice->transporter_paid_status ==NULL)
                                            {{"UNPAID"}}
                                        @endif
                                            {{ $invoice->transporter_paid_status}}
                                        </div>
                                    </td>  
                                    @if ($tab=="all")
                                    <td class="p" style="font-size: 13px">
                                    <a href="{{ route('transporter.detailsreceipt', ['id' => $id, 'tab' => 'all', 'transport' =>$invoice->transporter_reference_number]) }}">
                                        {{ $invoice->receipt_tran_number }}
                                    </a>   
                                    </td>  
                                    @endif
                                    @if ($tab=="due")
                                    <td class="w-5">
                                        <div class="text-center custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input individual" type="checkbox" name="ids[{{$invoice->id}}]" name2="opt" id="{{$invoice->id}}" value="{{((($invoice->price_transporter/100)*($invoice->total_inaccurate)) -((($invoice->total_quantity/1) - $invoice->total_inaccurate)*(($invoice->total_price/100)-($invoice->price_transporter/100))))*100}}"> 
                                        <label class="custom-control-label" for="{{$invoice->id}}"></label>
                                        </div>
                                    </td>
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
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @if ($tab=="all")
                                <td></td>
                                @endif
                                @if ($tab=="due")

                                <td colspan="3"> 
                                    <div class="row mt-2" style="float:right;">
                                        <label style="text-transform: none;">Total Amount to Pay: RM</label>
                                        <span><h6 style="padding: 0 10px 0 5px; margin-bottom: 0;" id="total"></h6></span>
                                    </div>
                                    <!-- <input name="amount" id="total" type="text" class="form-control" autocomplete="off" value="0"> -->
                                    <!-- <h6 id="total" style="border: 1px solid #DBDFE4; padding: 10px;"></h6> -->
                                </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>                  
                <div class="row card-body pagination-light justify-content-center text-center">
                </div>
                <input type="hidden" id="checkID" name="checkID" value="">
                @if ($tab=="due")
                <div class="row card-body justify-content-center text-center">
                    <button type="button" id="pay"  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-md">PAY NOW</button>
                </div>
                @endif

            <!-- </div> -->

        <!-- </div> -->
    <!-- </div> -->
    
</div>
    
@endsection


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="max-width:700px;" role="document">
        <div class="modal-content">
        <div class="modal-header" style="background-color: #78B5E7;">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="modal-title" style="color: #fff; text-align:center;" id="exampleModalLabel">Payment Details</h6>    
                </div>
                <div class="col-md-12" style="margin: auto;">
                    <p style="margin:0 !important; font-size: 12px; font-weight: 600; text-align:center; padding:0 5px; background-color: #78B5E7; color: #fff;">Please check details below before confirm the payment</p>
                </div>
            </div>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="boxes" style="margin: auto; width: 100%">
                        <table class="table table-striped border-bottom mb-0">
                            <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            <input type="hidden" id="qty_start1" name="qty_start1" value=""> 
                                            <input type="hidden" id="qty_arrived1" name="qty_arrived1" value=""> 
                                            <input type="hidden" id="qty_shortage1" name="qty_shortage1" value=""> 
                                            <input type="hidden" id="total_amount1" name="total_amount1" value=""> 
                                            <input type="hidden" id="total5" name="total5" value=""> 
                                            <input type="hidden" id="total6" name="total6" value=""> 
                                            <input type="hidden" id="total_shortage2" name="total_shortage2" value=""> 
                                                <strong>Quantity Start</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="badge badge-dark fs-0-9 rem" id="qty_start"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <input type="hidden" id="qty_arrived1" name="qty_arrived1" value=""> 
                                            <input type="hidden" id="qty_shortage1" name="qty_shortage1" value=""> 
                                            <input type="hidden" id="total_amount1" name="total_amount1" value=""> 
                                            <input type="hidden" id="total5" name="total5" value=""> 
                                            <input type="hidden" id="total6" name="total6" value=""> 
                                            <input type="hidden" id="total_shortage2" name="total_shortage2" value=""> 
                                                <strong>Quantity Arrived</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="badge badge-dark fs-0-9rem" id="qty_arrived"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <input type="hidden" id="qty_arrived1" name="qty_arrived1" value=""> 
                                            <input type="hidden" id="qty_shortage1" name="qty_shortage1" value=""> 
                                            <input type="hidden" id="total_amount1" name="total_amount1" value=""> 
                                            <input type="hidden" id="total5" name="total5" value=""> 
                                            <input type="hidden" id="total6" name="total6" value=""> 
                                            <input type="hidden" id="total_shortage2" name="total_shortage2" value=""> 
                                                <strong>Quantity Shortage</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="badge badge-dark fs-0-9rem" id="qty_shortage"></div>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td>
                                        <div>
                                            <input type="hidden" id="qty_arrived1" name="qty_arrived1" value=""> 
                                            <input type="hidden" id="qty_shortage1" name="qty_shortage1" value=""> 
                                            <input type="hidden" id="total_amount1" name="total_amount1" value=""> 
                                            <input type="hidden" id="total5" name="total5" value=""> 
                                            <input type="hidden" id="total6" name="total6" value=""> 
                                            <input type="hidden" id="total_shortage2" name="total_shortage2" value=""> 
                                                <strong>Amount Start</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="badge badge-dark" id="total_amount"></div>
                                    </td>
                                </tr> -->
                                <!-- <tr>
                                    <td>
                                        <div>
                                            <input type="hidden" id="qty_arrived1" name="qty_arrived1" value=""> 
                                            <input type="hidden" id="qty_shortage1" name="qty_shortage1" value=""> 
                                            <input type="hidden" id="total_amount1" name="total_amount1" value=""> 
                                            <input type="hidden" id="total5" name="total5" value=""> 
                                            <input type="hidden" id="total6" name="total6" value=""> 
                                            <input type="hidden" id="total_shortage2" name="total_shortage2" value=""> 
                                                <strong>Amount Arrived</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="badge badge-dark" id="total4"></div>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td>
                                        <div>
                                            <input type="hidden" id="qty_arrived1" name="qty_arrived1" value=""> 
                                            <input type="hidden" id="qty_shortage1" name="qty_shortage1" value=""> 
                                            <input type="hidden" id="total_amount1" name="total_amount1" value=""> 
                                            <input type="hidden" id="total5" name="total5" value=""> 
                                            <input type="hidden" id="total6" name="total6" value=""> 
                                            <input type="hidden" id="total_shortage2" name="total_shortage2" value=""> 
                                                <strong>Payment type</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <select name="payment_status" id="payment_status" data-toggle="select">
                                            <option disabled selected>Select Payment Type</option>
                                            @foreach ($payment_type as $payment)
                                            <option value="{{$payment->name}}">{{$payment->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <input type="hidden" id="qty_arrived1" name="qty_arrived1" value=""> 
                                            <input type="hidden" id="qty_shortage1" name="qty_shortage1" value=""> 
                                            <input type="hidden" id="total_amount1" name="total_amount1" value=""> 
                                            <input type="hidden" id="total5" name="total5" value=""> 
                                            <input type="hidden" id="total6" name="total6" value=""> 
                                            <input type="hidden" id="total_shortage2" name="total_shortage2" value=""> 
                                                <strong>Reference Number</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="input-group input-group-merge">
                                            <input name="payment_prefix" type="hidden" value="">
                                            <input name="reference_number_trans" id="reference_number_trans" type="text"  class="form-control form-control-prepended" value="" autocomplete="off" required>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                </tr>   
                                <tr>
                                    <td>
                                        <div>
                                            <input type="hidden" id="qty_arrived1" name="qty_arrived1" value=""> 
                                            <input type="hidden" id="qty_shortage1" name="qty_shortage1" value=""> 
                                            <input type="hidden" id="total_amount1" name="total_amount1" value=""> 
                                            <input type="hidden" id="total5" name="total5" value=""> 
                                            <input type="hidden" id="total6" name="total6" value=""> 
                                            <input type="hidden" id="total_shortage2" name="total_shortage2" value=""> 
                                                <strong>Nett Amount to Pay</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                            <h6 style="margin-bottom: 0; color: green" id="total3"></h6>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="margin: auto; border-top: none;">
            <button type="button" class="btn btn-danger" id="close1" data-dismiss="modal">Cancel</button>
            <button type="submit" id="submit1" class="btn btn-success" data-dismiss="modal">Submit</button>
        </div>
        </div>
    </div>
</div>
@section('page_body_scripts')
<script>

$("#checkall").change(function() {
    toggleCheckAll(this.checked)
    totalCount = calculateAll()
    //alert(totalCount); 
    $("#total").html(totalCount/100);
    $("#total2").val(totalCount/100);
    $("#total3").html("RM"+" "+totalCount/100);
    $("#total4").html("RM"+" "+totalCount/100);
    $("#total5").val(totalCount);
    $("#total6").val(totalCount);
  });    
    
  $("input[name2='opt']").change(function() {
      totalCount = calculateAll()
      //alert(totalCount);
      $("#total").html(totalCount/100);
      $("#total2").val(totalCount/100);
      $("#total3").html("RM"+" "+totalCount/100);
      $("#total4").html("RM"+" "+totalCount/100);
      $("#total5").val(totalCount);
      $("#total6").val(totalCount);
  });
    
  function toggleCheckAll(checked){
    $("input[name2='opt']").prop('checked', checked)
  }
    
  function calculateAll(){
    count = 0.00;
    $("input[name2='opt']").each(function(index, checkbox){
      if(checkbox.checked)
        count += parseInt(checkbox.value)
    })
    return count;  
    };


$("#pay").on("click", function() {
  var checkedIds = $("input[name2='opt']:checked").map(function() {
    return this.id;
  }).toArray();
  $("#checkID").val(checkedIds.join(", "));
  var checkID = $('#checkID').val();
  // console.log(checkID)

    if(checkID) {
        $.ajax({
            url: '/transporterselected/'+checkID,
            type: "GET",
            data : {"_token":"{{ csrf_token() }}"},
            dataType: "json",
            success:function(data) {
               // console.log(data);
              if(data){
                var amount_arrived = $('#total5').val();
                var qty_start = $("#qty_start").html(data[0].total_tan+" "+"Tan");
                 var qty_arrived = $("#qty_arrived").html(data[0].total_arrived+" "+"Tan");
                 var shortage = data[0].total_tan - data[0].total_arrived;
                 var shor = shortage.toFixed(2);
                 var qty_shortage = $("#qty_shortage").html(shor +" "+"Tan");
                 var amount_shortage = amount_arrived - data[0].total_amount/100;
                 var total_shortage = $("#total_shortage").html("RM"+" "+amount_shortage);
                 var total_amount = $("#total_amount").html("RM"+" "+data[0].total_amount/100);

                 var qty_start1 = $("#qty_start1").val(data[0].total_tan*100);
                 var qty_arrived1 = $("#qty_arrived1").val(data[0].total_arrived*100);
                 var shortage1 = data[0].total_tan - data[0].total_arrived;
                 var shor1 = shortage1.toFixed(2);
                 var qty_shortage1 = $("#qty_shortage1").val(shor1*100);
                 var total_amount1 = $("#total_amount1").val(data[0].total_amount);
          }else{
            
               }
               }
             });
         }else{
          
         }
});


$('#submit1').on('click', function (event) {

     //console.log("here accurate");
     event.preventDefault();
    var checkID = $('#checkID').val();
    var qty_start = $('#qty_start1').val();
    var qty_arrived = $('#qty_arrived1').val();
    var qty_shortage = $('#qty_shortage1').val();
    var amount_start = $('#total_amount1').val();
    var amount_arrived = $('#total5').val();
    var amount_shortage = $('#total_shortage1').val();
    var net_pay = $('#total6').val();
    var payment_type = $("#payment_status").val();
    var referenve_number = $("#reference_number_trans").val();
     console.log(qty_start)
     $.ajax({
     url: '/createreceipttransporter',
     type: "POST",
     data: {
         "_token": "{{ csrf_token() }}",
         checkID:checkID,
         payment_type:payment_type,
         referenve_number:referenve_number,
         qty_start:qty_start,
         qty_arrived:qty_arrived,
         qty_shortage:qty_shortage,
         amount_start:amount_start,
         amount_arrived:amount_arrived,
         amount_shortage:amount_shortage,
         net_pay:net_pay,
     },
     dataType: 'json',
     success: function (data) {
    //  console.log(data);  
     window.location.reload(true);


     },
     error: function (data) {
         //console.log(data.responseJSON.message);  
         // window.location.reload(true);
         Swal.fire({
         icon: 'error',
         title: 'Oops...',
         text: data.responseJSON.message,
         })
         //console.log(data);
     }
    });
    });
            
</script>
@endsection
