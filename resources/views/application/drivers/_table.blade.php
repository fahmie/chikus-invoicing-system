@if($drivers->count() > 0)
    <div class="table-responsive">
        <table class="table mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th class="text-center w-30px">No.</th>
                    @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                    <th>Sites</th>
                    @endif
                    <th>Driver Name</th>
                    <th>IC Number</th>
                    <th>No Phone</th>
                    <th>Plate Number</th>
                    <th>Lorry Type</th>
                    <th>Registered Date</th>
                    <th>Remarks</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="list" id="customers">
                @foreach ($drivers as $k => $driver)
                    <tr>
                        <td style="font-size: 14px">
                            <div class="text-muted mb-0">{{ $k+1 }}</div>
                        </td>
                        @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                        <td class="p" style="font-size: 14px">
                            <div class="text-muted mb-0">{{ $driver->sites->name }}</div>
                        </td>
                        @endif
                        <td style="max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                            <i class="material-icons icon-16pt mr-1 mb-1 text-muted">person</i>
                            <a href="{{ route('driver.details', $driver->id) }}">{{ $driver->name }}</a>
                        </td>
                        <td style="font-size: 14px">
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="material-icons icon-16pt mr-1 text-muted">person</i>
                                    <p class="text-muted mb-0">{{ $driver->ic }}</p>
                                </div>
                            </div>     
                        </td>
                        <td>
                            <div class="text-muted mb-0">{{ $driver->phone }}</div>
                        </td>
                        <td class="text-muted mb-0" style="max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                            @php
                            $plate = array();
                            foreach($driver->platenumbers as $key => $value){
                                    $plate[] = $value->number_plate;
                            }
                            echo implode(', ', $plate);
                            @endphp
                        </td>
                        <td class="text-muted mb-0" style="max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                        @php
                        $plate2 = array();
                        foreach($driver->driverLorryType as $value2){
                                $plate2[] = $value2->name;
                        }
                        echo implode(', ', $plate2);
                        @endphp
                        </td>
                        <td class="text-muted mb-0" style="font-size: 14px">{{ $driver->created_at->format('d-m-Y') }}</td>

                        <td class="text-muted mb-0" style="max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                            <a class="text-muted" style="">{{ $driver->remark }}</a>
                        </td>
                        <td class="text-left" style="font-size: 14px">
                        @foreach($driver->invoices as $value)
                                @if($value->status == 'OTW')
                                <a href="{{ route('driver.tracking',  $driver->id) }}">
                                Tracking
                                </a>
                                @endif
                        @endforeach
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        {{ $drivers->links() }}
    </div>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">local_shipping</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4">No Lorry Drivers yet</p>
    </div>
@endif