<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.4.95/css/materialdesignicons.css">
<style>
    ul.about {
        list-style: none;
        color: black;
        padding: 0;
    }
    li.about-items {
        margin: 10px;
        font-size: 14px;
        text-transform: uppercase;
        /* font-family: sans-serif; */
        /* font-weight: 400; */
    }
    li.about-items i {
    color:#607d8b;
    }
    span.about-item-name {
        width: 174px;
        display: inline-flex;
        margin-left: 10px;
    }
    span.about-item-detail {
        display: inline-flex;
        /* width: calc(100% - 160px); */
        width: calc(100% - 213px);
        margin-left: 10px;
    }
</style>
@extends('layouts.app', ['page' => 'drivers'])

@section('title', __('messages.customer_details'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('driver') }}">Lorry Driver</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lorry Driver Details</li>
                </ol>
            </nav>
            <h1 class="m-0">Lorry Driver Details</h1>
        </div>
    </div>
@endsection
 
@section('content')
<div class="row">
    <div class="col-12 mb-3">
        <div class="float-right">
            <a href="{{ route('driver.edit', $drivers->id) }}" class="btn btn-primary">
                <i class="material-icons">edit</i> 
                {{ __('messages.edit') }}
            </a>
        @if (Auth::user()->roles =="superadmin")
            <a href="{{ route('driver.delete', $drivers->id) }}" class="btn btn-danger delete-confirm">
                <i class="material-icons">delete</i> 
                {{ __('messages.delete') }}
            </a>
        @endif
        </div>
    </div>
</div>
<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Driver details</strong></p>
            <p class="text-muted">Basic driver information</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
        
            <ul class="about">
                <li class="about-items"><i class="mdi mdi-account icon-sm "></i><span class="about-item-name">Driver Name:</span><span class="about-item-detail">{{ $drivers->name }}</span></li>
                <li class="about-items"><i class="mdi mdi-office-building icon-sm "></i><span class="about-item-name">IC Number:</span><span class="about-item-detail">{{ $drivers->ic }}</span> </li>
                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i><span class="about-item-name">No Phone:</span><span class="about-item-detail">{{ $drivers->phone }}</span></li>
                <li class="about-items"><i class="mdi mdi-account-tie icon-sm "></i><span class="about-item-name">Plate Number:</span><span class="about-item-detail">                       
                        @php
                        $plate = array();
                        foreach($drivers->platenumbers as $key => $value){
                                $plate[] = $value->number_plate;
                        }
                        echo implode(',', $plate);
                        @endphp
                    </span></li>
                <li class="about-items"><i class="mdi mdi-phone icon-sm "></i><span class="about-item-name">Lorry Type:</span><span class="about-item-detail">
                @php
                $plate = array();
                foreach($drivers->driverLorryType as $key => $value){
                        $plate[] = $value->name;
                }
                echo implode(',', $plate);
                @endphp
                </span></li>
                <li class="about-items"><i class="mdi mdi-mail-ru icon-sm "></i><span class="about-item-name">Remark:</span><span class="about-item-detail">{{ $drivers->remark }}</span></li>   
            </ul>
            
        </div>
    </div>
</div>
    
@endsection
