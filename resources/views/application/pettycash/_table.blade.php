<style>

</style>
@if($pettyCashs->count() > 0)    
    <div class="table-responsive">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th class="text-center w-30px">ID</th>
                    @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                    <th>Site</th>
                    @endif
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status/Details</th>
                    <th><i class="material-icons icon-16pt mr-1 text-muted">add_circle</i>Debit Amount</th>
                    <th><i class="material-icons icon-16pt mr-1 text-muted">remove_circle</i>Credit Amount</th>
                    <th><i class="material-icons icon-16pt mr-1 text-muted">account_balance_wallet</i>Balance Amount</th>
                    <th class="text-center">Attachment</th>
                    <th class="text-center">Remarks</th>
                </tr>
            </thead>
            <tbody class="list" id="expenses">
                @foreach($pettyCashs as $k => $pettyCash)
                    <tr>
                        <td class="text-muted mb-0 w-30px" style="font-size: 14px">
                            <a>
                            {{$k+1}}
                            </a>
                        </td>
                        @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                        <td class="text-muted mb-0" style="font-size: 14px">
                            {{ $pettyCash->sites->name }}
                        </td>
                        @endif
                        <td class="text-muted mb-0" style="font-size: 14px">
                          {{$pettyCash->date}}
                        </td>
                        <td class="text-muted mb-0" style="font-size: 14px">
                          {{date('h:i:A ', strtotime($pettyCash->created_at))}}
                        </td>
                        <td class="p" style="font-size: 14px">
                            {{$pettyCash->detail}}
                        </td>
                        @if($pettyCash->debit != NULL)
                        <td class="p" style="font-size: 14px; font-weight: 600;">
                        <i class="material-icons mr-1" style="font-size: 10px; font-weight: 600; color: green;">add</i>
                            {{money($pettyCash->debit, "MYR")->format()}}
                            
                        </td>
                        @else
                            <td style="text-align: center;font-size: 12px; font-weight: 600;">
                               - 
                            </td>
                        @endif
                        @if($pettyCash->credit != NULL)
                        <td class="p" style="font-size: 14px; font-weight: 600;">
                            <i class="material-icons mr-1" style="font-size: 10px; font-weight: 600; color: red;">remove</i>
                            {{money($pettyCash->credit, "MYR")->format()}}
                            
                        </td>
                        @else
                            <td class="p" style="text-align: center;font-size: 12px; font-weight: 600;">
                                -
                            </td>
                        @endif
                        <td class="p" style="font-size: 14px; font-weight: 600;">
                            {{money($pettyCash->balance, "MYR")->format()}}
                        </td>
                        @if(!empty($pettyCash->filename))
                        <td class="p" style="text-align: center;font-size: 14px">
                            <a href="{{$pettyCash->filename}}" target="_blank">
                                View
                            </a>
                        </td>
                        @else
                        <td class="p" style="text-align: center;font-size: 12px; font-weight: 600;">
                            -
                        </td>
                        @endif
                        @if(!empty($pettyCash->remark))
                        <td class="text-muted mb-0" style="text-align: center;font-size: 14px">
                            {{$pettyCash->remark}}
                        </td>
                        @else
                        <td class="p" style="text-align: center;font-size: 12px; font-weight: 600;">
                            -
                        </td>
                        @endif
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        {{ $pettyCashs->links() }}
    </div>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">description</i>
    </div>
    <div class="row justify-content-center card-body pt-2 pb-5">
        <p class="h4">No data yet</p>
    </div>
@endif
    
    

