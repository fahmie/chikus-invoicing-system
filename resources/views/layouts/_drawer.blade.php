<style>
    .footer-bottom {
        background-color: #f8f9fa;
        min-height: 30px;
        width: 100%;
        position: absolute;
        bottom: 0;
    }

    @media screen and (max-width: 414px) {
        .footer-bottom {
            display: none;
        }
    }
</style>
<div class="mdk-drawer js-mdk-drawer" id="default-drawer" data-align="start" data-position="left">
    <div class="mdk-drawer__scrim"></div>
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-left simplebar" data-simplebar="init">
            <div class="simplebar-wrapper">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset">
                        <div class="simplebar-content">

                            <div class="d-flex align-items-center sidebar-p-a border-bottom sidebar-account">
                                <a href="{{ route('settings.company') }}" class="flex d-flex align-items-center text-underline-0 text-body">
                                    <span class="avatar mr-3">
                                        <img src="{{ asset('assets/images/avatar/invoice.png') }}" alt="avatar" class="avatar-img rounded" width="22">
                                    </span>
                                    <span class="flex d-flex flex-column">
                                        <strong>Cara-Mining Invoice System</strong>
                                    </span>
                                </a>
                            </div>

                            <div class="sidebar-heading sidebar-m-t">Menu</div>
                            <ul class="sidebar-menu">
                                @if(Auth::user()->can('dashboard-view'))
                                <li class="sidebar-menu-item {{ $page == 'dashboard' ? 'active' : ''}}">
                                    <a class="sidebar-menu-button" href="{{ route('dashboard') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dashboard</i>
                                        {{-- <span class="sidebar-menu-text">{{ __('messages.dashboard') }}</span> --}}
                                        <span class="sidebar-menu-text">Home</span>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->can('invoices-view'))
                                <li class="sidebar-menu-item {{ $page == 'invoices' ? 'active' : ''}}">
                                    <a class="sidebar-menu-button" href="{{ route('invoices') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">receipt</i>
                                        <span class="sidebar-menu-text">Invoices (New Transaction)</span>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->can('delivery-order-view'))
                                <li class="sidebar-menu-item {{ $page == 'do' ? 'active' : ''}}">
                                    <a class="sidebar-menu-button" href="{{ route('do') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">description</i>
                                        <span class="sidebar-menu-text">Delivery Order</span>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->can('receipts-view'))
                                <li class="sidebar-menu-item {{ $page == 'receipts' ? 'active' : ''}}">
                                    <a class="sidebar-menu-button" href="{{ route('receipts') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">payment</i>
                                        <span class="sidebar-menu-text">Receipts</span>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->can('client-contract-view'))
                                <li class="sidebar-menu-item {{ $page == 'client' ? 'active' : ''}}">
                                    <a class="sidebar-menu-button" href="{{ route('client') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">account_box</i>
                                        {{-- <span class="sidebar-menu-text">{{ __('messages.vendors') }}</span> --}}
                                        <span class="sidebar-menu-text">Client/Contract</span>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->can('lorry-driver-view'))
                                <li class="sidebar-menu-item {{ $page == 'drivers' ? 'active' : ''}}">
                                    <a class="sidebar-menu-button" href="{{ route('driver') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">people</i>
                                        <span class="sidebar-menu-text">Lorry Driver</span>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->can('products-view'))
                                <li class="sidebar-menu-item {{ $page == 'products' ? 'active' : ''}}">
                                    <a class="sidebar-menu-button" href="{{ route('products') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">store</i>
                                        <span class="sidebar-menu-text">{{ __('messages.products') }}</span>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->can('pettycash-view'))
                                <li class="sidebar-menu-item {{ $page == 'pettycash' ? 'active' : ''}}">
                                    <a class="sidebar-menu-button" href="{{ route('pettycash') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">monetization_on</i>
                                        <span class="sidebar-menu-text">Petty Cash</span>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->can('transporter-view'))
                                <li class="sidebar-menu-item {{ $page == 'transporter' ? 'active' : ''}}">
                                    <a class="sidebar-menu-button" href="{{ route('transporter') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">contacts</i>
                                        <span class="sidebar-menu-text">Transporter</span>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->can('intransit-view'))
                                <li class="sidebar-menu-item {{ $page == 'tracking' ? 'active' : ''}}">
                                    <a class="sidebar-menu-button" href="{{ route('tracking') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">local_shipping</i>
                                        <span class="sidebar-menu-text">In Transit (OTW)</span>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->can('completed-delivery-view'))
                                <li class="sidebar-menu-item {{ $page == 'customers' ? 'active' : ''}}">
                                    <a class="sidebar-menu-button" href="{{ route('customers') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">event_available</i>
                                        <span class="sidebar-menu-text">Completed Delivery</span>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->can('supplier-view') || Auth::user()->can('product-inventory-view'))
                                <li class="sidebar-menu-item {{ $page == 'inventory_setting' ? 'active' : ''}}">
                                    <a class="sidebar-menu-button" href="{{ route('supplier.index') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons fas fa-dolly-flatbed fa-lg"></i>
                                        <span class="sidebar-menu-text">Inventory Settings</span>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->can('inventory-management-view'))
                                <li class="sidebar-menu-item {{ $page == 'inventory_management' ? 'active' : ''}}">
                                    <a class="sidebar-menu-button" href="{{ route('managements.index') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons fas fa-chart-pie fa-lg"></i>
                                        <span class="sidebar-menu-text">Inventory Managements</span>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company" || Auth::user()->roles =="admin")
                                <li class="sidebar-menu-item {{ $page == 'settings' ? 'active' : ''}}">
                                    <a class="sidebar-menu-button" href="{{ route('settings.account') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">settings</i>
                                        <span class="sidebar-menu-text">{{ __('messages.settings') }}</span>
                                    </a>
                                </li>
                                @endif

                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{ route('logout') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">lock_open</i>
                                        <span class="sidebar-menu-text">{{ __('messages.logout') }}</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="footer-bottom">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style=" color: #939FAD">
                                            Powered by © AmzarTech
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="simplebar-placeholder"></div>
            </div>
        </div>
    </div>
</div>