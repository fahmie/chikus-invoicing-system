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
                <div class="col-sm-auto size-filter" style="width: 20%">
                    <div class="form-group">
                        <label for="filter[detail]">Status/Details</label>
                        <input name="filter[detail]" type="text" class="form-control" value="{{ Request::get("filter")==['detail'] }}" placeholder="{{ __('messages.search') }}">    
                    </div>
                </div>
                <div class="col-sm-auto size-filter" style="width: 15%">
                    <div class="form-group">
                        <label for="filter[debit]">Debit Amount</label>
                        <input name="filter[debit]" type="text" class="form-control" value="{{ Request::get("filter")==['debit'] }}" placeholder="{{ __('messages.search') }}">
                    </div> 
                </div>
                <div class="col-sm-auto size-filter" style="width: 15%">
                    <div class="form-group">
                        <label for="filter[credit]">Credit Amount</label>
                        <input name="filter[credit]" type="text" class="form-control" value="{{ Request::get("filter")==['credit'] }}" placeholder="{{ __('messages.search') }}">
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
                    <a href="{{ route('pettycash') }}">{{ __('messages.clear_filters') }}</a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons text-primary icon-20pt">refresh</i>
            {{ __('messages.filter') }}
        </button>
    </div>
</form> 