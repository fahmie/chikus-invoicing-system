<style>
    .size-filter{
        width: 20% !important;
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
<form action="{{route('managements.export')}}" method="GET">
    <div class="card card-form d-flex flex-column flex-sm-row">
        <div class="card-form__body card-body-form-group flex">
            <div class="row">
                <div class="col-sm-auto size-filter" style="width: 15%">
                    <div class="form-group">
                        <label for="filter[date]">Date</label>
                        <input name="filter[date]" type="text" class="form-control input" data-toggle="flatpickr" placeholder="{{ __('messages.search') }}">
                    </div> 
                </div>
                <div class="col-sm-auto size-filter" style="width: 15%">
                    <div class="form-group">
                        <label for="filter[time]">Time</label>
                        <input type="time" name="filter[time]" class="form-control" time=true value="{{ Request::get("filter")==['time'] }}" placeholder="{{ __('messages.search') }}">
                    </div> 
                </div>
                @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                <div class="col-sm-auto size-filter" style="width: 20%">
                    <div class="form-group">
                        <label for="filter[sites_id]">{{ __('Sites') }}</label>
                        <select id="filter[sites_id]" name="filter[sites_id]" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="filter[sites_id]">
                            <option selected value="" disabled>{{ __('Select Site') }}</option>
                            @foreach(get_sites_select2_array($currentCompany->id) as $option)
                                <option value="{{ $option['id'] }}" {{ isset(Request::get("filter")['sites_id']) && Request::get("filter")['sites_id'] == $option['id'] ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                <div class="col-sm-auto size-filter" style="width: 20%">
                    <div class="form-group">
                        <label for="filter[supplier_id]">{{ __('Supplier') }}</label>
                        <select id="filter[supplier_id]" name="filter[supplier_id]" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="filter[supplier_id]">
                            <option selected value="" disabled>{{ __('Select Supplier') }}</option>
                            @foreach(get_supplier_select2_array(Auth::user()->sites_id) as $option)
                                <option value="{{ $option['id'] }}" {{ isset(Request::get("filter")['supplier_id']) && Request::get("filter")['supplier_id'] == $option['id'] ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto size-filter" style="width: 20%">
                    <div class="form-group">
                        <label for="filter[product_id]">{{ __('Product') }}</label>
                        <select id="filter[product_id]" name="filter[product_id]" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="filter[product_id]">
                            <option selected value="" disabled>{{ __('Select Product') }}</option>
                            @foreach(get_product_select2_array(Auth::user()->sites_id) as $option)
                                <option value="{{ $option['id'] }}" {{ isset(Request::get("filter")['product_id']) && Request::get("filter")['product_id'] == $option['id'] ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto size-filter" style="width: 15%">
                    <div class="form-group">
                        <label for="filter[stock_in]">Stock In</label>
                        <input name="filter[stock_in]" type="text" class="form-control" value="{{ Request::get("filter")==['stock_in'] }}" placeholder="{{ __('messages.search') }}">
                    </div> 
                </div>
                <div class="col-sm-auto size-filter" style="width: 15%">
                    <div class="form-group">
                        <label for="filter[stock_out]">Stock Out</label>
                        <input name="filter[stock_out]" type="text" class="form-control" value="{{ Request::get("filter")==['stock_out'] }}" placeholder="{{ __('messages.search') }}">
                    </div> 
                </div>
                <div class="col-sm-auto size-filter" style="width: 20%">
                    <div class="form-group">
                        <label for="filter[remark]">Remarks</label>
                        <input name="filter[remark]" type="text" class="form-control" value="{{ Request::get("filter")==['remark'] }}" placeholder="{{ __('messages.search') }}">
                    </div> 
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <a href="{{ route('managements.index') }}">{{ __('messages.clear_filters') }}</a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons text-primary icon-20pt">refresh</i>
            {{ __('messages.filter') }}
        </button>
    </div>
</form> 