<?php $__env->startSection('title', __('messages.tax_types')); ?>
    
<?php $__env->startSection('content'); ?>
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item"><?php echo e(__('messages.settings')); ?></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.tax_types')); ?></li>
            </ol>
        </nav>
        <h1 class="m-0"><?php echo e(__('messages.tax_types')); ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?php echo $__env->make('application.settings._aside', ['tab' => 'tax_types'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-lg-9">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">

                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <p class="h4 mb-0">
                                    <strong class="headings-color"><?php echo e(__('messages.tax_types')); ?></strong>
                                </p>
                            </div>
                            <div class="col-auto">
                                <a href="<?php echo e(route('settings.tax_types.create')); ?>" class="btn btn-primary text-white">
                                    <?php echo e(__('messages.add_tax')); ?>

                                </a>
                            </div>
                        </div>

                        <?php if($tax_types->count() > 0): ?>
                            <div class="table-responsive" data-toggle="lists">
                                <table class="table table-xl mb-0 thead-border-top-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('messages.name')); ?></th> 
                                            <th><?php echo e(__('messages.percent')); ?></th> 
                                            <th class="w-30"><?php echo e(__('messages.actions')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="tax_types">
                                        <?php $__currentLoopData = $tax_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="h6">
                                                    <a href="<?php echo e(route('settings.tax_types.edit', $tax_type->id)); ?>">
                                                        <strong class="h6">
                                                            <?php echo e($tax_type->name); ?>

                                                        </strong>
                                                    </a>
                                                </td>
                                                <td class="h6">
                                                    <?php echo e($tax_type->percent); ?>

                                                </td>
                                                <td class="h6">
                                                    <a href="<?php echo e(route('settings.tax_types.edit', $tax_type->id)); ?>" class="btn text-primary">
                                                        <i class="material-icons icon-16pt">edit</i>
                                                        <?php echo e(__('messages.edit')); ?>

                                                    </a>
                                                    <a href="<?php echo e(route('settings.tax_types.delete', $tax_type->id)); ?>" class="btn text-danger delete-confirm">
                                                        <i class="material-icons icon-16pt">delete</i>
                                                        <?php echo e(__('messages.delete')); ?>

                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row card-body pagination-light justify-content-center text-center">
                                <?php echo e($tax_types->links()); ?>

                            </div>
                        <?php else: ?>
                            <div class="row justify-content-center card-body pb-0 pt-5">
                                <i class="material-icons fs-64px">pages</i>
                            </div>
                            <div class="row justify-content-center card-body pb-5">
                                <p class="h4"><?php echo e(__('messages.no_tax_types_yet')); ?></p>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', ['page' => 'settings'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/settings/tax_type/index.blade.php ENDPATH**/ ?>