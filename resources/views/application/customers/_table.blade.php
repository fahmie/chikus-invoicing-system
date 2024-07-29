<div class="card-header bg-white p-0">
    <div class="row no-gutters flex nav">
        <a href="{{ route('customers', 'unpaid') }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'unpaid' ? 'active' : '' }}">
            <span class="card-header__title m-0">
                Unpaid
            </span> 
        </a>
        <a href="{{ route('customers', 'paid') }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'paid' ? 'active' : '' }}">
            <span class="card-header__title m-0">
                Paid
            </span>
        </a>
    </div>
</div>
@if($invoices->count() > 0)    
    <div class="table-responsive">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th class="text-center" style="padding:0.35rem 5px 0.35rem 1rem;">ID</th>
                    <th style="padding:0.35rem 5px;">Site</th>
                    <th style="padding:0.35rem 5px;">Driver</th>
                    <th style="padding:0.35rem 5px;">Plate No.</th>
                    <th class="w-10" style="padding:0.35rem 5px;">Transporter</th>
                    <th style="padding:0.35rem 5px;">Invoice Number</th>
                    <th style="padding:0.35rem 5px;">DO Number</th>
                    <th style="width: 10%;padding:0.35rem 5px;">Receipt Number</th>
                    <th style="padding:0.35rem 5px;">Unit Price (RM)</th>
                    <th style="padding:0.35rem 5px;">Qty Start (Tan)</th>
                    <th style="padding:0.35rem 5px;">Qty Arrived (Tan)</th>
                    <th style="padding:0.35rem 5px;">Qty Shortage (Tan)</th>
                    <th style="padding:0.35rem 5px;">Status Paid</th>
                    <th style="padding:0.35rem 1rem 0.35rem 5px;"><bold>Delivery Condition</bold></th>
                    <!-- <th style="padding:0.35rem 1rem 0.35rem 10px;">Total Amount (RM)</th> -->
                </tr>
            </thead>
            <tbody class="list" id="expenses">
                 @foreach ($invoices as $k => $invoice)
                 <tr>
                    <td class="p text-center" style="padding:0.35rem 5px 0.35rem 1rem; font-size: 14px">
                        <a href="{{ route('customers.tracking',  $invoice->id) }}">
                        {{$k+1}}
                        </a>
                    </td>
                    <td class="p text-center" style="padding:0.35rem 5px 0.35rem 1rem; font-size: 14px">
                        {{$invoice->sites->name}}
                    </td>
                    <td class="text-muted mb-0" style="padding:0.35rem 5px;max-width: 100px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                        {{$invoice->drivers->name}}
                    </td>
                    <td class="p" style="font-size: 14px; padding:0.35rem 5px;">
                        <div class="badge badge-dark fs-0-9rem">
                            {{$invoice->platenumbers->number_plate}}
                        </div>
                    </td>
                    @if (!empty($invoice->transporters->company_name))
                    <td class="text-muted mb-0" style="padding:0.35rem 5px;max-width: 100px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                        <i class="material-icons icon-16pt mr-1 text-primary">business</i>
                        {{$invoice->transporters->company_name}}
                    <div class="d-flex align-items-center">
                        <small class="text-muted">
                            <i class="material-icons icon-16pt mr-1">pin_drop</i>
                            Dropoff:{{ $invoice->transporterlocation->name}}
                        </small>
                    </div>
                    </td>
                    @else
                    <td> - </td>  
                    @endif
                    <td class="p" style="font-size: 14px; padding:0.35rem 5px;">
                        <a href="{{ route('invoices.details', $invoice->id) }}">
                            {{ $invoice->invoice_number }}
                        </a>
                    </td>
                    <td class="p" style="font-size: 14px; padding:0.35rem 5px;">
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
                    @if(empty($invoice->receipt_number))
                    <td class="p" style="font-size: 14px; padding:0.35rem 5px;">
                    -
                    </td>
                    @else
                    <td class="p" style="font-size: 14px; padding:0.35rem 5px;">
                        @foreach($receipts as $key => $data)
                        @if($data->invoice_id == $invoice->id)
                        <a href="{{ route('receipts.details', [ 'id' =>$invoice->id,'refrence' => $data->reference_number]) }}">
                            {{ $data->receipt_number }}
                        </a>
                        @endif
                        @endforeach
                    </td>
                    @endif
                    <td class="p" style="font-weight: 600; font-size: 14px; padding:0.35rem 5px;">
                        <?php
                        foreach($invoice->items as $data)
                        {
                                $data->price;
                        }
                        
                        ?>
                        {{$data->price/100}}
                    </td> 
                    <td class="p" style="font-weight: 600; font-size: 14px; padding:0.35rem 5px;">
                    <?php
                    $sum=0;
                    foreach($invoice->items as $data)
                    {
                        $sum+= $data->quantity;
                    }
                    echo $sum;
                    ?>
                    </td>
                    @if(empty($invoice->client_id))
                        <td class="p"  style="font-weight: 600; font-size: 14px; padding:0.35rem 5px;">
                            <?php
                            $sum=0;
                            foreach($invoice->items as $data)
                            {
                                $sum+= $data->quantity;
                            }
                            echo $sum;
                            ?>
                        </td>
                    @elseif(empty($invoice->accurate))
                    <td class="p"  style="font-weight: 600; font-size: 14px; padding:0.35rem 5px;">
                            <?php
                            $sum=0;
                            foreach($invoice->items as $data)
                            {
                                $sum+= $data->quantity;
                            }
                            echo $sum;
                            ?>
                        </td>
                    @elseif($invoice->accurate == "Accurate Quantity")
                    <td class="p"  style="font-weight: 600; font-size: 14px; padding:0.35rem 5px;">
                        <?php
                        $sum=0;
                        foreach($invoice->items as $data)
                        {
                            $sum+= $data->quantity;
                        }
                        echo $sum;
                        ?>
                    </td>
                    @else
                    <td class="p" style="color: red;font-weight: 600; font-size: 14px; padding:0.35rem 5px;">
                        {{ $invoice->accurate_remark }}
                    </td> 
                    @endif
                    @if(empty($invoice->client_id))
                        <td class="p" style="font-weight: 600;font-size: 14px; padding:0.35rem 5px;">
                            0
                        </td>
                    @elseif(empty($invoice->accurate))
                        <td class="p" style="font-weight: 600;font-size: 14px; padding:0.35rem 5px;">
                            0
                        </td>
                    @elseif($invoice->accurate == "Accurate Quantity")
                        <td class="p" style="font-weight: 600;font-size: 14px; padding:0.35rem 5px;">
                            0
                        </td>
                    @else
                        <td class="p" style="font-weight: 600;font-size: 14px; padding:0.35rem 5px;">
                            {{ (round(($sum - $invoice->accurate_remark), 3)) }}
                        </td>
                    @endif
                    @if($invoice->paid_status == "PAID")
                    <td style="font-size: 14px; padding:0.35rem 5px;">
                        <div class="badge badge-success fs-0-9rem">
                            {{ $invoice->paid_status }}
                        </div>
                    </td> 
                    @elseif($invoice->paid_status == "UNPAID")
                    <td style="font-size: 14px; padding:0.35rem 5px;">
                        <div class="badge badge-danger fs-0-9rem">
                            {{ $invoice->paid_status }}
                        </div>
                    </td>  
                    @else
                    <td style="font-size: 14px; padding:0.35rem 5px;">
                        <div class="badge badge-info fs-0-9rem">
                            {{ $invoice->paid_status }}
                        </div>
                    </td> 
                    @endif
                    
                    @if(empty($invoice->accurate))
                    <td class="p" style="font-size: 14px;padding:0.35rem 1rem 0.35rem 5px;">
                        <div class="badge badge-success fs-0-9rem">
                            Accurate Quantity
                        </div>
                    </td>
                    @elseif($invoice->accurate == "Accurate Quantity")
                    <td class="p" style="font-size: 14px;padding:0.35rem 1rem 0.35rem 5px;">
                        <div class="badge badge-success fs-0-9rem">
                            {{$invoice->accurate}}
                        </div>
                    </td>   
                    @else
                    <td class="p" style="font-size: 14px; padding:0.35rem 1rem 0.35rem 5px;">
                        <div class="badge badge-danger fs-0-9rem">
                            {{$invoice->accurate}}
                        </div>
                    </td> 
                    @endif
                    <!-- @if(empty($invoice->accurate))
                    <td class="p" style="font-weight: 600;font-size: 14px; padding:0.35rem 1rem 0.35rem 10px;">
                        <?php
                            $sum=0;
                            foreach($invoice->items as $data)
                            {
                                $sum=($data->price * $data->quantity)/100;
                            }
                        
                            echo $sum;
                        ?>
                    </td>
                    @else
                    <td class="p" style="font-weight: 600;font-size: 14px; padding:0.35rem 1rem 0.35rem 10px;">
                        <?php
                            $sum=0;
                            foreach($invoice->items as $data)
                            {
                                $sum=($data->price * $invoice->accurate_remark)/100;
                            }
                        
                            echo $sum;
                        ?>
                    </td>
                    @endif -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
      {{ $invoices->links() }}
    </div>
    @else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">description</i>
    </div>
    <div class="row justify-content-center card-body pt-2 pb-5">
        <p class="h4">No data yet</p>
    </div>
@endif
