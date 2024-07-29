
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
            <p><strong class="headings-color">Driver Details</strong></p>
            <p class="text-muted">Basic Lorry Driver Information</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group required">
                        <label for="display_name">Name (as per IC)</label>
                        <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': ''}}" name="name" value="{{  isset($drivers) ? $drivers->name : '' }}" placeholder="e.g. Abu bin Bakar" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group required">
                        <label for="contact_name">IC Number</label>
                        <input type="text" class="form-control {{ $errors->has('ic')? 'is-invalid': ''}}" name="ic" value="{{  isset($drivers) ? $drivers->ic : '' }}" placeholder="e.g. 900101016595" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group required">
                        <label for="phone">{{ __('messages.phone') }}</label>
                        <input type="number" class="form-control {{ $errors->has('phone')? 'is-invalid': ''}}" name="phone" value="{{  isset($drivers) ? $drivers->phone : '' }}" pattern="[0-9]+" placeholder="e.g. 0123456789" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group required">
                        <label for="site">{{ __('Sites') }}</label>
                        <select name="sites_id"  class="form-control" required>
                        @foreach ($sites as $site)
                         <option value="{{ $site->id}}" @if(isset($drivers) && $drivers->sites_id == $site->id) selected @endif>{{$site->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="website">Remark</label>
                        <textarea type="text" class="form-control {{ $errors->has('remark')? 'is-invalid': ''}}" name="remark">{{  isset($drivers) ? $drivers->remark : '' }}</textarea>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Lorry Details</strong></p>
            <p class="text-muted">Basic Lorry Information</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="table-repsonsive">
                <span id="error"></span>
                <table class="table table-borderless" id="item_table">
                    <tr>
                    <th style="padding-left: 0 !important; font-size: 0.8rem; text-transform: uppercase; color: rgba(55, 77, 103, 0.54);">Lorry Plate Number<span class="required" style="color:#dc3545"> *</span></th>
                    <th style="font-size: 0.8rem; text-transform: uppercase; color: rgba(55, 77, 103, 0.54);">Lorry Type<span class="required" style="color:#dc3545"> *</span></th>
                    <th style="font-size: 0.8rem; text-transform: uppercase; color: rgba(55, 77, 103, 0.54);">Lorry Initial Weight (Tan) <span style="font-style: italic; font-size: 11px; text-transform: none;">(without content)</span><span class="required" style="color:#dc3545"> *</span></th>
                    <th style="padding-right: 0 !important;"><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></th>
                    </tr>
                    <tr>
                    @if(!empty($drivers->platenumbers))
                    @foreach ($drivers->platenumbers as $data)
                    <td style="padding-left: 0 !important;"><input type="hidden" name="id[]" class="form-control plate_number" value="{{  isset($drivers) ? $data->id : '' }}" /><input type="text" name="plate_number[]" class="form-control plate_number" value="{{  isset($drivers) ? $data->number_plate : '' }}" /></td>
                    <td><select name="lorry_type[]" class="form-control lorry_type"><option value="{{$data->lorry_type_id}}">{!! \App\Models\lorry::findOrFail($data->lorry_type_id)->name; !!}</option><?php echo fill_unit_select_box($lorrys); ?></select></td>
                    <td><input type="number" name="weight[]" class="form-control weight" pattern="[0-9]+([\.][0-9]+)?" step="any"  value="{{  isset($drivers) ? $data->weight : '' }}" title="The number input must start with a number and use either comma or a dot as a decimal character." required /></td>
                    <td style="padding-right: 0 !important;"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button></td>
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
@php
  function fill_unit_select_box($lorrys)
{ 
 $output = '';
 foreach($lorrys as $lorrys)
 {
    $output .=  '<option value="'.$lorrys->id.'">'.$lorrys->name.'</option>';

  //@if(isset($product) && $product->client_id == $client->id) selected @endif

 }
 return $output;
}  
@endphp

    @section('page_body_scripts')

<script>
/////////////////////add new lorry/////////////////////

    $(document).ready(function(){
    
    $(document).on('click', '.add', function(){
    var html = '';
    html += '<tr>';
    html += '<td style="padding-left: 0 !important;"><input type="text" name="plate_number[]" class="form-control plate_number" required/></td>';
    html += '<td  class="td-custom"><select name="lorry_type[]" class="form-control lorry_type" required><option value="">Select Lorry Type</option><?php echo fill_unit_select_box($lorrys); ?></select></td>';
    html += '<td><input type="number" name="weight[]" class="form-control weight" pattern="[0-9]+([\.][0-9]+)?" step="any" title="The number input must start with a number and use either comma or a dot as a decimal character." required /></td>';
    html += '<td style="padding-right: 0 !important;"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button></td></tr>';
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
    
    $('.item_unit').each(function(){
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

//////////////////////////////////////////////////////////////////////////////////////////////////

  $("#is_contract").click(function() {
    // var checkedValue = $('#customCheckbox2').val();
    var x = document.getElementById('main_item');
    if (x.style.display == "none") {
      x.style.display = "";
      $('#is_contract').val("on");
    } else {
      x.style.display = "none";
      $('#is_contract').val("NULL");
    //  $('#client_id').html('<option value="">').append(options);
      $('#client_id').val('');
    }
});
var checkedValue = $('#is_contract').val();
//alert(checkedValue);
var x = document.getElementById('main_item');
if (checkedValue == "on") {
  x.style.display = "";
} else {
  x.style.display = "none";
  $('#is_contract').val("NULL");
 // $('#client_id').html('<option value="">').append(options);
  $('#client_id').val('');
  // var x = document.getElementById("main_item");
  //     x.remove(x.selectedIndex);
}
</script>
@endsection