<?php $__env->startSection('title', __('messages.create_customer')); ?>
    
<?php $__env->startSection('page_header'); ?>
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('customers')); ?>"><?php echo e(__('messages.customers')); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.create_customer')); ?></li>
                </ol>
            </nav>
            <h1 class="m-0"><?php echo e(__('messages.create_customer')); ?></h1>
        </div>
    </div>
<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('content'); ?> 
    <form action="<?php echo e(route('customers.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo $__env->make('layouts._form_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo csrf_field(); ?>

        <?php echo $__env->make('application.customers._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['page' => 'customers'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/customers/create.blade.php ENDPATH**/ ?>