
<div class="row">
    <div class="col"> 
        <div class="form-group required">
            <label for="name">Product Name</label>
            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': ''}}" name="name" value="{{  isset($productInventory) ? $productInventory->name : '' }}" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group required">
            <label for="site">{{ __('Sites') }}</label>
            <select name="sites_id"  class="form-control" required>
            @foreach ($sites as $site)
             <option value="{{ $site->id}}" @if(isset($productInventory) && $productInventory->sites_id == $site->id) selected @endif>{{$site->name}}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col">
        <div class="form-group required">
            <label for="unit">{{ __('messages.unit') }}</label>
            <select name="unit_id" data-toggle="select" required>
            <option value="" selected disabled>-- Please Unit Type --</option>
                @foreach ($unit as $unit)
                <option value="{{ $unit->id}}" @if(isset($productInventory) && $productInventory->unit_id == $unit->id) selected @endif>{{$unit->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="description">{{ __('messages.description') }}</label>
            <textarea class="form-control {{ $errors->has('description')? 'is-invalid': ''}}" name="description" cols="30" rows="3">{{  isset($productInventory) ? $productInventory->description : '' }}</textarea>
        </div>
    </div>
</div>