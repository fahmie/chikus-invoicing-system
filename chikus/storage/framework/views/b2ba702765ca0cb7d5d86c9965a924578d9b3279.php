<?php $__env->startSection('title', __('messages.invoices')); ?>
    
<?php $__env->startSection('page_header'); ?>
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.invoice')); ?></li>
                </ol>
            </nav>
            <h1 class="m-0"><?php echo e(__('messages.invoices')); ?></h1>
        </div>
        <a href="<?php echo e(route('invoices.create')); ?>" class="btn btn-success ml-3">
            <i class="material-icons">add</i> 
            <?php echo e(__('messages.create_invoice')); ?>

        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('application.invoices._filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header bg-white p-0">
            <div class="row no-gutters flex nav">
                <a href="<?php echo e(route('invoices')); ?>" class="col-2 border-right dashboard-area-tabs__tab card-body text-center <?php echo e($tab == 'drafts' ? 'active' : ''); ?>">
                    <span class="card-header__title m-0">
                        <?php echo e(__('messages.drafts')); ?>

                    </span>
                </a>
                <a href="<?php echo e(route('invoices', 'due')); ?>" class="col-2 border-right dashboard-area-tabs__tab card-body text-center <?php echo e($tab == 'due' ? 'active' : ''); ?>">
                    <span class="card-header__title m-0">
                        <?php echo e(__('messages.due_invoices')); ?>

                    </span>
                </a>
                <a href="<?php echo e(route('invoices', 'all')); ?>" class="col-2 border-right dashboard-area-tabs__tab card-body text-center <?php echo e($tab == 'all' ? 'active' : ''); ?>">
                    <span class="card-header__title m-0">
                        <?php echo e(__('messages.all_invoices')); ?>

                    </span>
                </a>
            </div>
        </div>

        <?php echo $__env->make('application.invoices._table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['page' => 'invoices'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/invoices/index.blade.php ENDPATH**/ ?>