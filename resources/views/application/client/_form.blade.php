<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    @media screen and (max-width: 736px) {
        .custom{
            flex-basis: none !important;
        } 
        .td-custom{
            padding: 0 !important;
        }
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
            <p><strong class="headings-color">Client details</strong></p>
            <p class="text-muted">Basic client/contract information</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group required">
                        <label for="display_name">Company Name</label>
                        <input  type="text" class="form-control {{ $errors->has('company_name')? 'is-invalid': ''}}" name="company_name" value="{{  isset($client) ? $client->company_name : '' }}" placeholder="e.g. Modkha Marine Sdn. Bhd." required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group required">
                        <label for="contact_name">Company No.</label>
                        <input type="text"  class="form-control {{ $errors->has('company_no')? 'is-invalid': ''}}" name="company_no" value="{{  isset($client) ? $client->company_no : '' }}" placeholder="e.g. 12345678A" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group required">
                        <label for="phone">Project Manager Name</label>
                        <input type="text"  class="form-control {{ $errors->has('project_manager_name')? 'is-invalid': ''}}" name="project_manager_name" value="{{  isset($client) ? $client->project_manager_name : '' }}" placeholder="e.g. Ali bin Abu">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group required">
                        <label for="website">Phone Number</label>
                        <input type="number"  class="form-control {{ $errors->has('phone')? 'is-invalid': ''}}" pattern="[0-9]+" name="phone" value="{{  isset($client) ? $client->phone : '' }}" placeholder="e.g. 0123456789">
                    </div>
                </div>
            </div>

            <div class="row">
                
                <div class="col-sm-12">
                    <div class="form-group required">
                        <label for="website">Delivery Location</label>
                        <textarea type="text"  class="form-control {{ $errors->has('delivery_location')? 'is-invalid': ''}}" name="delivery_location" placeholder="e.g. Trong Perak" required>{{  isset($client) ? $client->delivery_location : '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group required">
                        <label for="email">Company Address</label>
                        <textarea type="text"  class="form-control {{ $errors->has('address')? 'is-invalid': ''}}" name="address" placeholder="e.g. 18, Star Central, 63000 Cyberjaya" required>{{  isset($client) ? $client->address : '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group required">
                        <label for="site">{{ __('Sites') }}</label>
                        <select name="sites_id"  class="form-control" required>
                        @foreach ($sites as $site)
                         <option value="{{ $site->id}}" @if(isset($client) && $client->sites_id == $site->id) selected @endif>{{$site->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Transporter ownership</strong></p>
            <p class="text-muted">Transport responsibility confirmation</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group required">
                        <label for="transporter" style="margin-bottom: 0;">Who will transport the goods?</label>
                    </div>
                </div>
                <div class="col-sm-8">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="transport" value="1" class="custom-control-input" @if(isset($client) && $client->transport == "1") checked @endif>
                    <label class="custom-control-label" for="customRadioInline1">Client's Own Transport</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="transport" value="2" class="custom-control-input" @if(isset($client) && $client->transport == "2") checked @endif>
                    <label class="custom-control-label" for="customRadioInline2">3rd Party Transportation Service</label>
                </div>
                </div>
            </div>   

        </div>

    </div>
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Product details</strong></p>
            <p class="text-muted">Product client/contract information</p>
        </div>
        <div class="col-lg-8 card-form__body card-body" id="parentdivslot">
        
            <div class="table-repsonsive">
                <span id="error"></span>
                <table class="table table-borderless"  id="item_table">
                    <tr>
                    <th style="padding-left: 0 !important; font-size: 0.8rem; text-transform: uppercase; color: rgba(55, 77, 103, 0.54);">Product Name<span class="required" style="color:#dc3545"> *</span></th>
                    <th style="font-size: 0.8rem; text-transform: uppercase; color: rgba(55, 77, 103, 0.54);">Unit<span class="required" style="color:#dc3545"> *</span></th>
                    <th style="padding-right: 0 !important; font-size: 0.8rem; text-transform: uppercase; color: rgba(55, 77, 103, 0.54);">Price Per Tan (RM)<span class="required" style="color:#dc3545"> *</span></th>
                    <th style="padding-right: 0 !important;"><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></th>
                    </tr>
                    <tr>
                    @if(!empty($products))
                    @foreach ($products as $data)
                    <td style="padding-left: 0 !important;"><input type="hidden" name="id[]" class="form-control id" value="{{  isset($products) ? $data->id : '' }}" /><input type="text" name="product[]" class="form-control product" value="{{$data->name}}" required /></td>
                    <td><select name="unit[]" class="form-control unit" required><option value="{{ $data->unit_id}}" @if(isset($products) && $data->unit_id == $data->unit_id) selected @endif>{{$data->unit->name}}</option></select></td>
                    <td><input type="number" class="form-control price" name="price[]" pattern="[0-9]+([\.][0-9]+)?" step="0.01" title="The number input must start with a number and use either comma or a dot as a decimal character." value="{{  isset($products) ? $data->price/100 : '' }}" required/></td>
                    <td style="padding-right: 0 !important;"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button></td>
                    </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
        
    </div> 
    
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Client account</strong></p>
            <p class="text-muted">Add client/contract account</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group required">
                        <label for="username">{{ __('messages.username') }}</label>
                        <input name="username" type="text" class="form-control" placeholder="{{ __('messages.username') }}" value="{{  isset($user) ? $user->username : '' }}" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group required">
                        <label for="website">Email</label>
                        <input type="email"  class="form-control {{ $errors->has('email')? 'is-invalid': ''}}" name="email" value="{{  isset($client) ? $client->email : '' }}" placeholder="e.g. ali@modkha.com">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group required">
                        <label for="password">{{ __('messages.password') }}</label>
                        <input name="password" type="password" class="form-control" placeholder="{{ __('messages.password') }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group required">
                        <label for="password_confirmation">{{ __('messages.confirm_password') }}</label>
                        <input name="password_confirmation" type="password" class="form-control" placeholder="{{ __('messages.confirm_password') }}">
                    </div>
                </div>
            </div>

            <div class="form-group text-center mt-5">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div> 
</div>
@php
  function fill_unit_select_box($unit)
{ 
 $output = '';
 foreach($unit as $unit)
 {
    $output .=  '<option value="'.$unit->id.'">'.$unit->name.'</option>';

  //@if(isset($product) && $product->client_id == $client->id) selected @endif

 }
 return $output;
}  
@endphp
<script>
//////////////////////table product/////////////////////////////////////////////////

    $(document).ready(function(){
    
    $(document).on('click', '.add', function(){
    var html = '';
    html += '<tr>';
    html += '<td style="padding-left: 0 !important;"><input type="text" name="product[]" class="form-control product" required /></td>';
    html += '<td class="td-custom"><select name="unit[]" class="form-control unit" required ><option value="">Select Unit</option><?php echo fill_unit_select_box($unit); ?></select></td>';
    html += '<td><input type="number" class="form-control price" name="price[]" pattern="[0-9]+([\.][0-9]+)?" step="0.01" title="The number input must start with a number and use either comma or a dot as a decimal character." required /></td>';
    html += '<td style="padding-right: 0 !important;"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button></td></tr>';
    $('#item_table').append(html);
    });
    
    $(document).on('click', '.remove', function(){
    $(this).closest('tr').remove();
    });
    
    $('#insert_form').on('submit', function(event){
    event.preventDefault();
    var error = '';
    $('.product').each(function(){
    var count = 1;
    if($(this).val() == '')
    {
        error += "<p>Enter Item Name at "+count+" Row</p>";
        return false;
    }
    count = count + 1;
    });
    
    $('.price').each(function(){
    var count = 1;
    if($(this).val() == '')
    {
        error += "<p>Enter Item Quantity at "+count+" Row</p>";
        return false;
    }
    count = count + 1;
    });
    
    $('.unit').each(function(){
    var count = 1;
    if($(this).val() == '')
    {
        error += "<p>Select Unit at "+count+" Row</p>";
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











/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function Clone(clonebutton) {
        var row = $(clonebutton).parent(),
            inputVal = row.find('input').val(),
            selectVal = row.find('select').val(),
            original = $('#divRow0'),
            clone = $(original).clone(true, true);
        clone.find('#divRow0').prop('id', 'divRow' + $('.clonerow').length);
        clone.find('#innerDivRow0').prop('id', 'innerDivRow' + $('.clonerow').length);
        clone.find('#timeslotdiv').append('<a class="float-right"  style="margin-bottom: 10px; cursor: pointer;" onclick="deletetimeslot()"><i class="material-icons icon-16pt">clear</i></a>');
        clone.appendTo("#parentdivslot")
        .find("#btn-addslot").remove();
        clone.find('.slot-val').text(clone);
        clone.find('input[type="text"]').val(inputVal);
        clone.find('select').val(selectVal);
        $('#container').append(clone);
    }
    function deletetimeslot() {
        var id, divs = document.getElementsByClassName('p-1');
        id = divs[1].id //  .id is a method 
        alert(id);
        $("#" + id).remove();
    }

    function deletetimeslot2() {
        var id, divs = document.getElementsByClassName('p-3');
        id = divs[1].id //  .id is a method 
        // alert(id);
        $("#" + id).remove();
    }

</script>