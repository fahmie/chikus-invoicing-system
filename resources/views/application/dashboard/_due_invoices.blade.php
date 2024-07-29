@if($otws->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped border-bottom mb-0">
            <thead>
                <tr>
                    <th class="text-center">Company Name</th>
                    @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                    <th class="text-center">Site</th>
                    @endif
                    <th class="text-center">Plate No.</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">DO Number</th>
                    <th class="text-center" ><bold>Status</bold></th>
                </tr>
            </thead>
            <tbody>
                @foreach($otws as $k => $otw)
                    <tr>
                        <td class="text-center" style="max-width: 150px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                            <strong>{{$otw->clients->company_name}}</strong>
                        </td>
                        @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                        <td class="text-center" style="max-width: 150px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                            <strong>{{$otw->sites->name}}</strong>
                        </td>
                        @endif
                        <td class="text-center">
                            <div class="badge badge-dark" style= "font-size: 13px;">
                                {{$otw->platenumbers->number_plate}}
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="badge badge-warning" style= "font-size: 13px;">
                                <?php
                                $sum=0;
                                foreach($otw->items as $data)
                                {
                                    $sum+= $data->quantity;
                                }
                                echo $sum;
                                ?> Tan
                            </div>
                        </td>
                        
                        <td class="text-center">
                        <strong style= "font-size: 14px;">{{$otw->do_number}}</strong>
                        </td>
                        <td class="text-center">
                            <div class="badge badge-info" style= "font-size: 13px;">
                                {{$otw->status}}
                            </div>
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table> 
    </div>

    <div class="row card-body pagination-light justify-content-center text-center">
        {{ $otws->links() }}
    </div>
@else
    <div class="row justify-content-center pb-0" style="margin-top: 25% !important;">
        <i class="material-icons fs-64px">local_shipping</i>
    </div>
    <div class="row justify-content-center card-body pt-4 pb-5">
        <p class="h4">No Lorry In Transit</p>
    </div>
@endif
