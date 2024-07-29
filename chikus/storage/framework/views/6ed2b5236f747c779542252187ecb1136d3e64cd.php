<?php $__env->startSection('title', __('messages.estimates')); ?>
    
<?php $__env->startSection('page_header'); ?>
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.estimates')); ?></li>
                </ol>
            </nav>
            <h1 class="m-0"><?php echo e(__('messages.estimates')); ?></h1>
        </div>
        <a href="<?php echo e(route('estimates.create')); ?>" class="btn btn-success ml-3">
            <i class="material-icons">add</i> 
            <?php echo e(__('messages.create_estimate')); ?>

        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('application.estimates._filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header bg-white p-0">
            <div class="row no-gutters flex nav">
                <a href="<?php echo e(route('estimates')); ?>" class="col-2 border-right dashboard-area-tabs__tab card-body text-center <?php echo e($tab == 'drafts' ? 'active' : ''); ?>">
                    <span class="card-header__title m-0">
                        <?php echo e(__('messages.drafts')); ?>

                    </span>
                </a>
                <a href="<?php echo e(route('estimates', 'sent')); ?>" class="col-2 border-right dashboard-area-tabs__tab card-body text-center <?php echo e($tab == 'sent' ? 'active' : ''); ?>">
                    <span class="card-header__title m-0">
                        <?php echo e(__('messages.sent')); ?>

                    </span>
                </a>
                <a href="<?php echo e(route('estimates', 'all')); ?>" class="col-2 border-right dashboard-area-tabs__tab card-body text-center <?php echo e($tab == 'all' ? 'active' : ''); ?>">
                    <span class="card-header__title m-0">
                        <?php echo e(__('messages.all')); ?>

                    </span>
                </a>
            </div>
        </div>

        <?php echo $__env->make('application.estimates._table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['page' => 'estimates'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/estimates/index.blade.php ENDPATH**/ ?>