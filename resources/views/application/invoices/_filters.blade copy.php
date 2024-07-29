<style>
.size-filter{
    width: 14% !important;
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
                <div class="col-sm-auto" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[expense_category_id]">Plate Number</label>
                        <input name="filter[contact_name]" type="text" class="form-control" value="{{ Request::get("filter")==['contact_name'] }}" placeholder="{{ __('messages.search') }}">    
                    </div>
                </div>
                <div class="col-sm-auto" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[from]">Invoice Number</label>
                        <input name="filter[contact_name]" type="text" class="form-control" value="{{ Request::get("filter")==['contact_name'] }}" placeholder="{{ __('messages.search') }}">
                    </div> 
                </div>
                <div class="col-sm-auto" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[to]">DO Number</label>
                        <input name="filter[contact_name]" type="text" class="form-control" value="{{ Request::get("filter")==['contact_name'] }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[from]">From</label>
                        <input name="filter[from]" type="text" class="form-control" data-toggle="flatpickr" data-flatpickr-default-date="{{ Request::get("filter")['from'] ?? '' }}" readonly="readonly" placeholder="{{ __('messages.from') }}">
                    </div> 
                </div>
                <div class="col-sm-auto" style="width: 20%;">
                    <div class="form-group">
                        <label for="filter[to]">To</label>
                        <input name="filter[to]" type="text" class="form-control" data-toggle="flatpickr" data-flatpickr-default-date="{{ Request::get("filter")['to'] ?? '' }}" readonly="readonly" placeholder="{{ __('messages.to') }}">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <a href="{{ route('expenses') }}">{{ __('messages.clear_filters') }}</a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons text-primary icon-20pt">refresh</i>
            {{ __('messages.filter') }}
        </button>
    </div>
</form> 