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
                        <label for="filter[drivers.name]">Driver Name</label>
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
                        <label for="filter[invoice_number]">Invoice Number</label>
                        <input name="filter[invoice_number]" type="text" class="form-control" value="{{ Request::get("filter")==['invoice_number'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[do_number]">DO Number</label>
                        <input name="filter[do_number]" type="text" class="form-control" value="{{ Request::get("filter")==['do_number'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[total_quantity]">Qty Start (Tan)</label>
                        <input name="filter[total_quantity]" type="text" class="form-control" value="{{ Request::get("filter")==['total_quantity'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[total_inaccurate]">Qty Arrived (Tan)</label>
                        <input name="filter[total_inaccurate]" type="text" class="form-control" value="{{ Request::get("filter")==['total_inaccurate'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto size-filter">
                    <div class="form-group">
                        <label for="filter[receipt_tran_number]">Receipt Number</label>
                        <input name="filter[receipt_tran_number]" type="text" class="form-control" value="{{ Request::get("filter")==['receipt_tran_number'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <a href="{{ route('transporter.show',['id' => $id, 'tab' => $tab])  }}">{{ __('messages.clear_filters') }}</a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons text-primary icon-20pt">refresh</i>
            {{ __('messages.filter') }}
        </button>
    </div>
</form>