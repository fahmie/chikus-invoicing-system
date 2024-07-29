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
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[company_name]">Company Name</label>
                        <input name="filter[company_name]" type="text" class="form-control" value="{{ Request::get("filter")==['company_name'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[name]">Name</label>
                        <input name="filter[name]" type="text" class="form-control" value="{{ Request::get("filter")==['name'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[address]">Address</label>
                        <input name="filter[address]" type="text" class="form-control" value="{{ Request::get("filter")==['address'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[phone]">Phone Number</label>
                        <input name="filter[phone]" type="text" class="form-control" value="{{ Request::get("filter")==['phone'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[email]">Email</label>
                        <input name="filter[email]" type="text" class="form-control" value="{{ Request::get("filter")==['email'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[remark]">Remarks</label>
                        <input name="filter[remark]" type="text" class="form-control" value="{{ Request::get("filter")==['remark'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <a href="{{ route('transporter') }}">{{ __('messages.clear_filters') }}</a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons text-primary icon-20pt">refresh</i>
            {{ __('messages.filter') }}
        </button>
    </div>
</form> 