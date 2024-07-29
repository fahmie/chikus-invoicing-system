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
</style>
@if($invoices->count() > 0)    
    <div class="table-responsive">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th>Site</th>
                    <th>Details</th>
                    <th>Driver</th>
                    <th>Plate No.</th>
                    <th>Transporter</th>
                    <th>Quantity (Tan)</th>
                    <th>Invoice Number</th>
                    <th>DO Number</th>
                    <th ><bold>Arrival Status <span class="blink"> (please choose) </span></bold></th>
                </tr>
            </thead>
            <tbody class="list" id="expenses">
                @foreach ($invoices as $key => $invoice)
                    <tr>
                        <td class="text-muted mb-0 text-center" style="font-size: 14px">
                            <a>
                                {{$key+1}}
                            </a>
                        </td>
                        <td class="text-muted mb-0 text-center" style="font-size: 14px">
                            {{$invoice->sites->name}}
                        </td>
                        <td class="p" style="font-size: 14px">
                            <a href="{{ route('customers.tracking',  $invoice->id) }}">
                               Tracking
                            </a>
                        </td>
                        <td class="text-muted mb-0" style="max-width: 100px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                            {{$invoice->drivers->name}}
                        </td>
                        <td class="p" style="font-size: 14px">
                            <div class="badge badge-dark fs-0-9rem">
                                {{$invoice->platenumbers->number_plate}}
                            </div>
                        </td>
                        <td class="text-muted mb-0" style="max-width: 200px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                                    <i class="material-icons icon-16pt mr-1 text-primary">business</i>
                                    {{$invoice->transporters->company_name}}
                            <div class="d-flex align-items-center">
                                <small class="text-muted">
                                    <i class="material-icons icon-16pt mr-1">pin_drop</i>
                                    Dropoff Location:{{ $invoice->transporterlocation->name}}
                                </small>
                            </div>
                        </td>
                        <td class="p" style="font-size: 14px">
                        <?php
                         $sum=0;
                         foreach($invoice->items as $data)
                         {
                            $sum+= $data->quantity;
                         }
                         echo $sum;
                         ?>
                        </td>
                        <td class="p" style="font-size: 14px">
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
                        
                        <td class="p" style="font-size: 14px">
                        
                        <div class="row">
                            <div class="col-lg-12 my-3">
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button class="btn btn-success titletip" id="accurate" style="margin-right: 5px;"  data-toggle="modal" data-target="#exampleModal" data-id="{{ $invoice->id }}">
                                            Accurate Qty<span class="textTop">Accurate</span>
                                        </button>
                                        <button class="btn btn-danger titletip" id="notaccurate" data-toggle="modal" data-target="#exampleModal2" data-id="{{ $invoice->id }}">
                                        Inaccurate Qty<span class="textTop">Inaccurate</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
    </div>
    @else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">description</i>
    </div>
    <div class="row justify-content-center card-body pt-2 pb-5">
        <p class="h4">No Lorry In Transit</p>
    </div>
@endif

    
    

