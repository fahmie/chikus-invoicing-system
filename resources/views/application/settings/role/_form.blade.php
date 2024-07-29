<div class="row">
    <div class="col">
        <div class="form-group required">
            <label for="name">{{ __('messages.name') }}</label>
            <input name="name" type="text" class="form-control" placeholder="{{ __('messages.name') }}" required>
        </div>
        <div class="form-group">
            <label for="name">Permission</label>
            <br/>
            @foreach($permission as $value)
            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
            {{ $value->name }}</label>
            <br/>
            @endforeach
        </div>
    </div>
</div>