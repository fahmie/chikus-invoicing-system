@extends('layouts.app', ['page' => 'invoices'])

@section('title', __('messages.create_invoice'))
 
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('invoices') }}">{{ __('messages.invoices') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Invoice Cash</li>
                </ol>
            </nav>
            <h1 class="m-0">Create Invoice Cash</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('invoices.store2') }}" method="POST">
        @include('layouts._form_errors')
        @csrf
        
        @include('application.invoices._formcash')
    </form>
@endsection
<!-- Modal driver have job not complete -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="max-width:450px;" role="document">
        <div class="modal-content">
        <div class="modal-header" style="background-color: #F8D7DA;">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="modal-title" style="color: #78232C; text-align:center;" id="exampleModalLabel">The driver last delivery was inaccurate</h6>    
                </div>
                <div class="col-md-12" style="margin: auto;">
                    <p style="margin:0 !important; font-size: 12px; font-weight: 600; text-align:center; padding:0 5px; background-color: #F8D7DA; color: #78232C;">Please clarify with the driver to proceed with this trip!</p>
                </div>
            </div>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="boxes" style="margin: auto; width: 75%">
                        <div class="form-group">
                        <input type="hidden" id="driver1" name="driver1" value=""> 
                            <label><strong>Previous Trip's Invoices Number:</strong></label>
                            <input type="text" id="invoices1" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label><strong>Date & Time:</strong></label>
                            <input type="text" id="datetime1" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label><strong>Driver Name:</strong></label>
                            <input type="text" id="driver_name1" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label><strong>Plate Number:</strong></label>
                            <input type="text" id="plate1" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                         <label><strong>Previous Trip's Supposed Qty:</strong></label>
                        <input type="text" id="suppose1" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label><strong>Previous Trip's Arrived Qty:</strong></label>
                            <input type="text" id="arrived1" class="form-control" readonly>
                        </div>
                        <div class="form-group required">
                            <label><strong>Reason for Inaccurate:</strong></label>
                            <textarea class="form-control" id="reason1" placeholder="Please state a reason here" rows="3"></textarea>
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
<!-- Modal driver have job not complete -->
<!-- Modal driver have job not complete -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="max-width:450px;" role="document">
        <div class="modal-content">
        <div class="modal-header" style="background-color: #F8D7DA;">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="modal-title" style="color: #78232C; text-align:center;" id="exampleModalLabel">The driver's previous delivery is still incomplete</h6>    
                </div>
                <div class="col-md-12" style="margin: auto;">
                    <p style="margin:0 !important; font-size: 12px; font-weight: 600; text-align:center; padding:0 5px; background-color: #F8D7DA; color: #78232C;">Please clarify with the driver to proceed with this trip!</p>
                </div>
            </div>
        </div>

        <div class="modal-body">

        <div class="container">

            <div class="row">
                <div class="boxes" style="margin: auto; width: 75%">
                    <div class="form-group">
                     <input type="hidden" id="driver" name="driver" value=""> 
                         <label><strong>Driver's Previous Invoices Number:</strong></label>
                        <input type="text" id="invoices" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                         <label><strong>Date & Time:</strong></label>
                        <input type="text" id="datetime" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                            <label><strong>Driver Name:</strong></label>
                            <input type="text" id="driver_name" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                         <label><strong>Plate Number:</strong></label>
                        <input type="text" id="plate" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                         <label><strong>Driver's Previous Supposed Quantity:</strong></label>
                        <input type="text" id="suppose" class="form-control" readonly>
                    </div>
                    <div class="form-group required">
                        <label><strong>Driver's Reason for Incomplete:</strong></label>
                         <textarea class="form-control" id="reason" placeholder="Please state a reason here" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="modal-footer" style="margin: auto;">
            <button type="button" class="btn btn-danger" id="close2" data-dismiss="modal">Cancel</button>
            <button type="submit" id="submit" class="btn btn-success" data-dismiss="modal">Submit</button>
        </div>
        </div>
    </div>
</div>
<!-- Modal driver have job not complete -->
<!-- Modal driver have job not complete -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="max-width:450px;" role="document">
        <div class="modal-content">
        <div class="modal-header" style="background-color: #F8D7DA;">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="modal-title" style="color: #78232C; text-align:center;" id="exampleModalLabel">The Lorry's previous delivery is still incomplete</h6>    
                </div>
                <div class="col-md-12" style="margin: auto;">
                    <p style="margin:0 !important; font-size: 12px; font-weight: 600; text-align:center; padding:0 5px; background-color: #F8D7DA; color: #78232C;">Please clarify with the driver to proceed with this trip!</p>
                </div>
            </div>
        </div>
        <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="boxes" style="margin: auto; width: 75%">

                    <div class="form-group">
                     <input type="hidden" id="driverid2" name="driverid2" value=""> 
                             <label><strong>Lorry's Previous Invoices Number:</strong></label>
                        <input type="text" id="invoices2" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                             <label><strong>Date & Time:</strong></label>
                        <input type="text" id="datetime2" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                         <label><strong>Driver Name:</strong></label>
                        <input type="text" id="driver2" class="form-control" readonly> 
                    </div>
                    <div class="form-group">
                         <label><strong>Plate Number:</strong></label>
                        <input type="text" id="plate2" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Lorry's Previous Supposed Quantity:</strong></label>
                        <input type="text" id="suppose2" class="form-control" readonly>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
        <div class="modal-footer" style="margin: auto;">
            <button type="button" class="btn btn-danger" id="close3" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
<!-- Modal driver have job not complete -->
<!-- Modal driver have job not complete -->
<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="max-width:450px;" role="document">
        <div class="modal-content">
        <div class="modal-header" style="background-color: #F8D7DA;">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="modal-title" style="color: #78232C; text-align:center;" id="exampleModalLabel">The Lorry last delivery was inaccurate</h6>    
                </div>
                <div class="col-md-12" style="margin: auto;">
                    <p style="margin:0 !important; font-size: 12px; font-weight: 600; text-align:center; padding:0 5px; background-color: #F8D7DA; color: #78232C;">Please clarify with the driver to proceed with this trip!</p>
                </div>
            </div>
        </div>
        <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="boxes" style="margin: auto; width: 75%">

                    <div class="form-group">
                     <input type="hidden" id="driverid3" name="driverid3" value=""> 
                        <label><strong>Previous Trip's Invoices Number:</strong></label>
                        <input type="text" id="invoices3" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Date & Time:</strong></label>
                        <input type="text" id="datetime3" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                         <label><strong>Driver Name:</strong></label>
                        <input type="text" id="driver3" class="form-control" readonly> 
                    </div>
                    <div class="form-group">
                         <label><strong>Plate Number:</strong></label>
                        <input type="text" id="plate3" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Previous Trip's Supposed Qty:</strong></label>
                        <input type="text" id="suppose3" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Previous Trip's Arrived Qty:</strong></label>
                        <input type="text" id="arrived3" class="form-control" readonly>
                    </div>
                    <div class="form-group required">
                        <label><strong>Reason for Inaccurate:</strong></label>
                         <textarea class="form-control" id="reason3" placeholder="Please state a reason here" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="modal-footer" style="margin: auto;">
            <button type="button" class="btn btn-danger" id="close4" data-dismiss="modal">Cancel</button>
            <button type="submit" id="submit3" class="btn btn-success" data-dismiss="modal">Submit</button>
        </div>
        </div>
    </div>
</div>
<!-- Modal driver have job not complete -->
@section('page_body_scripts')
    @include('application.invoices._js')
    <script>
        $(document).ready(function() {
            addProductRow();
        });
    </script>
@endsection