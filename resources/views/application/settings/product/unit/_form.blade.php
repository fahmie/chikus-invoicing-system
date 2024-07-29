<div class="row">
    <div class="col">
        <div class="form-group required">
            <label for="name">{{ __('messages.name') }}</label>
            <input name="name" type="text" class="form-control" placeholder="{{ __('messages.name') }}" value="{{ $product_unit->name }}" required>
        </div>
    </div>
    <div class="form-group required">
        <label for="company">{{ __('Company') }}</label>
        <select name="company_id"  class="form-control" required>
        @foreach ($company as $company)
         <option value="{{ $company->id}}" @if(isset($product_unit) && $product_unit->company_id == $company->id) selected @endif>{{$company->name}}</option>
        @endforeach
        </select>
    </div>
</div>

