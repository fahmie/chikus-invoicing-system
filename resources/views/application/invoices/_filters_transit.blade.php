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
                            <label for="filter[drivers.name]">Driver</label>
                            <input name="filter[drivers.name]" type="text" class="form-control" value="{{ Request::get("filter")==['drivers.name'] }}" placeholder="{{ __('messages.search') }}">
                        </div>
                    </div>
                    <div class="col-sm-auto size-filter">
                        <div class="form-group">
                            <label for="filter[platenumbers.number_plate]">Plate No.</label>
                            <input name="filter[platenumbers.number_plate]" type="text" class="form-control" value="{{ Request::get("filter")==['platenumbers.number_plate'] }}" placeholder="{{ __('messages.search') }}">
                        </div>
                    </div>
                    <div class="col-sm-auto size-filter">
                        <div class="form-group">
                            <label for="filter[transporters.company_name]">Transporter Name</label>
                            <input name="filter[transporters.company_name]" type="text" class="form-control" value="{{ Request::get("filter")==['transporters.company_name'] }}" placeholder="{{ __('messages.search') }}">
                        </div>
                    </div>
                    <div class="col-sm-auto size-filter">
                        <div class="form-group">
                            <label for="filter[transporterlocation.name]">Dropoff Location</label>
                            <input name="filter[transporterlocation.name]" type="text" class="form-control" value="{{ Request::get("filter")==['transporterlocation.name'] }}" placeholder="{{ __('messages.search') }}">
                        </div>
                    </div>
                    <div class="col-sm-auto size-filter">
                        <div class="form-group">
                            <label for="filter[items.quantity]">Quantity (Tan)</label>
                            <input name="filter[items.quantity]" type="text" class="form-control" value="{{ Request::get("filter")==['items.quantity'] }}" placeholder="{{ __('messages.search') }}">
                        </div>
                    </div>
                    <div class="col-sm-auto size-filter">
                        <div class="form-group">
                            <label for="filter[invoice_number]">{{ __('messages.invoice_number') }}</label>
                            <input name="filter[invoice_number]" type="text" class="form-control" value="{{ Request::get("filter")==['invoice_number'] }}" placeholder="{{ __('messages.search') }}">
                        </div>
                    </div>
                    <div class="col-sm-auto size-filter">
                        <div class="form-group">
                            <label for="filter[do_number]">DO Number</label>
                            <input name="filter[do_number]" type="text" class="form-control" value="{{ Request::get("filter")==['invoice_number'] }}" placeholder="{{ __('messages.search') }}">
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
                        <a href="{{ route('tracking') }}">{{ __('messages.clear_filters') }}</a>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
                <i class="material-icons text-primary icon-20pt">refresh</i>
                {{ __('messages.filter') }}
            </button>
        </div>
    </form>
    