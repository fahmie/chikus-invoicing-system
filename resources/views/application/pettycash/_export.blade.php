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
<form action="{{ route('pettycash.export')}}" method="GET">
    <div class="card card-form d-flex flex-column flex-sm-row">
        <div class="card-form__body card-body-form-group flex">
            <div class="row">
                <div class="col-sm-auto size-filter" style="width: 30%">
                    <div class="form-group">
                        <label for="filter[date]">Date From</label>
                        <input name="date_from" type="text" class="form-control input {{ $errors->has('date_from')? 'is-invalid': ''}}"" data-toggle="flatpickr" placeholder="{{ __('messages.search') }}" required>
                    </div> 
                </div>
                <div class="col-sm-auto size-filter" style="width: 30%">
                    <div class="form-group">
                        <label for="filter[date]">Date End</label>
                        <input name="date_end" type="text" class="form-control input {{ $errors->has('date_end')? 'is-invalid': ''}}"" data-toggle="flatpickr" placeholder="{{ __('messages.search') }}" required>
                    </div> 
                </div>
                <div class="col-sm-auto size-filter" style="width: 30%">
                    <div class="form-group">
                        <label for="filter[sites_id]">Sites</label>
                        <select id="filter[sites_id]" name="sites_id" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="filter[unit_id]" required>
                            <option selected value="" disabled>Select Site</option>
                            @foreach($sites as $option)
                                <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
                            @endforeach
                        </select>
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
            <i class="material-icons text-primary icon-20pt">file_download</i>
            Download
        </button>
    </div>
</form> 