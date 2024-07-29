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
                                <a href="<?php echo e(route('settings.company')); ?>" class="flex d-flex align-items-center text-underline-0 text-body">
                                    <span class="avatar mr-3">
                                        <img src="<?php echo e($currentCompany->avatar); ?>" alt="avatar" class="avatar-img rounded">
                                    </span>
                                    <span class="flex d-flex flex-column">
                                        <strong><?php echo e($currentCompany->name); ?></strong>
                                    </span>
                                </a>
                            </div>

                            <div class="sidebar-heading sidebar-m-t">Menu</div>
                            <ul class="sidebar-menu">
                                <li class="sidebar-menu-item <?php echo e($page == 'dashboard' ? 'active' : ''); ?>">
                                    <a class="sidebar-menu-button" href="<?php echo e(route('dashboard')); ?>">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dashboard</i>
                                        <span class="sidebar-menu-text"><?php echo e(__('messages.dashboard')); ?></span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item <?php echo e($page == 'customers' ? 'active' : ''); ?>">
                                    <a class="sidebar-menu-button" href="<?php echo e(route('customers')); ?>">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">account_box</i>
                                        <span class="sidebar-menu-text"><?php echo e(__('messages.customers')); ?></span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item <?php echo e($page == 'products' ? 'active' : ''); ?>">
                                    <a class="sidebar-menu-button" href="<?php echo e(route('products')); ?>">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">store</i>
                                        <span class="sidebar-menu-text"><?php echo e(__('messages.products')); ?></span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item <?php echo e($page == 'invoices' ? 'active' : ''); ?>">
                                    <a class="sidebar-menu-button" href="<?php echo e(route('invoices')); ?>">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">receipt</i>
                                        <span class="sidebar-menu-text"><?php echo e(__('messages.invoices')); ?></span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item <?php echo e($page == 'estimates' ? 'active' : ''); ?>">
                                    <a class="sidebar-menu-button" href="<?php echo e(route('estimates')); ?>">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">description</i>
                                        <span class="sidebar-menu-text"><?php echo e(__('messages.estimates')); ?></span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item <?php echo e($page == 'payments' ? 'active' : ''); ?>">
                                    <a class="sidebar-menu-button" href="<?php echo e(route('payments')); ?>">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">payment</i>
                                        <span class="sidebar-menu-text"><?php echo e(__('messages.payments')); ?></span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item <?php echo e($page == 'expenses' ? 'active' : ''); ?>">
                                    <a class="sidebar-menu-button" href="<?php echo e(route('expenses')); ?>">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">monetization_on</i>
                                        <span class="sidebar-menu-text"><?php echo e(__('messages.expenses')); ?></span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item <?php echo e($page == 'vendors' ? 'active' : ''); ?>">
                                    <a class="sidebar-menu-button" href="<?php echo e(route('vendors')); ?>">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">local_shipping</i>
                                        <span class="sidebar-menu-text"><?php echo e(__('messages.vendors')); ?></span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item <?php echo e($page == 'settings' ? 'active' : ''); ?>">
                                    <a class="sidebar-menu-button" href="<?php echo e(route('settings.account')); ?>">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">settings</i>
                                        <span class="sidebar-menu-text"><?php echo e(__('messages.settings')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder"></div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\chikus\resources\views/layouts/_drawer.blade.php ENDPATH**/ ?>