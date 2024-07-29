@if($client->count() > 0)
    <div class="table-responsive">
        <table class="table mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th class="text-center w-30px">No.</th>
                    <th>Company Name</th>
                    @if(Auth::user()->roles =="superadmin")
                    <th>Sites</th>
                    @endif
                    <th>Company No</th>
                    <th>Address</th>
                    <th>Manager Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Date Register</th>
                    <th>List Transaction</th>
                </tr>
            </thead>
            <tbody class="list" id="client">
                @foreach ($client as $k => $client)
                    <tr>
                        <td class="p" style="font-size: 14px">
                            <div class="text-muted mb-0">{{ $k+1 }}</div>
                        </td>
                        <td class="p" style="font-size: 14px">
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="material-icons icon-16pt mr-1 text-primary">business</i>
                                    <a href="{{ route('client.details', $client->id) }}">{{ $client->company_name }}</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center" style="max-width: 150px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                                <small class="text-muted">
                                    <i class="material-icons icon-16pt mr-1">pin_drop</i>
                                    Delivery Location: {{ $client->delivery_location }}
                                </small>
                            </div>
                        </td>
                        @if(Auth::user()->roles =="superadmin")
                        <td class="p" style="font-size: 14px">
                            <div class="text-muted mb-0">{{ $client->sites->name }}</div>
                        </td>
                        @endif
                        <td class="text-muted mb-0" style="font-size: 14px">
                            <div class="text-muted mb-0">{{ $client->company_no }}</div>
                        </td>
                        <td class="text-muted mb-0" style="max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                            {{ $client->address }}
                        </td>
                        <td class="text-muted mb-0" style="max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                           {{ $client->project_manager_name }}
                        </td>
                        <td class="p" style="font-size: 14px">
                            <div class="text-muted mb-0">{{ $client->phone }}</div>
                        </td>
                        <td class="p" style="font-size: 14px">
                            <div class="text-muted mb-0">{{ $client->email }}</div>
                        </td>
                        <td class="text-center text-muted mb-0" style="font-size: 14px">{{ $client->created_at->format('d/m/Y') }}</td>
                        <td class="p" style="font-size: 14px"><a href="{{ route('customers.info',['id' => $client->id, 'tab' => 'due']) }}">View All</a> </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
    
    </div>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px" >account_box</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4">No Clients yet</p>
    </div>
@endif