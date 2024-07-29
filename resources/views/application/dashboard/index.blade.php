<style>
    @media screen and (max-width: 736px) {
        .custom{
            margin-top:2rem;
        }  
        

     
    } 
    @media screen and (max-width: 1366px) {
        .custom{
            margin-top:2rem;
        }  

    }

    #chartdiv {
    width: 100%;
    height: 400px;
    }

    .title {
    margin: 4% 0 2.5% 0;
    }

    h1 {
    line-height: 0.25;
    margin-bottom: 0px;
    }

    .label {
    margin-bottom: 6px;
    font-size: 12px;
    font-weight: 700;
    }

    select, button {
    font-size: 15px;
    font-weight: 300;
    font-family: monospace;
    text-transform: uppercase;
    background: #fff;
    border-radius: 2px;
    width: 170px;
    margin-bottom: 3%;
    }

    select:hover, button:hover {
    background-color: #3d3d3d;
    color: #fff;
    box-shadow: 0px 2px 3px rgba(0,0,0,0.2);
    }
    .nav-tabs .nav-link.active, [dir=ltr] .nav-tabs .nav-item.show .nav-link {
        color: #308AF3;
        background-color: #eceef0 !important;
        border-color: #efefef;
    }
</style>
<?php 
    if(empty($_GET ['sites_id'])){
        $sites_id = null;
    }else{
        $sites_id = $_GET ['sites_id'];
    }
    if(empty($_GET ['month'])){
        $month = null;
    }else{
        $month = $_GET ['month'];
    }
    if(empty($_GET ['year'])){
        $year = null;
    }else{
        $year = $_GET ['year'];
    }
    if(empty($_GET ['sites'])){
        $sites1 = null;
    }else{
        $sites1 = $_GET ['sites'];
    }
    if(empty($_GET ['sites_ina'])){
        $sites_ina = null;
    }else{
        $sites_ina = $_GET ['sites_ina'];
    }
    if(empty($_GET ['sites_trip'])){
        $sites_trip = null;
    }else{
        $sites_trip = $_GET ['sites_trip'];
    }
    
?>
@extends('layouts.app', ['page' => 'dashboard'])

@section('title', __('messages.dashboard'))

@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.dashboard') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.dashboard') }}</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-6 custom">
            <!-- <div class="card" style="height:100% !important"> -->
            <div class="card" style="height: 550px !important">
                <div class="card-header card-header-large bg-white">
                    <h4 class="card-header__title">In Transit (OTW) Status</h4>
                </div>

                @include('application.dashboard._due_invoices')
                
                <div class="card-footer text-center border-0">
                    <a class="text-muted" href="{{ route('tracking') }}">{{ __('messages.view_all') }}</a>
                </div>
            </div>
        </div>
        <div class="col-xl-6 custom">
            <!-- <div class="card" style="height:100% !important"> -->
            <div class="card" style="height: 550px !important">
                <div class="card-header card-header-large bg-white">
                    <h4 class="card-header__title">Petty Cash Expenses</h4>
                </div>

                @include('application.dashboard._due_estimates')

                <div class="card-footer text-center border-0">
                    <a class="text-muted" href="{{ route('pettycash') }}">{{ __('messages.view_all') }}</a>
                </div>
            </div>
        </div>
        
    </div>
   
    <div class="card" style="margin-top:2rem;">
        <div class="card-body ">
            <h5 class="label">Sales Report</h5>
            <form class="form-inline" action="{{ route('report') }}" method="GET">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Sites</label>
                <select class="custom-select my-1 mr-sm-2" name="sites_id" id="inlineFormCustomSelectPref">
                  @foreach($sites as $key => $val)
                  <option value="{{$val->id}}" @if(isset($sites_id) && $val->id == $sites_id) selected @endif>{{$val->name}}</option>  
                  @endforeach
                </select>
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Month</label>
                <select class="custom-select my-1 mr-sm-2" name="month" id="inlineFormCustomSelectPref">
                  <option selected>Choose Date..</option>
                  <option value="1">January</option>  
                  <option value="2">February</option>  
                  <option value="3">March</option>  
                  <option value="4">April</option>  
                  <option value="5">May</option>  
                  <option value="6">June</option>  
                  <option value="7">July</option>  
                  <option value="8">August</option>  
                  <option value="9">September</option>  
                  <option value="10">Oktober</option>  
                  <option value="11">November</option>  
                  <option value="12">December</option>   
                </select>
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Year</label>
                <select class="custom-select my-1 mr-sm-2" name="year" id="inlineFormCustomSelectPref">
                  <option selected>Choose Date..</option>
                  @foreach($month_year as $key => $val)
                  <option value="{{$val->year}}" @if(isset($year) && $val->id == $year) selected @endif>{{$val->year}}</option>  
                  @endforeach
                </select>
                <button type="submit" class="btn btn-primary my-1">Export to PDF</button>
              </form>

              <form class="form-inline" action="{{ route('salegraph') }}" method="GET">
              <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Sites</label>
              <select class="custom-select my-1 mr-sm-2" name="sites" id="sites">
                @foreach($sites as $key => $val)
                <option value="{{$val->id}}"  @if(isset($sites1) && $val->id == $sites1) selected @endif>{{$val->name}}</option>  
                @endforeach
              </select>
              <button type="submit" class="btn btn-primary my-1">Filter</button>
            </form>

            <hr>
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#chartType" role="tab">Monthly</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Weekly</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Daily</a>
                </li>
            </ul><!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="chartType" role="tabpanel">
                    <canvas id="myChart" style="width: 100%;height: 400px;"></canvas>
                <!-- <div id="chartdiv"></div> -->
                </div>
                <div class="tab-pane" id="tabs-2" role="tabpanel">
                    <canvas id="week" style="width: 100%;height: 400px;"></canvas>
                </div>
                <div class="tab-pane" id="tabs-3" role="tabpanel">
                    <canvas id="daily" style="width: 100%;height: 400px;"></canvas>
                </div>
            </div>
        </div>    
    </div>
    <!-- <div class="card">
        <div class="card-header bg-white d-flex align-items-center">
            <h3 class="card-header__title mb-0 fs-1-3rem">Sales Summary Report</h3>
        </div>
        <div class="card-body">
            <div class="chart">
                <canvas id="expensesChart" class="chart-canvas chartjs-render-monitor" width="1998" height="600"></canvas>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="label">Inaccuracy Report</h5>
                    <form class="form-inline" action="{{ route('salegraph') }}" method="GET">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Sites</label>
                        <select class="custom-select my-1 mr-sm-2" name="sites_ina" id="sites_ina">
                          @foreach($sites as $key => $val)
                          <option value="{{$val->id}}"  @if(isset($sites_ina) && $val->id == $sites_ina) selected @endif>{{$val->name}}</option>  
                          @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary my-1">Filter</button>
                      </form>
          
                      <hr>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#inc" role="tab">Monthly</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#inc1" role="tab">Weekly</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#inc2" role="tab">Daily</a>
                        </li>
                    </ul><!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="inc" role="tabpanel">
                            <canvas id="monthAcc" ></canvas>
                        </div>
                        <div class="tab-pane" id="inc1" role="tabpanel">
                            <canvas id="weekAcc"></canvas>
                        </div>
                        <div class="tab-pane" id="inc2" role="tabpanel">
                            <canvas id="dailyInacc"></canvas>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="label">Quantity Trip Report</h5>
                    <form class="form-inline" action="{{ route('salegraph') }}" method="GET">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Sites</label>
                        <select class="custom-select my-1 mr-sm-2" name="sites_trip" id="sites_trip">
                          @foreach($sites as $key => $val)
                          <option value="{{$val->id}}"  @if(isset($sites_trip) && $val->id == $sites_trip) selected @endif>{{$val->name}}</option>  
                          @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary my-1">Filter</button>
                      </form>
                    <hr>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#qty" role="tab">Monthly</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#qty1" role="tab">Weekly</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#qty2" role="tab">Daily</a>
                        </li>
                    </ul><!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="qty" role="tabpanel">
                            <canvas id="monthQtys"></canvas>
                        </div>
                        <div class="tab-pane" id="qty1" role="tabpanel">
                            <canvas id="weekQtys"></canvas>
                        </div>
                        <div class="tab-pane" id="qty2" role="tabpanel">
                            <canvas id="dailyQty"></canvas>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    
@endsection

@section('page_body_scripts')
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/vendor/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/chartjs-rounded-bar.js') }}"></script>
    <script src="{{ asset('assets/js/charts.js') }}"></script>
    <script src="//www.amcharts.com/lib/4/core.js"></script>
    <script src="//www.amcharts.com/lib/4/charts.js"></script>
    <script src="//www.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="//www.amcharts.com/lib/4/themes/kelly.js"></script>
    @include('application.dashboard._chartjs')

@endsection
