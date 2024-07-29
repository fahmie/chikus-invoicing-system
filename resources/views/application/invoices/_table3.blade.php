@if($invoices->count() > 0)
    <div class="table-responsive">
    {{-- <form action="{{ route('receipts.storereceipts') }}" method="POST">
    @csrf --}}
    {{-- <button type="submit" class="btn btn-success">Create Receipt</button> --}}
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th class="text-center w-30px">No.</th>
                    <th>Plate Number</th>
                    @if(Auth::user()->roles =="superadmin")
                    <th>Site</th>
                    @endif
                    <th>{{ __('messages.date') }}</th>
                    <th>Driver Name</th>
                    <th>Contract Name</th>
                    <th>Delivery Status</th>
                    <th>Payment Status</th>
                    <th>{{ __('messages.total') }}</th>
                    <th>Discount</th>
                    <th>Invoice Number</th>
                    <th>DO Number</th>
                    <th>Receipt Number</th>
                    <!-- <th class="w-50px">{{ __('messages.view') }}</th> -->
                </tr>
            </thead>
            <tbody class="list" id="invoices">
                @foreach ($invoices as $k => $invoice)
                    <tr>
                        <td class="p">
                            {{ $k+1 }}
                        </td>        
                     
                        <td class="p">
                            {{$invoice->platenumbers->number_plate}}
                        </td>
                        @if(Auth::user()->roles =="superadmin")
                        <td class="text-muted mb-0" style="font-size: 14px">
                            {{ $invoice->sites->name }}
                        </td>
                        @endif
                        <td class="p">
                             {{ $invoice->formatted_invoice_date }}
                        </td>
                        <td class="p">
                            {{ $invoice->drivers->name}}
                        </td>
                        @if(!empty($invoice->client_id))
                        <td class="p">
                            {{ $invoice->clients->company_name}}
                        </td>
                        @else
                        <td class="p">
                            INDIVIDU
                        </td>  
                        @endif

                        <td class="p">
                            @if($invoice->status == 'DRAFT')
                                <div class="badge badge-dark fs-0-9rem">
                                    {{ $invoice->status }}
                                </div>
                            @elseif($invoice->status == 'OTW')
                                <div class="badge badge-info fs-0-9rem">
                                    {{ $invoice->status }}
                                </div>
                            @elseif($invoice->status == 'VIEWED')
                                <div class="badge badge-primary fs-0-9rem">
                                    {{ $invoice->status }}
                                </div>
                            @elseif($invoice->status == 'OVERDUE')
                                <div class="badge badge-danger fs-0-9rem">
                                    {{ $invoice->status }}
                                </div>
                            @elseif($invoice->status == 'COMPLETED')
                                <div class="badge badge-success fs-0-9rem">
                                    {{ $invoice->status }}
                                </div>
                            @endif
                        </td>
                        <td class="p">
                            @if($invoice->paid_status == 'UNPAID')
                                <div class="badge badge-warning fs-0-9rem">
                                    {{ $invoice->paid_status }}
                                </div>
                            @elseif($invoice->paid_status == 'PARTIALLY_PAID')
                                <div class="badge badge-info fs-0-9rem">
                                    {{ $invoice->paid_status }}
                                </div>
                            @elseif($invoice->paid_status == 'PAID')
                                <div class="badge badge-success fs-0-9rem">
                                    {{ $invoice->paid_status }}
                                </div>
                            @endif
                        </td>
                        <td class="p">
                            {{ money($invoice->total, "MYR") }}
                        </td>
                        <td class="p">
                            {{ money($invoice->discount, "MYR") }}
                        </td>
                        <td class="p">
                            <a href="{{ route('invoices.details', $invoice->id) }}">
                                {{ $invoice->invoice_number }}
                            </a>
                        </td>
                        <td class="p">
                            <a href="{{ route('invoices.detailsdocontract', $invoice->id) }}">
                                {{ $invoice->do_number }}
                            </a>
                        </td>
                        
                        <td class="p">
                            <a href="{{ route('receipts.detailsreceipts', $invoice->id) }}">
                                {{ $invoice->receipt_number }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- </form> --}}
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        {{ $invoices->links() }}
    </div>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">description</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4">No Receipts yet</p>
    </div>
@endif
{{-- @section('page_body_scripts')
    <script>
        $(document).ready(function() {
          $('.selectall').click(function(){
              $('.custom-control-input').prop('checked', $(this).prop('checked'));
          })
          $('.selectbox').change(function(){
              var total = $('.selectall').length;
              var number = $('.custom-control-input:checked').length;
            if(total == number){
                $('.selectall').prop('checked',true); 
            } else{
                $('.selectall').prop('checked',false);
            }
          })
        });
    </script>
@endsection --}}