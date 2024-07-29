@extends('layouts.app', ['page' => 'receipts'])

@section('title', __('Receipt Details'))
 
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('receipts') }}">Receipts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Receipt Details</li>
                </ol>
            </nav>
            <h1 class="m-0">Receipt Details</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <div class="row">
        <div class="col-12 col-md-4">
            <p class="h2 pb-4">
                #{{ $invoice->receipt_number }}
            </p>
        </div>
        <div class="col-12 col-md-8 text-right">
            <div class="btn-group mb-2">
                @if (Auth::user()->can('receipts-view'))
                <a href="{{ route('pdf.invoice2', ['invoice' => $invoice->uid, 'download' => true]) }}" target="_blank" class="btn btn-light">
                    <i class="material-icons">cloud_download</i> 
                    {{ __('messages.download') }}
                </a>
                @endif
                {{-- <a href="{{ route('invoices.send', $invoice->id) }}" class="btn btn-light alert-confirm" data-alert-title="Are you sure?" data-alert-text="This action will send an email to customer.">
                    <i class="material-icons">send</i>
                    {{ __('messages.send_email') }}
                </a> --}}
                {{-- <a href="{{ route('payments.create', ['invoice' => $invoice->id]) }}" target="_blank" class="btn btn-light">
                    <i class="material-icons">payment</i> 
                    {{ __('messages.enter_payment') }}
                </a> --}}
                {{-- <a href="{{ route('invoices.editdo', $invoice->id) }}" class="btn btn-light">
                    <i class="material-icons">edit</i> 
                    {{ __('messages.edit') }}
                </a> --}}
            </div>
        </div>
        <div class="col-12">
            @if($invoice->status == 'DRAFT')
                <div class="alert alert-soft-dark d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">access_time</i>
                    <div class="text-body"><strong>{{ __('messages.status') }} : </strong> {{ __('messages.draft') }}</div>
                </div>
            @elseif($invoice->status == 'SENT')
                <div class="alert alert-soft-info d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">send</i>
                    <div class="text-body"><strong>{{ __('messages.status') }} : </strong> {{ __('messages.mailed_to_customer') }}</div>
                </div>
            @elseif($invoice->status == 'VIEWED')
                <div class="alert alert-soft-primary d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">visibility</i>
                    <div class="text-body"><strong>{{ __('messages.status') }} : </strong> {{ __('messages.viewed_by_customer') }}</div>
                </div>
            @elseif($invoice->status == 'OVERDUE')
                <div class="alert alert-soft-danger d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">schedule</i>
                    <div class="text-body"><strong>{{ __('messages.status') }} : </strong> {{ __('messages.overdue') }}</div>
                </div>
            @elseif($invoice->status == 'COMPLETED')
                <div class="alert alert-soft-success d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">done</i>
                    <div class="text-body"><strong>{{ __('messages.status') }} : </strong> {{ __('messages.payment_received') }}</div>
                </div>
            @endif
        </div>
    </div>
    <div class="pdf-iframe">
        <iframe src="{{ route('pdf.invoice2', $invoice->uid) }}" frameborder="0"></iframe>
    </div>
@endsection
