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
                <div class="col-sm-auto size-filter" style="width: 25%;">
                    <div class="form-group">
                        <label for="filter[company_name]">Company Name</label>
                        <input name="filter[company_name]" type="text" class="form-control" value="{{ Request::get("filter")==['company_name'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter" style="width: 25%;">
                    <div class="form-group">
                        <label for="filter[delivery_location]">Delivery Location</label>
                        <input name="filter[delivery_location]" type="text" class="form-control" value="{{ Request::get("filter")==['delivery_location'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter" style="width: 25%;">
                    <div class="form-group">
                        <label for="filter[company_no]">Company No</label>
                        <input name="filter[company_no]" type="text" class="form-control" value="{{ Request::get("filter")==['company_no'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter" style="width: 25%;">
                    <div class="form-group">
                        <label for="filter[address]">Address</label>
                        <input name="filter[address]" type="text" class="form-control" value="{{ Request::get("filter")==['address'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter" style="width: 25%;">
                    <div class="form-group">
                        <label for="filter[project_manager_name]">Manager Name</label>
                        <input name="filter[project_manager_name]" type="text" class="form-control" value="{{ Request::get("filter")==['project_manager_name'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter" style="width: 25%;">
                    <div class="form-group">
                        <label for="filter[phone]">Phone</label>
                        <input name="filter[phone]" type="text" class="form-control" value="{{ Request::get("filter")==['phone'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter" style="width: 25%;">
                    <div class="form-group">
                        <label for="filter[phone]">Email</label>
                        <input name="filter[phone]" type="text" class="form-control" value="{{ Request::get("filter")==['phone'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                {{-- <div class="col-sm-auto size-filter" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[price]">Price Per Tonne (RM)</label>
                        <input name="filter[price]" type="text" class="form-control" value="{{ Request::get("filter")==['price'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div> --}}
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <a href="{{ route('client') }}">{{ __('messages.clear_filters') }}</a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons text-primary icon-20pt">refresh</i>
            {{ __('messages.filter') }}
        </button>
    </div>
</form>