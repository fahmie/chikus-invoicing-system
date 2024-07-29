<!------ Include the above in your HEAD tag ---------->
<style>
    @media screen and (max-width: 736px) {
        .custom{
            font-size: 28px !important;
        }
    }
    .pt-100{
        padding-top:100px;
    }
    .pb-100{
        padding-bottom:100px;
    }
    .section-title {
    margin-bottom: 60px;
    }
    .section-title p {
        color: #777;
        font-size: 16px;
    }
    .section-title h4 {
        text-transform: capitalize;
        font-size: 40px;
        position: relative;
        padding-bottom: 0;
        margin-bottom: 20px;
        font-weight: 600;
    }
    /* .section-title h4:before {
        position: absolute;
        content: "";
        width: 60px;
        height: 2px;
        background-color: #ff3636;
        bottom: 0;
        left: 50%;
        margin-left: -30px;
    }
    .section-title h4:after {
        position: absolute;
        background-color: #ff3636;
        content: "";
        width: 10px;
        height: 10px;
        bottom: -4px;
        left: 50%;
        margin-left: -5px;
        border-radius: 50%;
    } */
    ul.timeline-list {
        position: relative;
        margin: 0;
        padding: 0
    }
    ul.timeline-list:before {
        position: absolute;
        content: "";
        width: 2px;
        height: 100%;
        background-color: #3b5998;
        left: 50%;
        top: 0;
        -webkit-transform: translateX(-50%);
                transform: translateX(-50%);
    }
    ul.timeline-list li {
        position: relative;
        clear: both;
        display: inherit;
    }
    .timeline_content {
        
        background-color:#fff
    }
    ul.timeline-list li .timeline_content {
        width: 45%;
        color: #333;
        padding: 15px;
        float: left;
        text-align: right;
        box-shadow: 0 10px 25px 0 rgba(50, 50, 93, 0.07), 0 5px 15px 0 rgba(0, 0, 0, 0.07);
    }
    ul.timeline-list li:nth-child(2n) .timeline_content {
        float: right;
        text-align: left;
    }
    .timeline_content h4 {
        font-size: 22px;
        font-weight: 600;
        margin: 10px 0;
    }
    ul.timeline-list li:before {
        position: absolute;
        content: "";
        width: 15px;
        height: 15px;
        background-color: #3b5998;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
        border-radius: 50%;
    }
    .timeline_content span {
        font-size: 18px;
        font-weight: 500;
        font-family: poppins;
        color: #3b5998;
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





    .boxes {
        margin: auto;
        padding: 12px;
        background: transparent;
    }

    /*Checkboxes styles*/
    input[type="checkbox"] { display: none; }

    input[type="checkbox"] + label {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 20px;
    font: 14px/20px 'Open Sans', Arial, sans-serif;
    color: #000;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    }

    input[type="checkbox"] + label:last-child { margin-bottom: 0; }

    input[type="checkbox"] + label:before {
    content: '';
    display: block;
    width: 20px;
    height: 20px;
    border: 1px solid #6cc0e5;
    position: absolute;
    left: 0;
    top: 0;
    opacity: .6;
    -webkit-transition: all .12s, border-color .08s;
    transition: all .12s, border-color .08s;
    }

    input[type="checkbox"]:checked + label:before {
    width: 10px;
    top: -5px;
    left: 5px;
    border-radius: 0;
    opacity: 1;
    border-top-color: transparent;
    border-left-color: transparent;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    }
    body{
        background-color: #f3f3f3;
    
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #000;

    }
    p {
        font-size: 0.875rem;
        margin-bottom: .5rem;
        line-height: 1.3rem;
    }


    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid #e7eaed;
        border-radius: 0;
    }
    .card .card-description {
        margin-bottom: .875rem;
        font-weight: 400;
        color: #76838f;
    }






    .profile-header {
        height: 150px;
        width: 100%;
        position: relative;
    }

    .cover-image {
        height: 150px;
        width: 100%;
        overflow: hidden;
    }



    .user-image {
        position: absolute;
        height: 80px;
        width: 80px;
        border-radius: 50%;
        bottom: -50%;
        left: 50%;
        /* top: 50%; */
        transform: translate(-50%, -50%);
        z-index: 5;
    }

    .user-image img {
        height: 80px;
        width: 80px;
        border-radius: 50%;
        top: -40px;
        border: 5px solid #777;
    }

    .profile-card .profile-content {
        padding: 50px 20px 30px 20px;
    }



    .profile-card .profile-name {
        font-size: 1.2rem;
        color: #3249b9;
        font-weight: 600;
        text-align: center;
    }

    .profile-card .profile-designation {
        font-size: 13px;
        color: #777;
        text-align: center;
    }

    .profile-card .profile-description {
        padding: 10px;
        font-size: 13px;
        color: #777;
        margin: 5px 0px;
        background-color: #F1F2F3;
        border-radius: 5px;
    }

    .profile-card ul.profile-info-list {
        padding: 0;
        margin: 10px 0;
        list-style: none;
        font-size: 1rem;
        font-weight: 500;
        color: #777;
    }




    .profile-card ul.profile-info-list a {
        text-decoration: none;
        color:inherit;
    }



    .profile-card a.profile-info-list-item {
        margin: 10px 0;
        padding:15px;
        background-color: #F1F2F3;
        display: block;
        -webkit-transition: all .5s ease-in-out;
        -o-transition: all .5s ease-in-out;
        transition: all .5s ease-in-out;

    }

    .profile-card a.profile-info-list-item:hover {
        background-color: #9E9E9E;
        color: white;
        -webkit-transition: all .5s ease-in-out;
        -o-transition: all .5s ease-in-out;
        transition: all .5s ease-in-out;
        
    }


    .profile-card a.profile-info-list-item  i {
        padding: 10px;
        
    }

    ul.about {
        list-style: none;
        color: black;
        padding: 0;
    }
    li.about-items {
        margin: 10px;
        font-size: 0.9rem;
        /* font-family: sans-serif; */
        /* font-weight: 400; */
    }



    li.about-items i {
    color:#607d8b;
    }

    span.about-item-name {
        width: 100px;
        display: inline-flex;
            margin-left: 10px;
    }


    span.about-item-detail {
        display: inline-flex;
        width: calc(100% - 160px);
    }
    span.about-item-detail > button{
    margin-right: 10px;
    }

    .btn.btn-icon {
        width: 40px;
        height: 40px;
        padding: 0;
    }
    .btn.btn-rounded {
        border-radius: 50px;
    }

    a.about-item-edit {
        float: right;
    }
    ul.timeline {
        list-style-type: none;
        position: relative;
    }
    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }
    ul.timeline > li {
        margin: 20px 0;
        padding-left: 20px;
    }
    ul.timeline > li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }

</style>
@extends('layouts.app', ['page' => 'inventory_management'])

@section('title', __('Inventory Management'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('Inventory Management')}}</li>
                </ol>
            </nav>
            <h1 class="custom m-0">{{__('Inventory Management')}}</h1>
        </div>
        <a href="{{ route('managements.create') }}" class="btn btn-success ml-3">
            <i class="material-icons fas fa-plus fa-xs"></i> 
            {{__('Add Stock')}}
        </a>
        <a href="{{ route('managements.stockout') }}" class="btn btn-primary ml-3">
            <i class="material-icons fas fa-minus fa-xs"></i> 
            {{__('Deduct Stock')}}
        </a>
    </div>
@endsection

@section('content')

    @include('application.inventory_management._filters')

    @include('application.inventory_management._export')
       
    @include('application.inventory_management._table')

    

@endsection
