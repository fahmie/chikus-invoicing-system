@if($productInventory->count() > 0)
    <div class="table-responsive" data-toggle="lists">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th>{{ __('messages.name') }}</th> 
                    <th>{{ __('Unit') }}</th> 
                    <th>{{ __('Site') }}</th> 
                </tr>
            </thead>
            <tbody class="list" id="supplier">
                @foreach ($productInventory as $data)
                    <tr>
                        <td class="h6">
                            <a href="{{ route('productInventory.edit',  $data->id) }}">
                                <strong class="h6">
                                    {{ $data->name }}
                                </strong>
                            </a>
                        </td>
                        <td>
                            <strong class="h6">
                            {{ $data->unit->name }}
                        </strong>
                        </td>
                        <td>
                            <strong class="h6">
                            {{ $data->sites->name }}
                        </strong>
                        </td>
                        <td class="h6">
                            @if(Auth::user()->can('product-inventory-edit'))
                            <a href="{{ route('productInventory.edit', $data->id) }}" class="btn text-primary">
                                <i class="material-icons icon-16pt">edit</i>
                                {{ __('messages.edit') }}
                            </a>
                            @endif
                            @if(Auth::user()->can('product-inventory-delete'))
                            <a href="{{ route('productInventory.delete', $data->id) }}" class="btn text-danger delete-confirm">
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
        {{ $productInventory->links() }}
    </div>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">style</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4">{{ __('No product yet') }}</p>
    </div>
@endif
