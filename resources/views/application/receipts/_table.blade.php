@if($invoices->count() > 0)
    <div class="table-responsive">
    {{-- <form action="{{ route('receipts.storereceipts') }}" method="POST">
    @csrf --}}
    {{-- <button type="submit" class="btn btn-success">Create Receipt</button> --}}
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th style="padding:0.35rem 10px 0.35rem 1rem;">No.</th>
                    <th style="padding:0.35rem 10px;">{{ __('messages.date') }}</th>
                    <th style="padding:0.35rem 10px;">Plate Number</th>
                    <th style="padding:0.35rem 10px;">Driver Name</th>
                    @if(Auth::user()->roles =="superadmin")
                    <th style="padding:0.35rem 10px;">Site</th>
                    @endif
                    <th style="padding:0.35rem 10px;">Contract Name</th>
                    <th style="padding:0.35rem 10px;">Delivery Status</th>
                    <th style="padding:0.35rem 10px;">Payment Status</th>
                    <th style="padding:0.35rem 10px;">{{ __('messages.total') }}</th>
                    <th style="padding:0.35rem 10px;">Discount</th>
                    <th style="padding:0.35rem 10px;">Invoice Number</th>
                    <th style="padding:0.35rem 10px;">DO Number</th>
                    <th style="width: 10%; padding:0.35rem 1rem 0.35rem 10px;">Receipt Number</th>
                    <!-- <th class="w-50px">{{ __('messages.view') }}</th> -->
                </tr>
            </thead>
            <tbody class="list" id="invoices">
                @foreach ($invoices as $k => $invoice)
                    <tr>
                        <td style="padding:0.35rem 10px 0.35rem 1rem;font-size: 14px">
                            {{ $k+1 }}
                        </td>        
                        <td class="text-muted mb-0" style="padding:0.35rem 10px;font-size: 14px">
                            {{ $invoice->formatted_invoice_date }}
                       </td>
                        <td class="p" style="padding:0.35rem 10px;font-size: 14px">
                            <div class="badge badge-dark fs-0-9rem">
                                {{$invoice->platenumbers->number_plate}}
                            </div>
                        </td>
                        <td class="text-muted mb-0" style="padding:0.35rem 10px;max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                            {{ $invoice->drivers->name}}
                          </td>
                        @if(Auth::user()->roles =="superadmin")
                        <td class="text-muted mb-0" style="font-size: 14px">
                            {{ $invoice->sites->name }}
                        </td>
                        @endif
                        @if(!empty($invoice->client_id))
                        <td class="text-muted mb-0" style="padding:0.35rem 10px;max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                            {{ $invoice->clients->company_name}}
                        </td>
                        @else
                        <td class="text-muted mb-0" style="padding:0.35rem 10px;font-size: 14px">
                            INDIVIDU
                        </td>  
                        @endif

                        <td class="p" style="padding:0.35rem 10px;font-size: 14px">
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
                        <td class="p" style="padding:0.35rem 10px;font-size: 14px">
                            @if($invoice->paid_status == 'UNPAID')
                                <div class="badge badge-warning fs-0-9rem">
                                    {{ $invoice->paid_status }}
                                </div>
                            @elseif($invoice->paid_status == 'PARTIALLY PAID')
                                <div class="badge badge-info fs-0-9rem">
                                    {{ $invoice->paid_status }}
                                </div>
                            @elseif($invoice->paid_status == 'PAID')
                                <div class="badge badge-success fs-0-9rem">
                                    {{ $invoice->paid_status }}
                                </div>
                            @endif
                        </td>
                        <td class="w-5" style="padding:0.35rem 10px;font-size: 14px; font-weight: 600;">
                            {{ money($invoice->total, "MYR") }}
                        </td>
                        <td class="w-5" style="padding:0.35rem 10px;font-size: 14px; font-weight: 600;">
                            {{ money($invoice->discount, "MYR") }}
                        </td>
                        <td class="p" style="padding:0.35rem 10px;font-size: 14px">
                            <a href="{{ route('invoices.details', $invoice->id) }}">
                                {{ $invoice->invoice_number }}
                            </a>
                        </td>
                        <td class="p" style="padding:0.35rem 10px;font-size: 14px">
                            @if($invoice->status == "OTW")
                            <a href="{{ route('invoices.detailsdocontract', $invoice->id) }}">
                            {{$invoice->do_number}}
                            </a>
                            @else
                            <a href="{{ route('invoices.detailsdoarrived', $invoice->id) }}">
                            {{$invoice->do_number}}
                            </a>
                            @endif
                        </td>
                        
                          <td class="p" style="width: 10%;padding:0.35rem 1rem 0.35rem 10px;font-size: 14px">
                        @if($invoice->type == 1)
                            @foreach($receipts as $key => $data)
                            <?php 
                            if($data->invoice_id == $invoice->id){
                            ?>
                            <a href="{{ route('receipts.details', [ 'id' => $invoice->id,'refrence' => $data->reference_number]) }}">
                                {{ $data->receipt_number }}
                            </a>
                            <?php 
                            }   
                            ?>
                        @endforeach
                            @else
                            <a href="{{ route('receipts.detailsreceipts', $invoice->id) }}">
                                {{ $invoice->receipt_number }}
                            </a>
                            @endif
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