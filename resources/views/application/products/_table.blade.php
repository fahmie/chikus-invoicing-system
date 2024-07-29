@if($products->count() > 0)
    <div class="table-responsive" data-toggle="lists">
        <table class="table mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th class="text-center w-30px">No.</th>
                    <th >{{ __('messages.product') }}</th>
                    @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                    <th>Sites</th>
                    @endif
                    <th>{{ __('messages.unit') }}</th>
                    <th>{{ __('messages.price') }}</th>
                    <th>{{ __('messages.created_at') }}</th>
                    @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company" || Auth::user()->roles =="admin")
                    <th class="w-50px">Edit</th>
                    @endif
                </tr>
            </thead>
            <tbody class="list" id="products">
                @foreach ($products as $key => $product)
                    <tr>
                        <td style="font-size: 14px">
                            <div class="text-muted mb-0">
                                <a class="mb-0">
                                    {{ $key+1 }}
                                </a>
                            </div>
                        </td>
                        <td style="font-size: 14px; text-transform: capitalize;">
                            <a class="mb-0">
                                <strong>{{ $product->name }}</strong>
                            </a>
                        </td>
                        <!-- <td class="w-90px">
                        @if(!empty($product->client_id))
                            {!! \App\Models\Client::findOrFail($product->client_id)->company_name; !!}
                        @endif
                        </td> -->
                        @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                        <td style="font-size: 14px">
                            {{$product->sites->name}}
                        </td>
                        @endif
                        <td class="text-muted mb-0" style="font-size: 14px">
                            {{ $product->unit->name ?? '-' }}
                        </td>
                        <td class="text-muted mb-0" style="font-size: 14px">
                            {{ money($product->price, "MYR") }}
                        </td>
                        <td class="text-muted mb-0" style="font-size: 14px">
                            {{ $product->created_at->format('d-m-Y') }}
                        </td>
                        @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company" || Auth::user()->roles =="admin")
                        <td style="font-size: 14px">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-link">
                                <i class="material-icons icon-16pt">edit</i>
                            </a> 
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        {{ $products->links() }}
    </div>
    
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">store</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4">{{ __('messages.no_products_yet') }}</p>
    </div>
@endif