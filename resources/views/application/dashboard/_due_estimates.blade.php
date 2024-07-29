@if($pettyCash->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped border-bottom mb-0">
            <thead>
                    <tr>
                        <th class="text-center">Date</th>
                        @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                        <th class="text-center">Site</th>
                        @endif
                        <th class="text-center">Details</th>
                        <th class="text-center">Debit</th>
                        <th class="text-center">Credit</th>
                        <th class="text-center">Balance</th>
                    </tr>
                </thead>
                <tbody class="list" id="expenses">
                    @foreach($pettyCash as $k => $pettyCash)
                        <tr>
                            
                            <td class="text-center">
                                <strong style= "font-size: 14px;">{{date('d/m/Y', strtotime($pettyCash->date))}}</strong>
                            </td>
                            @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                            <td class="text-center" style="max-width: 150px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                                <strong>{{$pettyCash->sites->name}}</strong>
                            </td>
                            @endif
                            <td class="text-center" style="max-width: 100px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                            <strong>{{$pettyCash->detail}}</strong>
                            </td>
                            <td class="text-center">
                                    @if($pettyCash->debit != NULL)
                                <div class="badge badge-success" style= "font-size: 13px;">
                                    {{ money($pettyCash->debit, "MYR") }}
                                    @else
                                <div >
                                    - 
                                </div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                @if($pettyCash->credit != NULL)
                                <div class="badge badge-danger" style= "font-size: 13px;">
                                    {{ money($pettyCash->credit, "MYR") }}
                                </div>
                                @else
                                <div >
                                - 
                                </div>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="badge badge-primary" style= "font-size: 13px;">
                                    {{ money($pettyCash->balance, "MYR") }}
                                </div>
                            </td>
                            
                            
                        </tr>
                        @endforeach
                </tbody>
        </table>
    </div>
    <div class="row justify-content-center card-body pb-0 pt-5">
        <!-- <i class="material-icons fs-64px">local_shipping</i> -->
    </div>
@else
    <div class="row justify-content-center pb-0" style="margin-top: 25% !important;">
        <i class="material-icons fs-64px">monetization_on</i>
    </div>
    <div class="row justify-content-center card-body pt-4 pb-5">
        <p class="h4">No Petty Cash Record</p>
    </div>
@endif
    