<style>
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
@extends('layouts.app', ['page' => 'client'])

@section('title', __('List Transaction'))
    
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

    <div class="card-header bg-white p-0">
        <div class="row no-gutters flex nav">
            <a href="{{ route('customers.info',['id' => $id, 'tab' => 'due']) }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab  == 'due' ? 'active' : '' }}">
                <span class="card-header__title m-0">
                    In Transit
                </span>
            </a>
            <a href="{{ route('customers.info',['id' => $id, 'tab' => 'unpaid']) }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab  == 'unpaid' ? 'active' : '' }}">
                <span class="card-header__title m-0">
                    Unpaid
                <!-- <span class="badge" style="margin-left: 10px; border-radius: 10px;">1</span> -->
                </span> 
            </a>
            <a href="{{ route('customers.info',['id' => $id, 'tab' => 'paid']) }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab  == 'paid' ? 'active' : '' }}">
                <span class="card-header__title m-0">
                    Paid
                </span>
            </a>
        </div>
    </div>
    
@if($completeds->count() > 0)    
        <div class="table-responsive">
            <table class="table table-xl mb-0 thead-border-top-0 table-striped">
                <thead>
                    <tr>
                        <th class="text-center" style="padding:0.35rem 5px 0.35rem 1rem;">ID</th>
                        @if ($tab=="due")
                        <th style="padding:0.35rem 5px;">Details</th>
                        @endif
                        <th style="padding:0.35rem 5px;">Driver</th>
                        <th style="padding:0.35rem 5px;">Plate No.</th>
                        @if ($tab=="due")
                        <th class="w-10" style="padding:0.35rem 5px;">Transporter</th>
                        @else
                        <th style="padding:0.35rem 5px;">Transporter</th>
                        @endif
                        <th style="padding:0.35rem 5px;">Invoice Number</th>
                        <th style="padding:0.35rem 5px;">DO Number</th>
                        @if ($tab=="unpaid" || $tab=="paid")
                        <th style="width: 10%;padding:0.35rem 5px;">Receipt Number</th>
                        @endif
                        <th style="padding:0.35rem 5px;">Unit Price (RM)</th>
                        <th style="padding:0.35rem 5px;">Qty Start (Tan)</th>
                        @if ($tab!="due")
                        <th style="padding:0.35rem 5px;">Qty Arrived (Tan)</th>
                        <th style="padding:0.35rem 5px;">Qty Shortage (Tan)</th>
                        @endif
                        <th style="padding:0.35rem 5px;">Status Paid</th>
                        <th style="padding:0.35rem 5px;"><bold>Delivery Condition</bold></th>
                        <th style="padding:0.35rem 1rem 0.35rem 5px;">Total Amount (RM)</th>
                    </tr>
                </thead>
                <tbody class="list" id="expenses">
                     @foreach($completeds as $k => $completed)
                        <tr>
                            <td class="p text-center" style="padding:0.35rem 5px 0.35rem 1rem; font-size: 14px">
                                @if ($tab!="due")
                                <a href="{{ route('customers.tracking',  $completed->id) }}">
                                {{$k+1}}
                                </a>
                                @else
                                <a>
                                {{$k+1}}
                                </a>
                                @endif
                            </td>
                            @if ($tab=="due")
                            <td class="p" style="font-size: 14px; padding:0.35rem 5px;">
                            <a href="{{ route('customers.tracking',  $completed->id) }}">
                               Tracking
                            </a>
                            </td>
                            @endif
                            <td class="text-muted mb-0" style="padding:0.35rem 5px;max-width: 80px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                                {{$completed->drivers->name}}
                            </td>
                            <td class="p" style="font-size: 14px; padding:0.35rem 5px;">
                                <div class="badge badge-dark fs-0-9rem">
                                    {{$completed->platenumbers->number_plate}}
                                </div>
                            </td>
                            @if (!empty($completed->transporters->company_name))
                            <td class="text-muted mb-0" style="padding:0.35rem 5px;">
                                <div style="max-width: 100px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                                <i class="material-icons icon-16pt mr-1 mb-1 text-primary">business</i>
                                {{$completed->transporters->company_name}}
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="text-muted">
                                        <i class="material-icons icon-16pt mr-1">pin_drop</i>
                                        Dropoff:{{ $completed->transporterlocation->name}}
                                    </small>
                                </div>
                            </td>
                            @else
                            <td> - </td>
                            @endif
                            <td class="p" style="font-size: 14px; padding:0.35rem 5px;">
                                <a href="{{ route('invoices.details', $completed->id) }}">
                                    {{ $completed->invoice_number }}
                                </a>
                            </td>
                            <td class="p" style="font-size: 14px; padding:0.35rem 5px;">
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
                            @if ($tab=="unpaid" || $tab=="paid")
                            @if(empty($completed->receipt_number))
                            <td>
                                -
                            </td>
                            @else
                            <td class="p" style="font-size: 14px; padding:0.35rem 5px;">
                            @foreach($receipts as $key => $data)
                            @if($data->invoice_id == $completed->id)
                            <a href="{{ route('receipts.details', [ 'id' =>$completed->id,'refrence' => $data->reference_number]) }}">
                                {{ $data->receipt_number }}
                            </a>
                            @endif
                            @endforeach
                            </td>
                            @endif
                            @endif
                            <td class="p" style="font-weight: 600; font-size: 14px; padding:0.35rem 5px;">
                                <?php
                                foreach($completed->items as $data)
                                {
                                        $data->price;
                                }
                                $price_unit = $data->price/100
                                ?>
                                {{$price_unit}}
                            </td> 
                            <td class="p" style="font-weight: 600; font-size: 14px; padding:0.35rem 5px;">
                            <?php
                            $sum=0;
                            foreach($completed->items as $data)
                            {
                                $sum+= $data->quantity;
                            }
                            echo $sum;
                            ?>
                            </td>
                            @if ($tab!="due")
                                @if(empty($completed->client_id))
                                    <td class="p"  style="font-weight: 600; font-size: 14px; padding:0.35rem 5px;">
                                        <?php
                                        $sum=0;
                                        foreach($completed->items as $data)
                                        {
                                            $sum+= $data->quantity;
                                        }
                                        echo $sum;
                                        ?>
                                    </td>
                                @elseif(empty($completed->accurate))
                                <td class="p"  style="font-weight: 600; font-size: 14px; padding:0.35rem 5px;">
                                        <?php
                                        $sum=0;
                                        foreach($completed->items as $data)
                                        {
                                            $sum+= $data->quantity;
                                        }
                                        echo $sum;
                                        ?>
                                    </td>
                                @elseif($completed->accurate == "Accurate Quantity")
                                <td class="p"  style="font-weight: 600; font-size: 14px; padding:0.35rem 5px;">
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
                                <td class="p" style="color: red;font-weight: 600; font-size: 14px; padding:0.35rem 5px;">
                                    {{ $completed->accurate_remark }}
                                </td> 
                                @endif
                            @endif
                            @if ($tab!="due")
                                @if(empty($completed->client_id))
                                    <td class="p" style="font-weight: 600;font-size: 14px; padding:0.35rem 5px;">
                                        0
                                    </td>
                                @elseif(empty($completed->accurate))
                                    <td class="p" style="font-weight: 600;font-size: 14px; padding:0.35rem 5px;">
                                        0
                                    </td>
                                @elseif($completed->accurate == "Accurate Quantity")
                                    <td class="p" style="font-weight: 600;font-size: 14px; padding:0.35rem 5px;">
                                        0
                                    </td>
                                @else
                                    <td class="p" style="font-weight: 600;font-size: 14px; padding:0.35rem 5px;">
                                        {{ (round(($sum - $completed->accurate_remark), 3)) }}
                                    </td>
                                @endif
                            @endif
                            @if($completed->paid_status == "PAID")
                            <td style="font-size: 14px; padding:0.35rem 5px;">
                                <div class="badge badge-success fs-0-9rem">
                                    {{ $completed->paid_status }}
                                </div>
                            </td> 
                            @elseif($completed->paid_status == "UNPAID")
                            <td style="font-size: 14px; padding:0.35rem 5px;">
                                <div class="badge badge-danger fs-0-9rem">
                                    {{ $completed->paid_status }}
                                </div>
                            </td>  
                            @else
                            <td style="font-size: 14px; padding:0.35rem 5px;">
                                <div class="badge badge-info fs-0-9rem">
                                    {{ $completed->paid_status }}
                                </div>
                            </td> 
                            @endif
                            @if ($tab=="due")
                            <td class="p" style="font-size: 14px; padding:0.35rem 5px;">
                                <div class="badge badge-info fs-0-9rem">
                                    {{$completed->status}}
                                </div>
                            </td>
                            @else
                                @if(empty($completed->accurate))
                                <td class="p" style="font-size: 14px; padding:0.35rem 5px;">
                                    <div class="badge badge-success fs-0-9rem">
                                        Accurate Quantity
                                    </div>
                                </td>
                                @elseif($completed->accurate == "Accurate Quantity")
                                <td class="p" style="font-size: 14px; padding:0.35rem 5px;">
                                    <div class="badge badge-success fs-0-9rem">
                                        {{$completed->accurate}}
                                    </div>
                                </td>   
                                @else
                                <td class="p" style="font-size: 14px; padding:0.35rem 5px;">
                                    <div class="badge badge-danger fs-0-9rem">
                                        {{$completed->accurate}}
                                    </div>
                                </td> 
                                @endif
                            @endif
                            <td class="p" style="font-weight: 600;font-size: 14px; padding:0.35rem 1rem 0.35rem 5px;">
                                <?php
                                    $sum=0;
                                    foreach($completed->items as $data)
                                    {
                                        $sum=($data->price * $data->quantity)/100;
                                    }
                                
                                   echo round($sum, 2);
                                   
                                ?>
                            </td>
                            @if (empty($completed->accurate_remark))
                            @foreach($completed->items as $data)
                            @php
                                $total[] = round($data->quantity*$price_unit, 2);
                            @endphp
                            @endforeach
                            @else
                            @php
                                $total[] = round($completed->accurate_remark*$price_unit, 2);
                            @endphp
                            @endif
                        </tr>
                        <?php
                        $sum1 =0;
                       if(!empty($total)){
                        foreach($total as $tot)
                        {
                            $sum1+=$tot;
                        }
                        }
                        ?>
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
                            <td colspan="4" style="padding:0.35rem 1rem 0.35rem 5px;"> 
                                <div class="row mt-2" style="float:right; padding-right: 10px;">
                                    <label style="text-transform: none;">Total Revenue Earning/Page: RM</label>
                                    <span><h6 style="color: green; padding: 0 5px; margin-bottom: 0;">
                                        {{ (round(($sum1), 2)) }}
                                    
                                    </h6></span>
                                </div>
                            </td>
                            @elseif ($tab=="unpaid")
                            <td colspan="4" style="padding:0.35rem 1rem 0.35rem 5px;"> 
                                <div class="row mt-2" style="float:right; padding-right: 10px;">
                                    <label style="text-transform: none;">Total Overdue Balance/Page: RM</label>
                                    <span><h6 style="color: green; padding: 0 5px; margin-bottom: 0;">
                                     {{ (round(($sum1), 2)) }}
                                    </h6></span>
                                </div>
                            </td>
                            @else
                            <td colspan="4"> 

                            </td>
                            @endif
                        </tr>
                </tbody>
            </table>
        </div>
        <div class="row card-body pagination-light justify-content-center text-center">
            {{ $completeds->links() }}
        </div>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">description</i>
    </div>
    <div class="row justify-content-center card-body pt-2 pb-5">
        <p class="h4">No data yet</p>
    </div>
@endif
</div>
@endsection

 

