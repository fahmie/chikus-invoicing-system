
 <div class="row mt-3">
     <div class="col-sm-6"> 
         <div class="form-group">
             <label for="currency_id">{{ __('messages.currency') }}</label>
             <select name="currency_id" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="currency_id" required>
                 <option disabled selected>{{ __('messages.select_currency') }}</option>
                 @foreach(get_currencies_select2_array() as $option)
                     <option value="{{ $option['id'] }}">{{ $option['text'] }}</option>
                 @endforeach
             </select>
         </div>
     </div>
     <div class="col-sm-6">
         <div class="form-group">
             <label for="langugage">{{ __('messages.language') }}</label>
             <select id="langugage" name="langugage" data-toggle="select" data-minimum-results-for-search="-1" class="form-control select2-hidden-accessible" data-select2-id="langugage">
                 <option disabled selected>{{ __('messages.select_language') }}</option>
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
             <label for="timezone">{{ __('messages.timezone') }}</label>
             <select id="timezone" name="timezone" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="timezone">
                 <option disabled selected>{{ __('messages.select_timezone') }}</option>
                 @foreach(get_timezones_select2_array() as $timezone)
                     <option value="{{ $timezone['id'] }}">{{ $timezone['text'] }}</option>
                 @endforeach
             </select>
         </div>
     </div>
     <div class="col-sm-6">
         <div class="form-group">
             <label for="date_format">{{ __('messages.date_format') }}</label>
             <select id="date_format" name="date_format" data-toggle="select" data-minimum-results-for-search="-1" class="form-control select2-hidden-accessible" data-select2-id="date_format">
                 <option disabled selected>{{ __('messages.select_date_format') }}</option>
                 @foreach(get_date_formats_select2_array() as $date_format)
                     <option value="{{ $date_format['id'] }}">{{ $date_format['text'] }}</option>
                 @endforeach
             </select>
         </div>
     </div>
 </div>
 <div class="row mt-4">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="company_id">Company Name</label>
            <select id="company_id" name="company_id" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="company_id">
                <option disabled selected>Select Company Name</option>
                @foreach($company as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
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
             <label for="financial_month_starts">{{ __('messages.month_starts') }}</label>
             <select id="financial_month_starts" name="financial_month_starts" data-minimum-results-for-search="-1" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="financial_month_starts">
                 <option disabled selected>{{ __('messages.select_month_starts') }}</option>
                 @foreach(get_months_select2_array() as $month)
                     <option value="{{ $month['id'] }}">{{ $month['text'] }}</option>
                 @endforeach
             </select>
         </div>
     </div>
     <div class="col-sm-4">
         <div class="form-group">
             <label for="financial_month_ends">Month Ends</label>
             <select id="financial_month_ends" name="financial_month_ends" data-minimum-results-for-search="-1" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="financial_month_ends">
                 <option disabled selected>{{ __('messages.select_month_ends') }}</option>
                 @foreach(get_months_select2_array() as $month)
                     <option value="{{ $month['id'] }}">{{ $month['text'] }}</option>
                 @endforeach
             </select>
         </div>
     </div>
 </div>
 <div class="form-group text-right mt-5">
     <button type="submit" class="btn btn-primary">Save Settings</button>
 </div>