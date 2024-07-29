<style>

@media screen and (max-width: 768px) {
    .size-filter{
        width: 100% !important;
    }
}
@media screen and (min-width: 1367) {
    .size-filter{
        width: 100% !important;
    }
}
</style>
<form action="" method="GET">
    <div class="card card-form d-flex flex-column flex-sm-row">
        <div class="card-form__body card-body-form-group flex">
            <div class="row">
                <div class="col-xl-auto size-filter" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[invoice_date]">Date</label>
                        <input name="filter[invoice_date]" type="text" class="form-control input" data-enable-time=true data-toggle="flatpickr" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-xl-auto size-filter" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[platenumbers.number_plate]">Plate Number</label>
                        <input name="filter[platenumbers.number_plate]" type="text" class="form-control" value="{{ Request::get("filter")==['platenumbers.number_plate'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-xl-auto size-filter" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[drivers.name]">Driver Name</label>
                        <input name="filter[drivers.name]" type="text" class="form-control" value="{{ Request::get("filter")==['drivers.name'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-xl-auto size-filter" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[clients.company_name]">Contract Name</label>
                        <input name="filter[clients.company_name]" type="text" class="form-control" value="{{ Request::get("filter")==['clients.company_name'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-xl-auto size-filter" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[status]">Delivery Status</label>
                        <input name="filter[status]" type="text" class="form-control" value="{{ Request::get("filter")==['status'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-xl-auto size-filter" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[paid_status]">Payment Status</label>
                        <input name="filter[paid_status]" type="text" class="form-control" value="{{ Request::get("filter")==['paid_status'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-xl-auto size-filter" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[invoice_number]">{{ __('messages.invoice_number') }}</label>
                        <input name="filter[invoice_number]" type="text" class="form-control" value="{{ Request::get("filter")==['invoice_number'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <!-- <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[from]">{{ __('messages.from') }}</label>
                        <input name="filter[from]" type="text" class="form-control" data-toggle="flatpickr" data-flatpickr-default-date="{{ Request::get("filter")['from'] ?? '' }}" readonly="readonly" placeholder="{{ __('messages.from') }}">
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[to]">{{ __('messages.to') }}</label>
                        <input name="filter[to]" type="text" class="form-control" data-toggle="flatpickr" data-flatpickr-default-date="{{ Request::get("filter")['to'] ?? '' }}" readonly="readonly" placeholder="{{ __('messages.to') }}">
                    </div>
                </div> -->
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <a href="{{ route('invoices') }}">{{ __('messages.clear_filters') }}</a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons text-primary icon-20pt">refresh</i>
            {{ __('messages.filter') }}
        </button>
    </div>
</form>
