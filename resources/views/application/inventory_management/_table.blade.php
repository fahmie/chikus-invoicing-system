<style>
[data-toggle="collapse"] .fa:before {  
  content: "\f139";
}

[data-toggle="collapse"].collapsed .fa:before {
  content: "\f13a";
}
</style> 
    <div id="accordion">
        @php
            $i = 1;
        @endphp
        @foreach ($inventory as $sitesName => $item) 
        @php
        $key_supplier  = str_replace(" ","_",$sitesName);
        $url = $_SERVER['REQUEST_URI'];
        if(strpos($url , '?') !== false)
        {
            $supplier_url = explode("?", $url);
            $supplier_name = explode("=", $supplier_url[1]);
            $supplier_key = $supplier_name[0];
        }else{
            $supplier_key = "";
        }
        if(strpos($url , $key_supplier) !== false){
            $supplier_key = $key_supplier;
        }
        @endphp

        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#{{$key_supplier}}" aria-expanded="true" aria-controls="{{$key_supplier}}"><i class="fa" aria-hidden="true"></i>
                {{$sitesName}}
              </button>
            </h5>
          </div>
          @if(($i == 1)||($i != 1 && $supplier_key == $key_supplier)||($supplier_key == $key_supplier))
          <div id="{{$key_supplier}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            @else 
            <div id="{{$key_supplier}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            @endif
            <div class="card-body">
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
                              <th>Product Name</th>
                              <th><i class="material-icons icon-16pt mr-1 text-muted">add_circle</i>Stock In</th>
                              <th><i class="material-icons icon-16pt mr-1 text-muted">remove_circle</i>Stock Out</th>
                              <th><i class="material-icons icon-16pt mr-1 text-muted">account_balance_wallet</i>Balance Stock</th>
                              <th class="text-center">Attachment</th>
                              <th class="text-center">Remarks</th>
                              <th class="text-center">Customer Details</th>
                          </tr>
                      </thead>
                      <tbody class="list" id="expenses">
                          @foreach ($item as $key => $data)
                              <tr>
                                  <td class="text-muted mb-0 w-30px" style="font-size: 14px">
                                      <a>
                                      {{ $key+1 }}
                                      </a>
                                  </td>
                                  @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                                  <td class="text-muted mb-0" style="font-size: 14px">
                                    {{ $data->suppliers->name }}
                                  </td>
                                  @endif
                                  <td class="text-muted mb-0" style="font-size: 14px">
                                    {{ $data['date'] }}
                                  </td>
                                  <td class="text-muted mb-0" style="font-size: 14px">
                                    {{ $data['time'] }}
                                  </td>
                                  <td class="p" style="font-size: 14px">
                                    {{ $data->products->name }}
                                  </td>
                                  @if(!empty($data['stock_in']))
                                  <td class="p" style="font-size: 14px; font-weight: 600;">
                                  <i class="material-icons mr-1" style="font-size: 10px; font-weight: 600; color: green;">add</i>
                                  {{ $data['stock_in'] }}   
                                  </td>
                                  @else
                                  <td style="text-align: center;font-size: 12px; font-weight: 600;">
                                     - 
                                  </td>
                                  @endif
                                  @if(!empty($data['stock_out']))
                                  <td class="p" style="font-size: 14px; font-weight: 600;">
                                      <i class="material-icons mr-1" style="font-size: 10px; font-weight: 600; color: red;">remove</i>
                                      {{ $data['stock_out'] }}
                                      
                                  </td>
                                  @else
                                  <td style="text-align: center;font-size: 12px; font-weight: 600;">
                                     - 
                                  </td>
                                  @endif
                                  <td class="p" style="font-size: 14px; font-weight: 600;">
                                    {{ $data['stock'] }}
                                  </td>
                                  <td class="p" style="text-align: center;font-size: 14px">
                                      <a href="{{ $data['filename'] }}" target="_blank">
                                          View
                                      </a>
                                  </td>
                                  <td class="text-muted mb-0" style="text-align: center;font-size: 14px">
                                    {{ $data['remark'] }}
                                  </td>
                                  @if(!empty($data['stock_out']))
                                  <td class="p" style="text-align: center;font-size: 14px">
                                    <a href="{{ route('managments.show', $data['id']) }}">
                                        View
                                    </a>
                                </td>
                                @else
                                <td style="text-align: center;font-size: 12px; font-weight: 600;">
                                    - 
                                 </td>
                                @endif
                              </tr>
                              @php
                                  $i++; 
                              @endphp
                              @endforeach
                      </tbody>
                  </table>
                  <div class="row card-body pagination-light justify-content-center text-center">
                      {{ $item->links() }}
                </div>
              </div>

              {{-- <div class="row justify-content-center card-body pb-0 pt-5">
                  <i class="material-icons fs-64px">description</i>
              </div>
              <div class="row justify-content-center card-body pt-2 pb-5">
                  <p class="h4">No data yet</p>
              </div> --}}
  
            </div>
          </div>
        </div>
        @endforeach
    </div>

    
    

