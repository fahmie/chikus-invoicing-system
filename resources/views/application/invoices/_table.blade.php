@if($invoices->count() > 0)
<div class="table-responsive">
    <table class="table table-xl mb-0 thead-border-top-0 table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>{{ __('messages.date') }}</th>
                @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                <th>Site</th>
                @endif
                <th>Plate Number</th>
                <th>Driver Name</th>
                <th>Contract Name</th>
                <th>{{ __('messages.status') }}</th>
                <th>{{ __('messages.paid_status') }}</th>
                <th>{{ __('messages.total') }}</th>
                <th>{{ __('messages.invoice_number') }}</th>
                <!-- <th class="w-50px">{{ __('messages.view') }}</th> -->
            </tr>
        </thead>
        <tbody class="list" id="invoices">
            @foreach ($invoices as $k =>$invoice )
            <tr>
                <td class="text-muted mb-0" style="font-size: 14px">
                    {{ $k+1 }}
                </td>
                <td class="text-muted mb-0" style="font-size: 14px">
                    {{ $invoice->formatted_invoice_date }}
                </td>
                @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                <td class="text-muted mb-0" style="font-size: 14px">
                    {{ $invoice->sites->name }}
                </td>
                @endif
                <td class="p" style="font-size: 14px">
                    <div class="badge badge-dark fs-0-9rem">
                        {{$invoice->platenumbers->number_plate}}
                    </div>
                </td>
                <td class="text-muted mb-0" style="max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                    {{$invoice->drivers->name}}
                </td>
                <td class="text-muted mb-0" style="max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                    @if(!empty($invoice->client_id))
                    {{$invoice->clients->company_name}}
                    @elseif(empty($invoice->client_id))
                    Individual
                    @endif
                </td>
                <td class="p" style="font-size: 14px">
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
                <td class="p" style="font-size: 14px">
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
                <td class="p" style="font-size: 14px; font-weight: 600;">
                    {{ money($invoice->total, "MYR") }}
                </td>
                <td class="p" style="font-size: 14px">
                    <a href="{{ route('invoices.details', $invoice->id) }}">
                        {{ $invoice->invoice_number }}
                    </a>
                </td>
                <!-- <td class="h6">
                            <a href="{{ route('invoices.detailscash', $invoice->id) }}" class="btn btn-sm btn-link">
                                <i class="material-icons icon-16pt">arrow_forward</i>
                            </a>
                        </td> -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row card-body pagination-light justify-content-center text-center">
    {{ $invoices->links() }}
</div>
@else
<div class="row justify-content-center card-body pb-0 pt-5">
    <i class="material-icons fs-64px">description</i>
</div>
<div class="row justify-content-center card-body pb-5">
    <p class="h4">No invoices yet</p>
</div>
@endif