@if($supplier->count() > 0)
    <div class="table-responsive" data-toggle="lists">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th>{{ __('messages.name') }}</th> 
                    <th>{{ __('Address') }}</th> 
                    <th>{{ __('Email') }}</th> 
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Sites') }}</th>
                    <th class="w-30">{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tbody class="list" id="supplier">
                @foreach($supplier as $data)
                    <tr>
                        <td class="h6">
                            <a href="{{ route('supplier.edit',  $data->id) }}">
                                <strong class="h6">
                                    {{ $data->name }}
                                </strong>
                            </a>
                        </td>
                        <td>
                            <strong class="h6">
                            {{ $data->address }}
                        </strong>
                        </td>
                        <td>
                            <strong class="h6">
                            {{ $data->email }}
                        </strong>
                        </td>
                        <td>
                            <strong class="h6">
                            {{ $data->phone }}
                        </strong>
                        </td>
                        <td>
                            <strong class="h6">
                            {{ $data->sites->name }}
                        </strong>
                        </td>
                        <td class="h6">
                            @if(Auth::user()->can('supplier-edit'))
                            <a href="{{ route('supplier.edit', $data->id) }}" class="btn text-primary">
                                <i class="material-icons icon-16pt">edit</i>
                                {{ __('messages.edit') }}
                            </a>
                            @endif
                            @if(Auth::user()->can('supplier-delete'))
                            <a href="{{ route('supplier.delete', $data->id) }}" class="btn text-danger delete-confirm">
                                <i class="material-icons icon-16pt">delete</i>
                                {{ __('messages.delete') }}
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        {{ $supplier->links() }}
    </div>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">style</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4">{{ __('No supplier yet') }}</p>
    </div>
@endif
