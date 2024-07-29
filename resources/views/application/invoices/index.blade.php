<style>
    .badge {
    padding: 1px 9px 2px;
    font-size: 12.025px;
    font-weight: bold;
    white-space: nowrap;
    color: #ffffff;
    background-color: #dc303078;
    -webkit-border-radius: 9px;
    -moz-border-radius: 9px;
    border-radius: 10px;
    }
    .badge:hover {
    color: #ffffff;
    text-decoration: none;
    cursor: pointer;
    }
    .badge-error {
    background-color: #b94a48;
    }
    .badge-error:hover {
    background-color: #953b39;
    }
    .badge-warning {
    background-color: #f89406;
    }
    .badge-warning:hover {
    background-color: #c67605;
    }
    .badge-success {
    background-color: #468847;
    }
    .badge-success:hover {
    background-color: #356635;
    }
    .badge-info {
    background-color: #3a87ad;
    }
    .badge-info:hover {
    background-color: #2d6987;
    }
    .badge-inverse {
    background-color: #333333;
    }
    .badge-inverse:hover {
    background-color: #1a1a1a;
    }
    @media screen and (max-width: 736px) {
        .btn{
            font-size: 12px !important;
            line-height: 1em !important;
        }
        .custom{
            font-size: 30px !important;
        }
        
        
    }
    @media screen and (max-width: 1440) {
        .size-filter{
            width: 50% !important;
        }
    }
</style>
@extends('layouts.app', ['page' => 'invoices'])

@section('title', __('messages.invoices'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.invoice') }}</li>
                </ol>
            </nav>
            <h1 class="custom m-0">{{ __('messages.invoices') }}</h1>
        </div>
        @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
        <div class="dropdown">
            <button class="btn btn-success ml-3 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">add</i> 
                Contract Buyer
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach($sites as $value)
                <a class="dropdown-item" href="{{ route('invoices.superadmincreate', $value->id)}}">{{$value->name}}</a>  
                @endforeach
            </div>
          </div>

          <div class="dropdown">
            <button class="btn btn-success ml-3 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">add</i> 
                Cash Buyer
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach($sites as $value)
                <a class="dropdown-item" href="{{ route('invoices.superadmincreatecash', $value->id)}}">{{$value->name}}</a>  
                @endforeach
            </div>
          </div>
          @else
        <a href="{{ route('invoices.create') }}" class="btn btn-success ml-3">
            <i class="material-icons">add</i> 
            Contract Buyer
        </a>
        @foreach($sites as $value)
        <a href="{{ route('invoices.superadmincreatecash', $value->id)}}" class="btn btn-success ml-3">
        @endforeach
            <i class="material-icons">add</i> 
            Cash Buyer
        </a>
        @endif
    </div>

@endsection

@section('content')
    @include('application.invoices._filters')

    <div class="card">
        <div class="card-header bg-white p-0">
            <div class="row no-gutters flex nav">
                <!-- <a href="{{ route('invoices') }}" class="col-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'drafts' ? 'active' : '' }}">
                    <span class="card-header__title m-0">
                        {{ __('messages.drafts') }}
                    </span>
                </a> -->
                <a href="{{ route('invoices', 'due') }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'due' ? 'active' : '' }}">
                    <span class="card-header__title m-0">
                        Issued
                    </span>
                </a>
                <a href="{{ route('invoices', 'all') }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'all' ? 'active' : '' }}">
                    <span class="card-header__title m-0">
                    Paid
                    <!-- <span class="badge" style="margin-left: 10px; border-radius: 10px;">1</span> -->
                    </span>
                
                    
                </a>
            </div>
        </div>

        @include('application.invoices._table')
    </div>
@endsection
