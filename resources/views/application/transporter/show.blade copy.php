
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

<form action="" method="GET">
    <div class="card card-form d-flex flex-column flex-sm-row">
        <div class="card-form__body card-body-form-group flex">
            <div class="row">
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[platenumbers.number_plate]">Driver Name</label>
                        <input name="filter[platenumbers.number_plate]" type="text" class="form-control" value="{{ Request::get("filter")==['platenumbers.number_plate'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[invoice_number]">Plate No.</label>
                        <input name="filter[invoice_number]" type="text" class="form-control" value="{{ Request::get("filter")==['invoice_number'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[do_number]">Invoice Number</label>
                        <input name="filter[do_number]" type="text" class="form-control" value="{{ Request::get("filter")==['do_number'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[receipt_number]">DO Number</label>
                        <input name="filter[receipt_number]" type="text" class="form-control" value="{{ Request::get("filter")==['receipt_number'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[items.quantity]">Receipt Number</label>
                        <input name="filter[items.quantity]" type="text" class="form-control" value="{{ Request::get("filter")==['items.quantity'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[items.quantity]">Qty Start (Tan)</label>
                        <input name="filter[items.quantity]" type="text" class="form-control" value="{{ Request::get("filter")==['items.quantity'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[items.quantity]">Qty Arrived (Tan)</label>
                        <input name="filter[items.quantity]" type="text" class="form-control" value="{{ Request::get("filter")==['items.quantity'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[items.quantity]">Qty Shortage (Tan)</label>
                        <input name="filter[items.quantity]" type="text" class="form-control" value="{{ Request::get("filter")==['items.quantity'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[accurate_remark]">Arrival Status</label>
                        <input name="filter[accurate_remark]" type="text" class="form-control" value="{{ Request::get("filter")==['accurate_remark'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[accurate_remark]">Status</label>
                        <input name="filter[accurate_remark]" type="text" class="form-control" value="{{ Request::get("filter")==['accurate_remark'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <a href="">{{ __('messages.clear_filters') }}</a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons text-primary icon-20pt">refresh</i>
            {{ __('messages.filter') }}
        </button>
    </div>
</form>

<div class="card">
    <div class="card-header card-header-large bg-white">
        <h4 class="card-header__title">Completed Transactions</h4>
    </div>
    <div class="card-body p-0">
        <div class="card-form__body" style="background:#fff; padding-top: 0;">
            
            <div class="table-responsive p-0" data-toggle="lists">
                <table class="table table-xl mb-0 thead-border-top-0 table-striped p-0">
                    <thead>
                        <tr>
                            
                            <th class="text-center w-10px">{{ __('messages.#id') }}</th>
                            <th>Driver Name</th>
                            <th>Plate No.</th>
                            <th>Invoice Number</th>
                            <th>DO Number</th>
                            <th>Receipt Number</th>
                            <th class="text-center w-30px">Qty Start (Tan)</th>
                            <th class="text-center w-30px">Qty Arrive (Tan)</th>
                            <th class="text-center w-30px">Qty Shortage (Tan)</th>
                            <th class="text-center w-30px">Transport Cost (RM)</th>
                            <th><bold>Arrival Status</bold></th>
                            <th><bold>Status</bold></th>
                            <th class="w-5">
                                <div class="text-center custom-control custom-checkbox ">
                                    <input class="custom-control-input" style="margin: 0 !important; border: 1px solid #EFEFEF;" name="all" type="checkbox" id="checkall">
                                    <label class="custom-control-label" for="checkall" ></label>
                                </div>
                            </th> 
                        </tr>
                    </thead>
                    <tbody class="list" id="expenses">
                            <tr>
                            @foreach($invoices as $key => $invoice)
                
                                <td class="p text-center w-30px" style="font-size: 14px">
                                    <a>
                                    {{$key+1}}
                                    </a>
                                </td>
                                <td class="p" style="font-size: 14px">
                                    {{$invoice->drivers->name}}
                                </td>
                                <td class="p" style="font-size: 14px">
                               {{$invoice->platenumbers->number_plate}}
                                </td>
                                
                                <td class="p" style="font-size: 14px">
                                {{ $invoice->invoice_number }}
                                </td>
                                <td class="p" style="font-size: 14px">
                                {{ $invoice->do_number }}
                                </td>
                                <td class="p" style="font-size: 14px">
                                {{ $invoice->receipt_number }}
                                </td>
                                <td class="p text-center" style="font-weight: 600; font-size: 14px">
                                <?php
                                $sum=0;
                                foreach($invoice->items as $data)
                                {
                                    $sum+= $data->quantity;
                                }
                                echo $sum;
                                ?>
                                </td>
                                <td class="p text-center" style="font-weight: 600; font-size: 14px">
                                @if(empty($invoice->accurate_remark))
                                    {{ $sum }}
                                @else
                                    {{ $invoice->accurate_remark }}
                                @endif
                                </td>
                                <td class="p text-center" style="font-weight: 600; font-size: 14px">
                                @if(empty($invoice->accurate_remark))
                                @php
                                    $shortage = $sum - $sum;
                                @endphp
                                    {{ $shortage }}
                                @else
                                @php
                                    $shortage = $sum - $invoice->accurate_remark;
                                @endphp
                                    {{ $shortage }}
                                @endif
                                </td>
                                <td class="p" style="font-size: 14px">
                                    <div class="badge badge-success fs-0-9rem">
                                       {{ $invoice->accurate }}
                                    </div>
                                </td>   
                                <td class="p" style="font-size: 14px">
                                    <div class="badge badge-success fs-0-9rem">
                                        {{ $invoice->paid_status }}
                                    </div>
                                </td>  
                                <td class="w-5">
                                    <div class="text-center custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input individual" type="checkbox" name="ids[{{$invoice->id}}]" name2="opt" id="{{$invoice->id}}" value="{{ $sum}}">
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
            <div class="row card-body pagination-light justify-content-center text-center">
            </div>
            <div class="row card-body justify-content-center text-center">
                    <button type="button"  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-md">PAY NOW</button>
            </div>

        </div>

    </div>
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
                        <div class="row" style="margin: auto;">
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <input type="hidden" id="driver1" name="driver1" value=""> 
                                    <label><strong>Quantity Start:</strong></label>
                                    <span><h6 style="color: blue">200 Tan</h6></span>
                                </div>
                                <div class="form-group">
                                    <label><strong>Quantity Arrived:</strong></label>
                                    <h6 style="color: blue">180 Tan</h6>
                                </div>
                                <div class="form-group">
                                    <label><strong>Quantity Shortage:</strong></label>
                                    <h6 style="color: red">20 Tan</h6>
                                </div>
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label><strong>Amount Start:</strong></label>
                                    <h6 style="color: blue">RM 2000</h6>
                                </div>
                                <div class="form-group">
                                    <label><strong>Amount Arrived:</strong></label>
                                    <h6 style="color: blue">RM 1800</h6>
                                </div>
                                <div class="form-group">
                                    <label><strong>Amount Shortage:</strong></label>
                                    <h6 style="color: red">RM 200</h6>
                                </div>
                                <div class="form-group">
                                    <label><strong>Nett Amount to Pay:</strong></label>
                                    <h6 style="color: green">RM 1800</h6>
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="margin: auto;">
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

</script>
@endsection
