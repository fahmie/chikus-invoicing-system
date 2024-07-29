
<style>
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
                    <li class="breadcrumb-item active" aria-current="page">List Delivery</li>
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
            <a href="{{ route('transporter.show',['id' => $id, 'tab' => 'due']) }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'due' ? 'active' : '' }}">
                <span class="card-header__title m-0">
                    In Transit
                </span>
            </a>
            <a href="{{ route('transporter.show',['id' => $id, 'tab' => 'unpaid']) }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'unpaid' ? 'active' : '' }}">
                <span class="card-header__title m-0">
                    Unpaid
                </span>
            </a>
            <a href="{{ route('transporter.show',['id' => $id, 'tab' => 'paid']) }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'paid' ? 'active' : '' }}">
                <span class="card-header__title m-0">
                Paid
                <!-- <span class="badge" style="margin-left: 10px; border-radius: 10px;">1</span> -->
                </span>
            
                
            </a>
        </div>
    </div>

@if($invoices->count() > 0)    
                
    <div class="table-responsive p-0" data-toggle="lists">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped p-0">
            <thead>
                <tr>
                    
                    <th class="text-center w-10px" style="padding:0.35rem 10px 0.35rem 1rem;">ID</th>
                    <th style="padding:0.35rem 10px;">Driver Name</th>
                    <th style="padding:0.35rem 10px;">Plate No.</th>
                    <th style="padding:0.35rem 10px;">Invoice Number</th>
                    <th style="padding:0.35rem 10px;">DO Number</th>
                    <th style="padding:0.35rem 10px;" class="text-center w-20px">Unit Price (RM)</th>
                    <th style="padding:0.35rem 10px;" class="text-center w-20px">Qty Start (Tan)</th>
                    <th style="padding:0.35rem 10px;" class="text-center w-20px">Qty Arrive (Tan)</th>
                    <th style="padding:0.35rem 10px;" class="text-center w-20px">Qty Shortage (Tan)</th>
                    <th style="padding:0.35rem 10px;" class="text-center w-30px">Transport Cost (RM)</th>
                    <th style="padding:0.35rem 10px;" class="w-30px">Location</th>
                    <th style="padding:0.35rem 10px;">Arrival Status</th>
                    @if ($tab=="paid" || $tab=="unpaid")
                    <th style="padding:0.35rem 10px;">Payment Status</th>
                    @endif
                    @if ($tab=="paid")
                    <th style="padding:0.35rem 1rem 0.35rem 10px;">Receipt</th>
                    @endif
                    @if ($tab=="unpaid")
                    <th style="padding:0.35rem 1rem 0.35rem 10px;">
                        <div class="text-center custom-control custom-checkbox ">
                            <input class="custom-control-input" style="margin: 0 !important; border: 1px solid #EFEFEF;" name="all" type="checkbox" id="checkall" checked>
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
        
                        <td class="p text-center w-30px" style="font-size: 14px; padding:0.35rem 10px 0.35rem 1rem;">
                            <a>
                            {{$key+1}}
                            </a>
                        </td>
                        <td class="text-muted mb-0" style="max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                            {{$invoice->drivers->name}}
                        </td>
                        <td class="p" style="font-size: 14px; padding:0.35rem 10px;">
                            <div class="badge badge-dark fs-0-9rem">
                                {{$invoice->platenumbers->number_plate}}
                            </div>
                        </td>
                        <td class="p" style="font-size: 14px; padding:0.35rem 10px;">
                            <a href="{{ route('invoices.details', $invoice->id) }}">
                                {{ $invoice->invoice_number }}
                            </a>
                        </td>
                        <td class="p" style="font-size: 14px">
                            @if($invoice->status == "OTW")
                            <a href="{{ route('invoices.detailsdocontract', $invoice->id) }}">
                            {{$invoice->do_number}}
                            </a>
                            @else
                            <a href="{{ route('invoices.detailsdoarrived', $invoice->id) }}">
                            {{$invoice->do_number}}
                            </a>
                            @endif
                        </td>
                        
                        <td class="p text-center" style="font-weight: 600; font-size: 14px; padding:0.35rem 10px;">
                        {{ $invoice->total_price/100 }}
                        </td>
                        <td class="p text-center" style="font-weight: 600; font-size: 14px; padding:0.35rem 10px;">
                        {{ $invoice->total_quantity/1 }}
                        </td>
                        @if ($tab=="due")
                        <td class="p text-center" style="font-weight: 600; font-size: 14px; padding:0.35rem 10px;">
                        -
                        </td>
                        @else
                        <td class="p text-center" style="font-weight: 600; font-size: 14px; padding:0.35rem 10px;">
                        @php
                            if($invoice->total_inaccurate == NULL){
                                $invoice->total_inaccurate = $invoice->total_quantity/1;
                            }
                            $sum +=$invoice->total_inaccurate;
                        @endphp
                        {{ $invoice->total_inaccurate}}
                        </td>
                        @endif
                        @if ($tab=="due")
                        <td class="p text-center" style="font-weight: 600; font-size: 14px; padding:0.35rem 10px;">
                        -
                        </td>
                        @else
                        <td class="p text-center" style="color: red; font-weight: 600; font-size: 14px; padding:0.35rem 10px;">
                        @php
                            $total_shortage = ($invoice->total_quantity/1) - $invoice->total_inaccurate;
                        @endphp
                        {{ round($total_shortage, 3)}}
                        </td>
                        @endif
                        
                        <td class="p text-center" style="font-weight: 600; font-size: 14px; padding:0.35rem 10px;">
                        {{ $invoice->price_transporter/100}}
                        </td>
                        <td class="p" style="font-weight: 600; text-transform: capitalize; font-size: 14px; padding:0.35rem 10px;">
                            {{ $invoice->transporter_location}}
                        </td>
                        <td class="p" style="font-size: 14px; padding:0.35rem 10px;">
                            @if($invoice->status == "COMPLETED")
                            <div class="badge badge-success fs-0-9rem">
                            {{ $invoice->status }}
                            </div>
                            @else
                            <div class="badge badge-info fs-0-9rem">
                            {{ $invoice->status }}
                            </div>
                            @endif
                        </td>   
                        @if ($tab=="paid" || $tab=="unpaid")
                        <td class="p" style="font-size: 14px; padding:0.35rem 10px;">
                            @if($invoice->transporter_paid_status ==NULL)
                            <div class="badge badge-danger fs-0-9rem">
                                {{"UNPAID"}}
                            </div>
                            @else
                            <div class="badge badge-success fs-0-9rem">
                                {{ $invoice->transporter_paid_status}}
                            </div>
                            @endif
                        </td>  
                        @endif
                        @if ($tab=="paid")
                        <td class="p" style="font-size: 14px; padding:0.35rem 1rem 0.35rem 10px;">
                        <a href="{{ route('transporter.detailsreceipt', ['id' => $id, 'tab' => 'all', 'transport' =>$invoice->transporter_reference_number]) }}">
                            {{ $invoice->receipt_tran_number }}
                        </a>   
                        </td>  
                        @endif
                        @if ($tab=="unpaid")
                        <td style="padding:0.35rem 1rem 0.35rem 10px;">
                            <div class="text-center custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input individual" name="ids[{{$invoice->id}}]" name2="opt" id="{{$invoice->id}}" value="{{((($invoice->price_transporter/100)*($invoice->total_inaccurate)) -((($invoice->total_quantity/1) - $invoice->total_inaccurate)*(($invoice->total_price/100)-($invoice->price_transporter/100))))*100}}" data-value2="{{($invoice->total_quantity*100)*($invoice->price_transporter/100)}}" data-value3="{{(($invoice->total_quantity/100) - $invoice->total_inaccurate)*($invoice->price_transporter/100)}}"> 
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
                    @if ($tab=="paid")
                    <td></td>
                    @endif
                    @if ($tab=="unpaid")

                    <td colspan="4"> 
                        <div class="row mt-2" style="float:right;">
                            <label style="text-transform: none;">Total Amount to Pay: RM</label>
                            <span><h6 style="padding: 0 10px 0 5px; margin-bottom: 0;" id="total"></h6></span>
                        </div>
                        {{-- <div class="row mt-2" style="float:right;">
                            <label style="text-transform: none;">Total Start: RM</label>
                            <span><h6 style="padding: 0 10px 0 5px; margin-bottom: 0;" id="total_start"></h6></span>
                        </div>
                        <div class="row mt-2" style="float:right;">
                            <label style="text-transform: none;">Total shortage: RM</label>
                            <span><h6 style="padding: 0 10px 0 5px; margin-bottom: 0;" id="total_short"></h6></span>
                        </div> --}}

                        
                        <!-- <input name="amount" id="total" type="text" class="form-control" autocomplete="off" value="0"> -->
                        <!-- <h6 id="total" style="border: 1px solid #DBDFE4; padding: 10px;"></h6> -->
                    {{-- </td>
                    <td colspan="4"> 
                        <div class="row mt-2" style="float:right;">
                            <label style="text-transform: none;">Total Start: RM</label>
                            <span><h6 style="padding: 0 10px 0 5px; margin-bottom: 0;" id="total_start"></h6></span>
                        </div>

                        
                        <!-- <input name="amount" id="total" type="text" class="form-control" autocomplete="off" value="0"> -->
                        <!-- <h6 id="total" style="border: 1px solid #DBDFE4; padding: 10px;"></h6> -->
                    </td>
                    <td colspan="4"> 
                        <div class="row mt-2" style="float:right;">
                            <label style="text-transform: none;">Total shortage: RM</label>
                            <span><h6 style="padding: 0 10px 0 5px; margin-bottom: 0;" id="total_short"></h6></span>
                        </div>

                        
                        <!-- <input name="amount" id="total" type="text" class="form-control" autocomplete="off" value="0"> -->
                        <!-- <h6 id="total" style="border: 1px solid #DBDFE4; padding: 10px;"></h6> -->
                    </td> --}}
                    @else
                    <td colspan="4"> 
                    </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>   
    <input type="hidden" id="checkID" name="checkID" value="">
    @if ($tab=="unpaid")
    <div class="row">
        <div class="col-md-12 text-center" style="margin: auto;">
            <button type="button"  id="pay"  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-md">PAY NOW</button>
        </div>
    </div>
    @endif  
    <div class="row card-body pagination-light justify-content-center text-center">
        {{ $invoices->links() }}
    </div>   
    @else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">description</i>
    </div>
    <div class="row justify-content-center card-body pt-2 pb-5">
        <p class="h4">No Transporter yet</p>
    </div>
@endif 
</div>
    
@endsection


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="max-width:700px;" role="document">
        <div class="modal-content">
        <div class="modal-header" style="background-color: #78B5E7;">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="modal-title" style="color: #fff; text-align:center;" id="exampleModalLabel">Payment Details</h5>    
                </div>
                <div class="col-md-12" style="margin: auto;">
                    <p style="margin:0 !important; font-size: 12px; font-weight: 600; text-align:center; padding:0 5px; background-color: #78B5E7; color: #fff;">Please check details below before confirm the payment</p>
                </div>
            </div>
        </div>
        <div class="modal-body p-0">
            <div class="container">
                <div class="row">
                    <div class="boxes" style="margin: auto; width: 100%">
                        <table class="table table-striped border-bottom mb-0">
                            <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            <strong>Quantity Start</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-control" style= "background: #eee; width: 100%; font-weight: 600;" id="qty_start"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <strong>Quantity Arrived</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-control" style= "background: #eee;width: 100%;font-weight: 600;" id="qty_arrived"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <strong>Quantity Shortage</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-control" style= "background: #eee;width: 100%;font-weight: 600;" id="qty_shortage"></div>
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
                                            <input type="hidden" id="qty_start1" name="qty_start1" value=""> 
                                            <input type="hidden" id="qty_arrived1" name="qty_arrived1" value=""> 
                                            <input type="hidden" id="qty_shortage1" name="qty_shortage1" value=""> 
                                            <input type="hidden" id="total_amount1" name="total_amount1" value=""> 
                                            <input type="hidden" id="total5" name="total5" value=""> 
                                            <input type="hidden" id="total6" name="total6" value=""> 
                                            <input type="hidden" id="total_shortage2" name="total_shortage2" value="">
                                            <input type="hidden" id="balance" name="balance" value=""> 
                                            <input type="hidden" id="discount" name="discount" value="">  
                                            <input type="hidden" id="total_start1" name="total_start1" value="">  
                                            <input type="hidden" id="total_short1" name="total_short1" value="">  
                                                <strong>Transportation Billed Amount</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <h6 class="form-control" style="background: #eee;margin-bottom: 0; color: green" id="total3"></h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <strong>Payment Status<span class="required" style="color:#dc3545"> *</span></strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <select name="payment_status" id="payment_status" data-toggle="select">
                                            <option disabled selected>Select Payment Status</option>
                                            @foreach ($payment_status as $payment_status)
                                            <option value="{{ $payment_status->id}}"
                                            @if ($payment_status->id == 2 || $payment_status->id == 3)
                                                disabled
                                            @endif
                                            >{{$payment_status->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <strong>Payment types<span class="required" style="color:#dc3545"> *</span></strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <select name="payment_type" id="payment_type" data-toggle="select">
                                            <option disabled selected>Select Payment Type</option>
                                            @foreach ($payment_type as $payment)
                                            <option value="{{$payment->id}}">{{$payment->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                        <strong>Reference Numbers<span class="required" style="color:#dc3545"> *</span></strong>
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
                                        <strong>Nett Amount to Pays<span class="required" style="color:#dc3545"> *</span></strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="input-group input-group-merge">
                                            <input name="payment_prefix" type="hidden" value="">
                                            <input name="net_pay_amount" id="net_pay_amount" type="number" pattern="[0-9]+([\.][0-9]+)?" step="0.01" class="form-control form-control-prepended" value="" autocomplete="off" required>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr> 
                                <tr id="div_blance" style="display: none;">
                                    <td>
                                        <div class="form-group">
                                            <strong>Balance</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                    <div class="form-group">
                                        <input name="balance" id="balance" type="text" class="form-control price_blance priceListener" autocomplete="off" value="0" required>
                                    </div>
                                    </td>
                                    
                                </tr>
                                <tr  id="div_dis" style="display: none;">
                                    <td>
                                        <div class="form-group">
                                            <strong>Discount</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                    <div class="form-group">
                                        <input name="discount" id="discount" type="text" class="form-control price_discount priceListener" autocomplete="off" value="0" required>
                                    </div>
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="totalamount" name="total_amount" value="">
        <input type="hidden" id="total2" name="total" value="">
        <div class="modal-footer" style="margin: auto; border-top: none;">
            <button type="button" class="btn btn-danger" id="close1" data-dismiss="modal">Cancel</button>
            <button type="submit" id="submit1" class="btn btn-success" data-dismiss="modal">Submit</button>
        </div>
        </div>
    </div>
</div>
@section('page_body_scripts')
<script>
    $(document).ready(function(){
       //$('#checkall').click(function(){
            if($('#checkall').prop("checked") == true){
               // console.log("Checkbox is checked.");
                $("input[name2='opt']").prop('checked', true)
                    totalCount = calculateAll()
                    totalCount2 = calculateAll2()
                    //alert(totalCount2);
                    $("#total_start").html("RM"+" "+totalCount2/100);
                    $("#total_start1").val(totalCount2);
                    $("#total_short").html("RM"+" "+((totalCount2 - totalCount)/100));
                    $("#total_short1").val((totalCount2 - totalCount)/100);
                    $("#total").html(totalCount/100);
                    $("#total2").val(totalCount/100);
                    $("#total3").html("RM"+" "+totalCount/100);
                    $("#total4").html("RM"+" "+totalCount/100);
                    $("#total5").val(totalCount);
                    $("#total6").val(totalCount);

            }
            else if($('#checkall').prop("checked") == false){
                console.log("Checkbox is unchecked.");
                $("input[name2='opt']").prop('checked', false)
            }
       //});
    });

$("#checkall").change(function() {
    toggleCheckAll(this.checked)
    totalCount = calculateAll()
    totalCount2 = calculateAll2()
    //alert(totalCount2); 
    $("#total_start").html("RM"+" "+totalCount2/100);
    $("#total_start1").val(totalCount2);
    $("#total_short").html("RM"+" "+((totalCount2 - totalCount)/100));
    $("#total_short1").val((totalCount2 - totalCount)/100);
    $("#total").html(totalCount/100);
    $("#total2").val(totalCount/100);
    $("#total3").html("RM"+" "+totalCount/100);
    $("#total4").html("RM"+" "+totalCount/100);
    $("#total5").val(totalCount);
    $("#total6").val(totalCount);
  });    
    
  $("input[name2='opt']").change(function() {
      totalCount = calculateAll()
      totalCount2 = calculateAll2()
      //alert(totalCount2); 
      $("#total_start").html("RM"+" "+totalCount2/100);
      $("#total_start1").val(totalCount2);
      $("#total_short").html("RM"+" "+((totalCount2 - totalCount)/100));
      $("#total_short1").val((totalCount2 - totalCount)/100);
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
    total = 0;
    $("input[name2='opt']").each(function(index, checkbox){
      if(checkbox.checked)
        count += parseInt(checkbox.value)
        total = count.toFixed(2);
    })
    return total;  
    };

    function calculateAll2(){
    count1 = 0.00;
    total = 0;
    $("input[name2='opt']").each(function(index, checkbox){
      if(checkbox.checked)
        count1 += parseInt(checkbox.getAttribute("data-value2"));
        total = count1.toFixed(2);
    })
    return total;  
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
               console.log(data);
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

     console.log($('#total_start1').val());
     event.preventDefault();
    var checkID = $('#checkID').val();
    var qty_start = $('#qty_start1').val();
    var qty_arrived = $('#qty_arrived1').val();
    var qty_shortage = $('#qty_shortage1').val();
    var amount_start = $('#total_start1').val();
    var amount_arrived = $('#total5').val()/100;
    var amount_shortage = $('#total_short1').val();
    var net_pay = $('#net_pay_amount').val();
    var payment_status = $("#payment_status").val();
    var payment_type = $("#payment_type").val();
    var reference_number_tran = $("#reference_number_trans").val();
    var balance = $("#balance").val();
    var discount = $("#discount").val();
     //console.log(qty_start)
     $.ajax({
     url: '/createreceipttransporter',
     type: "POST",
     data: {
         "_token": "{{ csrf_token() }}",
         checkID:checkID,
         payment_type:payment_type,
         payment_status:payment_status,
         reference_number_tran:reference_number_tran,
         qty_start:qty_start,
         qty_arrived:qty_arrived,
         qty_shortage:qty_shortage,
         amount_start:amount_start,
         amount_arrived:amount_arrived,
         amount_shortage:amount_shortage,
         net_pay:net_pay,
         balance:balance,
         discount:discount,
     },
     dataType: 'json',
     success: function (data) {
       // console.log(data);
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
   $(document).ready(function() {
        $('#payment_status').on('change', function() {
            var value = $(this).val();
            if(value == "1") {
                var a = $("#total2").val();
                $("#amount").val(a*100);
                //document.getElementById("amount").readOnly =true;
            }else{
                //document.getElementById("amount").readOnly =false;
            }
            
            if(value == "2") {
            var x = document.getElementById('div_blance');
            x.style.display = "";
            
                $( "#submit" ).click(function() {
                    var a = $("#amount").val();
                    var b = a.replace( /^\D+/g, '');
                    var c = b.replace(/[^\w\s]/gi, '');
                    //blance
                    var bla = $("#blance").val()
                    var total = c/100;
                    var total1 = parseFloat(total) + parseFloat(bla);
                    //alert(total1);
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
                    var total = c/100;
                    var total1 = parseFloat(total) + parseFloat(dis);
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
