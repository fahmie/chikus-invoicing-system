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
    @import url(https://fonts.googleapis.com/css?family=Open+Sans);
    .size-filter{
        width: 25% !important;
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

@section('title', __('messages.create_customer'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('client') }}">Client</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List Transaction</li>
                </ol>
            </nav>
            <h1 class="m-0">List Transactions</h1>
        </div>
    </div>
@endsection
@section('content')
@include('application.estimates._filters')

<div class="card">
    <div class="card-header card-header-large bg-white">
        <h4 class="card-header__title">In Transit (OTW) Transactions</h4>
    </div>
    <div class="card-body">
        
        <div class="table-responsive">
            <table class="table table-xl mb-0 thead-border-top-0 table-striped">
                <thead>
                    <tr>
                        <th class="text-center w-30px">{{ __('messages.#id') }}</th>
                        <th>Status/Details</th>
                        <th>Plate No.</th>
                        <th>Qty (Tonne)</th>
                        <th>Invoice Number</th>
                        <th>DO Number</th>
                        <th ><bold>Arrival Status</bold></th>
                    </tr>
                </thead>
                <tbody class="list" id="expenses">
                    @foreach($otws as $k => $otw)
                        <tr>
                            <td class="p text-center w-30px">
                                <a>
                                    {{$k+1}}
                                </a>
                            </td>
                            <td class="p">
                            <a href="{{ route('customers.tracking',  $otw->id) }}">
                               Tracking info
                            </a>
                            </td>
                            <td class="p">
                            {{$otw->platenumbers->number_plate}}
                            </td>
                            <td class="p">
                            <?php
                            $sum=0;
                            foreach($otw->items as $data)
                            {
                                $sum+= $data->quantity;
                            }
                            echo $sum;
                            ?>
                            </td>
                            <td class="p">
                            {{$otw->invoice_number}}
                            </td>
                            <td class="p">
                            {{$otw->do_number}}
                            </td>
                            <td class="p">
                                <div class="badge badge-info fs-0-9rem">
                                    {{$otw->status}}
                                </div>
                            </td>
                                
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row card-body pagination-light justify-content-center text-center">
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header card-header-large bg-white">
        <h4 class="card-header__title">Completed Transactions</h4>
    </div>
    <div class="card-body">
        
        <div class="table-responsive">
            <table class="table table-xl mb-0 thead-border-top-0 table-striped">
                <thead>
                    <tr>
                        <th class="text-center w-30px">{{ __('messages.#id') }}</th>
                        <th>Status/Details</th>
                        <th>Plate No.</th>
                        
                        <th>Invoice Number</th>
                        <th>DO Number</th>
                        <th>Receipt Number</th>
                        <th>Qty Start (Tan)</th>
                        <th>Qty Arrive (Tan)</th>
                        <th>Qty Shortage (Tan)</th>
                        <th ><bold>Arrival Status</bold></th>
                    </tr>
                </thead>
                <tbody class="list" id="expenses">
                     @foreach($completed as $k => $completed)
                        <tr>
                            <td class="p text-center w-30px">
                                <a>
                                {{$k+1}}
                                </a>
                            </td>
                            <td class="p">
                            <a href="{{ route('customers.tracking',  $completed->id) }}">
                               Tracking info
                            </a>
                            </td>
                            <td class="p">
                            {{$completed->platenumbers->number_plate}}
                            </td>
                            
                            <td class="p">
                            {{$completed->invoice_number}}
                            </td>
                            <td class="p">
                                @if($completed->status == "OTW")
                                <a href="{{ route('invoices.detailsdocontract', $completed->id) }}">
                                {{$completed->do_number}}
                                </a>
                                @else
                                <a href="{{ route('invoices.detailsdoarrived', $completed->id) }}">
                                {{$completed->do_number}}
                                </a>
                                @endif
                            </td>
                            @if(empty($completed->receipt_number))
                            <td class="p">
                            -
                            </td>
                            @else
                            <td class="p">
                            {{$completed->receipt_number}}
                            </td>
                            @endif
                            <td class="p" style="font-weight: 600;">
                            <?php
                            $sum=0;
                            foreach($completed->items as $data)
                            {
                                $sum+= $data->quantity;
                            }
                            echo $sum;
                            ?>
                            </td>
                            @if(empty($completed->accurate_remark))
                            <td class="p" style="font-weight: 600;">
                                <?php
                                $sum=0;
                                foreach($completed->items as $data)
                                {
                                    $sum+= $data->quantity;
                                }
                                echo $sum;
                                ?>
                            </td>
                            @else
                            <td class="p" style="font-weight: 600; color: red;">
                                {{$completed->accurate_remark}}
                            </td>
                            @endif
                            @if(empty($completed->client_id))
                                <td class="p">
                                    0
                                </td>
                            @elseif($completed->accurate == "Accurate Quantity")
                                <td class="p">
                                    0
                                </td>
                            @else
                                <td class="p">
                                    {{ ($sum - $completed->accurate_remark)  }}
                                </td>
                            @endif
                            @if($completed->accurate == "Accurate Quantity")
                            <td class="p">
                                <div class="badge badge-success fs-0-9rem">
                                    {{$completed->accurate}}
                                </div>
                            </td>   
                            @else
                            <td class="p">
                                <div class="badge badge-danger fs-0-9rem">
                                    {{$completed->accurate}}
                                </div>
                            </td> 
                            @endif
                        </tr>
                     @endforeach
                </tbody>
            </table>
        </div>
        <div class="row card-body pagination-light justify-content-center text-center">
        </div>
    </div>
</div>
@endsection

 

