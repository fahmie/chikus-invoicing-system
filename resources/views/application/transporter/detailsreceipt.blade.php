@extends('layouts.app', ['page' => 'transporter'])

@section('title', __('Transporter Details'))
 
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('transporter') }}">Transporter</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Receipt Transporter Details</li>
                </ol>
            </nav>
            <h1 class="m-0">Receipt Transporter Details</h1>
        </div>
    </div>
@endsection
@if($receipttransporter->count() > 0)
@section('content') 
    <div class="row">
        <div class="col-12 col-md-4">
            <p class="h2 pb-4">
                #{{$receipttransporter->receipt_number_transporter}}
            </p>
        </div>
    </div>
    <div class="pdf-iframe">
        <iframe src="{{ route('pdf.receipts_transporter', $receipttransporter->reference_number) }}" frameborder="0"></iframe>
    </div>
@endsection
@endif
