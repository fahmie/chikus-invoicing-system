@extends('layouts.app', ['page' => 'do'])

@section('title', __('Delivery Order Details'))
 
@section('page_header')
    @if(Auth::user()->roles !="client")
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('do') }}">Delivery Order</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Delivery Order Details</li>
                </ol>
            </nav>
            <h1 class="m-0">Delivery Order Arrived</h1>
        </div>
    </div>
    @endif
@endsection
 
@section('content') 
    <div class="row">
        <div class="col-12 col-md-4 mt-3">
            <p class="h2 pb-4">
                #{{ $invoice->do_number }}
            </p>
        </div>
        <div class="col-12 col-md-8 text-right">
            <div class="btn-group mb-2">
                @if (Auth::user()->can('delivery-order-view'))
                <a href="{{ route('pdf.invoice1', ['invoice' => $invoice->uid, 'download' => true]) }}" target="_blank" class="btn btn-light">
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
                {{-- <div class="btn-group">
                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        {{ __('messages.more') }} <span class="caret"></span> 
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('invoices.mark', ['invoice' => $invoice->id, 'status' => 'paid']) }}" class="dropdown-item">{{ __('messages.mark_paid') }}</a>
                        <a href="{{ route('invoices.mark', ['invoice' => $invoice->id, 'status' => 'sent']) }}" class="dropdown-item">{{ __('messages.mark_sent') }}</a>
                        <hr>
                        <a href="{{ route('invoices.delete', $invoice->id) }}" class="dropdown-item text-danger delete-confirm">{{ __('messages.delete') }}</a>
                    </div>
                </div> --}}
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
        <iframe src="{{ route('pdf.do', $invoice->uid) }}" frameborder="0"></iframe>
    </div>
@endsection
