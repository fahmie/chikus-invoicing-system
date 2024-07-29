<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Non-Contract Product Information</strong></p>
            <p class="text-muted">{{ __('messages.basic_product_information') }}</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">

            <div class="row">
                <div class="col"> 
                    <div class="form-group required">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': ''}}" name="name" value="{{  isset($product) ? $product->name : '' }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="site">{{ __('Sites') }}</label>
                        <select name="sites_id"  class="form-control" required>
                        @foreach ($sites as $site)
                         <option value="{{ $site->id}}" @if(isset($product) && $product->sites_id == $site->id) selected @endif>{{$site->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="unit">{{ __('messages.unit') }}</label>
                        <select name="unit_id" data-toggle="select" required>
                        <option value="" selected disabled>-- Please Unit Type --</option>
                            @foreach ($unit as $unit)
                            <option value="{{ $unit->id}}" @if(isset($product) && $product->unit_id == $unit->id) selected @endif>{{$unit->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group required">
                        <label for="price">Price (RM)</label>
                        <input name="price" type="text" class="form-control price_input {{ $errors->has('price')? 'is-invalid': ''}}" placeholder="" autocomplete="off" value="{{ isset($product) ? $product->price : "" }}" required>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="taxes">{{ __('messages.taxes') }}</label> 
                        <select id="taxes" name="taxes[]" data-toggle="select" multiple="multiple" class="form-control select2-hidden-accessible" data-select2-id="taxes">
                            @foreach(get_tax_types_select2_array($currentCompany->id) as $option)
                                <option value="{{ $option['id'] }}" {{ $product->hasTax($option['id']) ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div> --}}
 
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="description">{{ __('messages.description') }}</label>
                        <textarea class="form-control {{ $errors->has('description')? 'is-invalid': ''}}" name="description" cols="30" rows="3">{{  isset($product) ? $product->description : '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-group text-center mt-3">
                <button type="button" class="btn btn-primary form_with_price_input_submit">{{ __('messages.save_product') }}</button>
            </div>
        </div>
    </div>
</div>
@section('page_body_scripts')
<script>
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