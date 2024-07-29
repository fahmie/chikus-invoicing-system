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
<form action="" method="GET">
    <div class="card card-form d-flex flex-column flex-sm-row">
        <div class="card-form__body card-body-form-group flex">
            <div class="row">
                <div class="col-sm-auto size-filter" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[name]">Driver Name</label>
                        <input name="filter[name]" type="text" class="form-control" value="{{ Request::get("filter")==['name'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[ic]">IC Number</label>
                        <input name="filter[ic]" type="text" class="form-control" value="{{ Request::get("filter")==['ic'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[phone]">No Phone</label>
                        <input name="filter[phone]" type="text" class="form-control" value="{{ Request::get("filter")==['phone'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[platenumbers.number_plate]">Plate Number</label>
                        <input name="filter[platenumbers.number_plate]" type="text" class="form-control" value="{{ Request::get("filter")==['platenumbers.number_plate'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                
                <div class="col-sm-auto size-filter" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[driverLorryType.name]">Lorry Type</label>
                        <input name="filter[driverLorryType.name]" type="text" class="form-control" value="{{ Request::get("filter")==['driverLorryType.name'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <!-- <div class="col-sm-auto" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[has_unpaid]">{{ __('messages.has_unpaid_invoice') }}</label>
                        <div class="custom-control custom-checkbox mt-sm-2">
                            <input id="filter[has_unpaid]" name="filter[has_unpaid]" type="checkbox" {{ isset(Request::get("filter")['has_unpaid']) ? 'checked=""' : '' }} value="true" class="custom-control-input" >
                            <label class="custom-control-label" for="filter[has_unpaid]">{{ __('messages.yes') }}</label>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <a href="{{ route('driver') }}">{{ __('messages.clear_filters') }}</a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons text-primary icon-20pt">refresh</i>
            {{ __('messages.filter') }}
        </button>
    </div>
</form>