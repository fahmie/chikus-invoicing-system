@if($invoices->count() > 0)
    <div class="table-responsive">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>{{ __('messages.invoice_number') }}</th>
                    @if(Auth::user()->roles =="superadmin")
                    <th>Site</th>
                    @endif
                    <th>Contract Name</th>
                    <th>Plate Number</th>
                    <th>Driver Name</th>
                    <th>Issued</th>
                    <th>Arrived</th>
                    <th>Delivery Condition</th>
                    <th>Qty Start</th>
                    <th>Qty Arrive</th>
                    <th>Qty Shortage</th>
                    <th>Do Number</th>
                    <!-- <th class="w-50px">{{ __('messages.view') }}</th> -->
                </tr>
            </thead>
            <tbody class="list" id="invoices">
                @foreach ($invoices as $k => $invoice)
                    <tr>
                        <td class="text-muted mb-0" style="font-size: 14px">
                            {{ $k+1 }}
                        </td>
                        <td class="p" style="font-size: 14px">
                            <a href="{{ route('invoices.details', $invoice->id) }}">
                            {{ $invoice->invoice_number }}
                            </a>
                        </td>
                        @if(Auth::user()->roles =="superadmin")
                        <td class="text-muted mb-0" style="font-size: 14px">
                            {{ $invoice->sites->name }}
                        </td>
                        @endif
                        <td class="text-muted mb-0" style="max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                            @if(!empty($invoice->client_id))
                               {{$invoice->clients->company_name}}
                            @elseif(empty($invoice->client_id))
                                Individual
                            @endif
                        </td>
                        <td class="p" style="font-size: 14px">
                            <div class="badge badge-dark fs-0-9rem">
                                {{$invoice->platenumbers->number_plate}}
                            </div>
                        </td>
                        <td class="text-muted mb-0" style="max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                            {{$invoice->drivers->name}}
                        </td>
                        <td class="text-muted mb-0" style="font-size: 14px">
                            {{ $invoice->formatted_invoice_date }}
                        </td>
                        
                        <td class="p" style="font-size: 14px">
                        @if ($tab=="all")
                            {{ $invoice->updated_at }}
                        @else
                            <div class="badge badge-info fs-0-9rem">
                                Otw
                            </div>
                        @endif
                        </td>
                        @if ($tab=="all")
                        @if(empty($invoice->client_id))
                            <td class="p" style="font-size: 14px">
                                <div class="badge badge-success fs-0-9rem">
                                    Accurate Quantity
                                </div>
                            </td> 
                        @elseif(empty($invoice->accurate))
                            <td class="p" style="font-size: 14px">
                                <div class="badge badge-success fs-0-9rem">
                                    Accurate Quantity
                                </div>
                            </td> 
                        @elseif($invoice->accurate == "Accurate Quantity")
                            <td class="p" style="font-size: 14px">
                                <div class="badge badge-success fs-0-9rem">
                                    {{ $invoice->accurate }}
                                </div>
                            </td> 
                        @else
                            <td class="p" style="font-size: 14px">
                                <div class="badge badge-danger fs-0-9rem">
                                {{ $invoice->accurate }}
                                </div>
                            </td>  
                        @endif
                        @elseif (!($tab=="all"))
                            <td class="p" style="font-weight: 600;font-size: 14px">
                                -
                            </td>
                        @endif
                        <td class="p" style="font-weight: 600; font-size: 14px">
                        <?php
                         $sum=0;
                        //  dd($invoice);
                         foreach($invoice->items as $data)
                         {
                            $sum+= $data->quantity;
                         }
                         echo $sum;
                         ?>
                        </td>
                        @if ($tab=="all")
                            @if(empty($invoice->client_id))
                                <td class="p"  style="font-weight: 600; font-size: 14px">
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
                            <td class="p"  style="font-weight: 600; font-size: 14px">
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
                            <td class="p"  style="font-weight: 600; font-size: 14px">
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
                            <td class="p" style="color: red;font-weight: 600; font-size: 14px">
                                {{ $invoice->accurate_remark }}
                            </td> 
                        @endif
                        @elseif (!($tab=="all"))
                            <td class="p" style="font-weight: 600; font-size: 14px">
                            -
                            </td>
                        @endif
                        @if ($tab=="all")
                            @if(empty($invoice->client_id))
                                <td class="p" style="font-weight: 600;font-size: 14px">
                                    0
                                </td>
                            @elseif(empty($invoice->accurate))
                                <td class="p" style="font-weight: 600;font-size: 14px">
                                    0
                                </td>
                            @elseif($invoice->accurate == "Accurate Quantity")
                                <td class="p" style="font-weight: 600;font-size: 14px">
                                    0
                                </td>
                            @else
                                <td class="p" style="font-weight: 600;font-size: 14px">
                                    {{ ($sum - $invoice->accurate_remark)  }}
                                </td>
                            @endif
                        @elseif (!($tab=="all"))
                            <td class="p" style="font-weight: 600;font-size: 14px">
                            -
                            </td>
                        @endif
                        @if (!($tab=="all"))
                        <td class="p" style="font-size: 14px">
                            <a href="{{ route('invoices.detailsdocontract', $invoice->id) }}">
                            {{ $invoice->do_number }}
                            </a>
                        </td>
                        @else
                        <td class="p" style="font-size: 14px">
                            <a href="{{ route('invoices.detailsdoarrived', $invoice->id) }}">
                            {{ $invoice->do_number }}
                            </a>
                        </td>
                        @endif
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
    <div class="row justify-content-center card-body pb-5">
        <p class="h4">No data yet</p>
    </div>
@endif