<?php $__env->startSection('title', __('messages.expenses')); ?>
    
<?php $__env->startSection('page_header'); ?>
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.expenses')); ?></li>
                </ol>
            </nav>
            <h1 class="m-0"><?php echo e(__('messages.expenses')); ?></h1>
        </div>
        <a href="<?php echo e(route('expenses.create')); ?>" class="btn btn-success ml-3">
            <i class="material-icons">add</i> 
            <?php echo e(__('messages.create_expense')); ?>

        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('application.expenses._filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <?php echo $__env->make('application.expenses._table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['page' => 'expenses'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/expenses/index.blade.php ENDPATH**/ ?>