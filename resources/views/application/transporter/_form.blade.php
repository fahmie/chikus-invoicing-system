<style>
    [dir=ltr] .table th, [dir=ltr] .table td {
        padding: 0.35rem 0 !important;
        vertical-align: top;
        border-top: 1px solid #efefef;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

/* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>
<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Transporter Information</strong></p>
            <p class="text-muted">Basic Transporter Information</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col-md-6"> 
                    <div class="form-group required">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{  isset($transporter) ? $transporter->name : '' }}" required>
                    </div>
                </div>
                <div class="col-md-6"> 
                    <div class="form-group required">
                        <label for="name">Company Name</label>
                        <input type="text" class="form-control" name="company_name" value="{{  isset($transporter) ? $transporter->company_name : '' }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6"> 
                    <div class="form-group required">
                        <label for="name">Phone Number</label>
                        <input type="number"  class="form-control" name="phone" value="{{  isset($transporter) ? $transporter->phone : '' }}" pattern="[0-9]+" placeholder="e.g. 0123456789" required>
                    </div>
                </div>
                <div class="col-md-6"> 
                    <div class="form-group required">
                        <label for="name">Email</label>
                        <input type="email"  class="form-control" name="email" value="{{  isset($transporter) ? $transporter->email : '' }}" placeholder="e.g. ali@modkha.com" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group required">
                        <label for="site">{{ __('Sites') }}</label>
                        <select name="sites_id"  class="form-control" required>
                        @foreach ($sites as $site)
                         <option value="{{ $site->id}}" @if(isset($transporter) && $transporter->sites_id == $site->id) selected @endif>{{$site->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group required">
                        <label for="description">Address</label>
                        <textarea class="form-control" name="address" cols="30" rows="3" required>{{  isset($transporter) ? $transporter->address : '' }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Remark</label>
                        <textarea class="form-control" name="remark" cols="30" rows="3">{{  isset($transporter) ? $transporter->remark : '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters"> 
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Location Details</strong></p>
            <p class="text-muted">Basic Location Information</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="table-repsonsive">
                <span id="error"></span>
                <table class="table-borderless" style="padding-right: 0 !important;" id="item_table">
                    <tr>
                    <th style="padding-left: 0; width: 900px; font-size: 0.8rem; text-transform: uppercase; color: rgba(55, 77, 103, 0.54);">Dropoff Location</th>
                    <th style="padding-left: 28px !important; width: 900px; font-size: 0.8rem; text-transform: uppercase; color: rgba(55, 77, 103, 0.54);">Price (RM)</th>
                    <th style="padding-right: 0 !important;"><button  type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></th>
                    </tr>
                    <tr>
                    @if(!empty($location))
                    @foreach ($location as $data)
                    <td><input type="hidden" name="id[]" class="form-control id" value="{{  isset($location) ? $data->id : '' }}" /><input type="text" value="{{  isset($location) ? $data->name : '' }}" name="location_name[]" class="form-control" required /></td>
                    <td style=" padding-bottom: 10px !important; padding-left: 28px !important; padding-right: 10px !important;"><input type="number" value="{{  isset($location) ? $data->price/100 : '' }}" name="price[]" pattern="[0-9]+([\.][0-9]+)?" step="0.01" title="The number input must start with a number and use either comma or a dot as a decimal character." class="form-control" required/></td>
                    <td style="padding-bottom: 10px !important;"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button></td></tr>
                    </tr>
                    @endforeach
                    @endif
            </table>
            </div>

            
            
            <div class="form-group text-center mt-5">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        
    </div>
</div>
@section('page_body_scripts')
<script>
    /////////////////////add new location/////////////////////

    $(document).ready(function(){
    
    $(document).on('click', '.add', function(){
    var html = '';
    html += '<tr>';
    html += '<td style="padding-bottom: 10px !important; padding-right: 5px !important;"><input type="text" name="location_name[]" class="form-control" required /></td>';
    html += '<td style=" padding-bottom: 10px !important; padding-left: 28px !important; padding-right: 10px !important;"><input type="number" name="price[]" pattern="[0-9]+([\.][0-9]+)?" step="0.01" title="The number input must start with a number and use either comma or a dot as a decimal character." class="form-control" required /></td>';
    html += '<td style="padding-bottom: 10px !important;"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button></td></tr>';
    $('#item_table').append(html);
    });
    
    $(document).on('click', '.remove', function(){
    $(this).closest('tr').remove();
    });
    
    $('#insert_form').on('submit', function(event){
    event.preventDefault();
    var error = '';
    $('.item_name').each(function(){
    var count = 1;
    if($(this).val() == '')
    {
        error += "<p>Enter Item Name at "+count+" Row</p>";
        return false;
    }
    count = count + 1;
    });
    
    $('.item_quantity').each(function(){
    var count = 1;
    if($(this).val() == '')
    {
        error += "<p>Enter Item Quantity at "+count+" Row</p>";
        return false;
    }
    count = count + 1;
    });
    

    var form_data = $(this).serialize();
    if(error == '')
    {
    $.ajax({
        url:"insert.php",
        method:"POST",
        data:form_data,
        success:function(data)
        {
        if(data == 'ok')
        {
        $('#item_table').find("tr:gt(0)").remove();
        $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
        }
        }
    });
    }
    else
    {
    $('#error').html('<div class="alert alert-danger">'+error+'</div>');
    }
    });
    
    });
</script>
@endsection