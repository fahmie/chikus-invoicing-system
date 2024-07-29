<div class="form-group">
        <label>{{ __('messages.company_logo') }}</label><br>
        <input id="avatar" name="avatar" class="d-none" type="file" onchange="changePreview(this);">
        <label for="avatar">
            <div class="media align-items-center">
                <div class="mr-3">
                    <div class="avatar avatar-xl">
                        <img id="file-prev" src="{{  isset($company) ? $company->avatar : '' }}" class="avatar-img rounded" required>
                    </div>
                </div>
                <div class="media-body">
                    <a class="btn btn-sm btn-light choose-button">{{ __('messages.choose_photo') }}</a>
                </div>
            </div>
        </label>
    </div> 

    <div class="row">
        <div class="col">
            <div class="form-group required">
                <label for="name">{{ __('messages.company_name') }}</label>
                <input name="name" type="text" class="form-control" placeholder="{{ __('messages.company_name') }}" value="{{  isset($company) ? $company->address->name : '' }}" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="billing[phone]">{{ __('messages.phone') }}</label>
                <input name="billing[phone]" type="text" class="form-control" value="{{  isset($company) ? $company->address->phone : '' }}" placeholder="{{ __('messages.phone') }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group required">
                <label for="billing[country_id]">{{ __('messages.country') }}</label>
                <select id="billing[country_id]" name="billing[country_id]" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="billing[country_id]" required>
                    <option disabled selected>{{ __('messages.select_country') }}</option>
                    @foreach(get_countries_select2_array() as $option)
                        <option value="{{ $option['id'] }}" @if(isset($company) && $company->address->country_id == $option['id']) selected @endif>{{ $option['text'] }}</option>
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="billing[state]">{{ __('messages.state') }}</label>
                <input name="billing[state]" type="text" class="form-control" value="{{  isset($company) ? $company->address->state : '' }}" placeholder="{{ __('messages.state') }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="billing[city]">{{ __('messages.city') }}</label>
                <input name="billing[city]" type="text" class="form-control" value="{{  isset($company) ? $company->address->city : '' }}" placeholder="{{ __('messages.city') }}">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="billing[zip]">{{ __('messages.postal_code') }}</label>
                <input name="billing[zip]" type="text" class="form-control" value="{{  isset($company) ? $company->address->zip : '' }}" placeholder="{{ __('messages.postal_code') }}">
            </div>
        </div>
    </div>

    <div class="form-group required">
        <label for="billing[address_1]">{{ __('messages.address') }}</label>
        <textarea name="billing[address_1]" class="form-control" rows="2" placeholder="{{ __('messages.address') }}" required>{{  isset($company) ? $company->address->address_1 : '' }}</textarea>
    </div>
    <hr>
    <div class="row"> 
        <div class="col-12">
            <p class="h5 mb-0">
                <strong class="headings-color">{{ __('messages.preferences') }}</strong>
            </p>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-sm-6"> 
            <div class="form-group">
                <label for="company_setting[currency_id]">{{ __('messages.currency') }}</label>
                <select name="company_setting[currency_id]" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="currency_id" required>
                    <option disabled selected>{{ __('messages.select_currency') }}</option>
                    @foreach(get_currencies_select2_array() as $option)
                    <option value="{{ $option['id'] }}" @if(isset($company) && $company->getSetting('currency_id', $company->id) == $option['id']) selected @endif>{{ $option['text'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="company_setting[langugage]">{{ __('messages.language') }}</label>
                <select id="langugage" name="company_setting[langugage]" data-toggle="select" data-minimum-results-for-search="-1" class="form-control select2-hidden-accessible" data-select2-id="langugage">
                    @foreach(get_languages_select2_array() as $language)
                    <option value="{{ $language['id'] }}" selected>{{ $language['text'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="company_setting[timezone]">{{ __('messages.timezone') }}</label>
                <select id="timezone" name="company_setting[timezone]" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="timezone">
                    <option disabled selected>{{ __('messages.select_timezone') }}</option>
                    @foreach(get_timezones_select2_array() as $timezone)
                        <option value="{{ $timezone['id'] }}" @if(isset($company) && $company->getSetting('timezone', $company->id) == $timezone['id']) selected @endif>{{ $timezone['text'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="company_setting[date_format]">{{ __('messages.date_format') }}</label>
                <select id="date_format" name="company_setting[date_format]" data-toggle="select" data-minimum-results-for-search="-1" class="form-control select2-hidden-accessible" data-select2-id="date_format">
                    <option disabled selected>{{ __('messages.select_date_format') }}</option>
                    @foreach(get_date_formats_select2_array() as $date_format)
                        <option value="{{ $date_format['id'] }}" @if(isset($company) && $company->getSetting('date_format', $company->id) == $date_format['id']) selected @endif>{{ $date_format['text'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <p class="h6 mb-3">
                <strong class="headings-color">{{ __('messages.financial_year') }}</strong>
            </p>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="company_setting[financial_month_starts]">{{ __('messages.month_starts') }}</label>
                <select id="financial_month_starts" name="company_setting[financial_month_starts]" data-minimum-results-for-search="-1" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="financial_month_starts">
                    <option disabled selected>{{ __('messages.select_month_starts') }}</option>
                    @foreach(get_months_select2_array() as $month)
                        <option value="{{ $month['id'] }}" @if(isset($company) && $company->getSetting('financial_month_starts', $company->id) == $month['id']) selected @endif>{{ $month['text'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="company_setting[financial_month_ends]">Month Ends</label>
                <select id="financial_month_ends" name="company_setting[financial_month_ends]" data-minimum-results-for-search="-1" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="financial_month_ends">
                    <option disabled selected>{{ __('messages.select_month_ends') }}</option>
                    @foreach(get_months_select2_array() as $month)
                        <option value="{{ $month['id'] }}"  @if(isset($company) && $company->getSetting('financial_month_ends', $company->id) == $month['id']) selected @endif>{{ $month['text'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <hr>

    <div class="form-group mb-4">
        <p class="h5 mb-0">
            <strong class="headings-color">{{ __('messages.invoice_settings') }}</strong>
        </p>
        <p class="text-muted">{{ __('messages.customize_invoice_settings') }}</p>
    </div>

    <div class="row">
        <div class="col-12 col-md-5">
            <div class="form-group required">
                <label for="company_setting[invoice_prefix]">{{ __('messages.invoice_prefix') }}</label>
                <input name="company_setting[invoice_prefix]" type="text" class="form-control" value="{{ isset($company) ? $company->getSetting('invoice_prefix', $company->id) : ''}}" placeholder="{{ __('messages.invoice_prefix') }} " required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-5">
            <div class="form-group required">
                <label for="company_setting[invoice_color]">{{ __('messages.invoice_color') }}</label>
                <input name="company_setting[invoice_color]" type="color" class="form-control" value="{{ isset($company) ? $company->getSetting('invoice_color', $company->id) : '' }}" placeholder="{{ __('messages.invoice_color') }}">
            </div>
        </div>
    </div> 
    <div class="form-group">
        <label for="company_setting[notes]">Terms:</label>
        <textarea name="company_setting[invoice_note]" class="form-control" rows="4" placeholder="Terms">{{ isset($company) ? $company->getSetting('invoice_note', $company->id) : '' }}</textarea>
    </div>
    <div class="form-group">
        <label for="company_setting[invoice_footer]">{{ __('messages.footer') }}</label>
        <textarea name="company_setting[invoice_footer]" class="form-control" rows="4" placeholder="{{ __('messages.footer') }}">{{ isset($company) ? $company->getSetting('invoice_footer', $company->id) : ''}}</textarea>
    </div>
    
    <div class="form-group text-right mt-4">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>