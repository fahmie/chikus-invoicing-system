<?php $__env->startSection('title', __('messages.customers')); ?>
    
<?php $__env->startSection('page_header'); ?>
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.customers')); ?></li>
                </ol>
            </nav>
            <h1 class="m-0"><?php echo e(__('messages.customers')); ?></h1>
        </div>
        <a href="<?php echo e(route('customers.create')); ?>" class="btn btn-success ml-3"><i class="material-icons">add</i> <?php echo e(__('messages.create_customer')); ?></a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('application.customers._filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <?php echo $__env->make('application.customers._table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['page' => 'customers'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/customers/index.blade.php ENDPATH**/ ?>