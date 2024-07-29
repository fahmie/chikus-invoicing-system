@extends('layouts.app', ['page' => 'settings'])

@section('title', 'roles')
    
@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item active" aria-current="page">Role Management</li>
            </ol>
        </nav>
        <h1 class="m-0">Role Management</h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'roles'])
        </div>
        <div class="col-lg-9">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">

                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <p class="h4 mb-0">
                                    <strong class="headings-color">Roles</strong>
                                </p>
                            </div>
                            <div class="col-auto">
                                @if(Auth::user()->can('role-create'))
                                <a href="{{ route('settings.role.create') }}" class="btn btn-primary text-white">Add Role</a>
                                @endif
                            </div>
                        </div>

                        @if($roles->count() > 0)
                            <div class="table-responsive" data-toggle="lists">
                                <table class="table table-xl mb-0 thead-border-top-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('messages.name') }}</th> 
                                            <th>Slug</th> 
                                            <th class="w-30">{{ __('messages.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="tax_types">
                                        @foreach($roles as $role)
                                            <tr>
                                                <td class="h6">
                                                    {{ $role->name }}
                                                </td>
                                                <td class="h6">
                                                    {{ $role->slug }}
                                                </td>
                                                <td class="h6">
                                                    @if(Auth::user()->can('role-edit'))
                                                    <a href="{{ route('settings.role.edit', $role->id) }}" class="btn text-primary">
                                                        <i class="material-icons icon-16pt">edit</i>
                                                        {{ __('messages.edit') }}
                                                    </a>
                                                    @endif
                                                    @if(Auth::user()->can('role-delete'))
                                                    <a href="{{ route('settings.role.delete', $role->id) }}" class="btn text-danger delete-confirm">
                                                        <i class="material-icons icon-16pt">delete</i>
                                                        {{ __('messages.delete') }}
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row card-body pagination-light justify-content-center text-center">
                                {{ $roles->links() }}
                            </div>
                        @else
                            <div class="row justify-content-center card-body pb-0 pt-5">
                                <i class="material-icons fs-64px">pages</i>
                            </div>
                            <div class="row justify-content-center card-body pb-5">
                                <p class="h4">{{ __('messages.no_tax_types_yet') }}</p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

