<ul class="sidebar-menu">
    @if(Auth::user()->can('supplier-view'))
    <li class="sidebar-menu-item">
        <a href="{{ route('supplier.index') }}" class="sidebar-menu-button {{ $tab == 'supplier' ? 'text-primary' : 'text-secondary' }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person</i>
            <span class="sidebar-menu-text">Supplier Settings</span>
        </a>
    </li>
    @endif
    @if(Auth::user()->can('product-inventory-view'))
    <li class="sidebar-menu-item">
        <a href="{{ route('productInventory.index') }}" class="sidebar-menu-button {{ $tab == 'products' ? 'text-primary' : 'text-secondary' }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons fas fa-boxes fa-lg"></i>
            <span class="sidebar-menu-text">Product Settings</span>
        </a>
    </li>
    @endif
</ul>