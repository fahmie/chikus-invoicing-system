<style>
    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        overflow-x: hidden;
        scroll-behavior: smooth;
        text-align: center;
    }
    .custom-navbar {
        position: -webkit-sticky;
        position: sticky;
        top: -1px;
        width: 100%;
        height: auto;
        padding: 0px 10px;
        z-index: 9;
        background-color: transparent;
    }
    .custom-navbar li{
        text-decoration: none;
        list-style: none;
        padding: 12px 0px;
        display:inline-block;
        list-style-type: none;
        letter-spacing: 1.2px;
    }
    .custom-navbar li a{
        color: #000;
        font-size: 14px;
        padding: 9px 5px;
        border-radius: 4px 4px;
    }
    .custom-navbar li a:hover{
        color: #404040;
        text-decoration: none;
        cursor: pointer;
        background-color: rgba(0,0,0,0.1111);
        -webkit-box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
    }
    .custom-navbar li a:focus, .custom-navbar li a.focus, .custom-navbar li a.active, .custom-navbar li a:active{
        color: #E4E4E4;
        text-decoration: none;
        cursor: pointer;
        background-color: rgba(0,0,0,0.8);
        -webkit-box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
    }
    .custom-navbar li img{
        width: 30px;
        height: 30px;
    }

    .titletip {
    position: relative;
    display: inline-block;
    }

    .titletip .textTop {
    visibility: hidden;
    min-width: 120px;
    max-width: 150px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 5px;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
    }

    .titletip .textTop::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
    }

    .titletip .textBottom {
    visibility: hidden;
    min-width: 120px;
    max-width: 150px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 5px;
    position: absolute;
    z-index: 1;
    top: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
    }

    .titletip .textBottom::after {
    content: " ";
    position: absolute;
    bottom: 100%;  /* At the top of the tooltip */
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent transparent black transparent;
    }

    .titletip:hover .textTop, .titletip:hover .textBottom {
    visibility: visible;
    opacity: 0.85;
    }
    /* Blink for Webkit and others
    (Chrome, Safari, Firefox, IE, ...)
    */

    @-webkit-keyframes blinker {
    from {opacity: 1.0;}
    to {opacity: 0.0;}
    }
    .blink{
        text-decoration: blink;
        -webkit-animation-name: blinker;
        -webkit-animation-duration: 0.8s;
        -webkit-animation-iteration-count:infinite;
        -webkit-animation-timing-function:ease-in-out;
        -webkit-animation-direction: alternate;
    }
    .modal {
        text-align: center;
    }

    @media screen and (min-width: 768px) { 
    .modal:before {
        display: inline-block;
        vertical-align: middle;
        content: " ";
        height: 100%;
    }
    }

    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
    }
    @import url(https://fonts.googleapis.com/css?family=Open+Sans);
    
</style>
@extends('layouts.app', ['page' => 'transporter'])

@section('title', __('Transporter'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('client') }}">Transporter</a></li>
                </ol>
            </nav>
            <h1 class="m-0">Transporter</h1>
        </div>
        <a href="{{ route('transporter.create') }}" class="btn btn-success ml-3"><i class="material-icons">add</i> Add Transporter</a>
    </div>
@endsection
@section('content')
@include('application.transporter._filters')

<div class="card">
        
@if($transporter->count() > 0)    
    <div class="table-responsive">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th class="text-center w-30px">ID</th>
                    <th>Company Name</th>
                    @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
                    <th>Sites</th>
                    @endif
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Remarks</th>
                    <th>List Trip</th>
                </tr>
            </thead>
            <tbody class="list" id="expenses">
            @foreach($transporter as $key => $transport)
                    <tr>
                        <td class="text-muted mb-0 text-center w-30px" style="font-size: 14px">
                            <a>
                                {{$key+1}}
                            </a>
                        </td>
                        <td class="p" style="font-size: 14px">
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="material-icons icon-16pt mr-1 text-primary">business</i>
                                    <a href="{{ route('transporter.details', $transport->id) }}">{{$transport->company_name}}</a>
                                </div>
                            </div>
                        </td>
                        <td class="text-muted mb-0" style="max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                            {{$transport->sites->name}}
                        </td>
                        <td class="text-muted mb-0" style="max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                        {{$transport->name}}
                        </td>
                        <td class="text-muted mb-0" style="max-width: 30px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 14px;">
                        {{$transport->address}}
                        </td>
                        <td class="text-muted mb-0" style="font-size: 14px">
                        {{$transport->phone}}
                        </td>
                        <td class="text-muted mb-0" style="font-size: 14px">
                        {{$transport->email}}
                        </td>
                        <td class="text-muted mb-0" style="font-size: 14px">
                        {{$transport->remark}}
                        </td>
                        <td class="p" style="font-size: 14px"><a href="{{ route('transporter.show',['id' => $transport->id, 'tab' => 'due']) }}">View All</a> </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
    </div>
    @else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">description</i>
    </div>
    <div class="row justify-content-center card-body pt-2 pb-5">
        <p class="h4">No data yet</p>
    </div>
@endif
    </div>

@endsection

 

