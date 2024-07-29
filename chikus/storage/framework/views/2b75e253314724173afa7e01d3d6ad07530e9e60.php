<?php $__env->startSection('title', __('messages.expense_categories')); ?>
    
<?php $__env->startSection('content'); ?>
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item"><?php echo e(__('messages.settings')); ?></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.expense_categories')); ?></li>
            </ol>
        </nav>
        <h1 class="m-0"><?php echo e(__('messages.expense_categories')); ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?php echo $__env->make('application.settings._aside', ['tab' => 'expense_categories'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-lg-9">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">

                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <p class="h4 mb-0">
                                    <strong class="headings-color"><?php echo e(__('messages.expense_categories')); ?></strong>
                                </p>
                            </div>
                            <div class="col-auto">
                                <a href="<?php echo e(route('settings.expense_categories.create')); ?>" class="btn btn-primary text-white">
                                    <?php echo e(__('messages.add_expense_category')); ?>

                                </a>
                            </div>
                        </div>

                        <?php if($expense_categories->count() > 0): ?>
                            <div class="table-responsive" data-toggle="lists">
                                <table class="table table-xl mb-0 thead-border-top-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('messages.name')); ?></th> 
                                            <th><?php echo e(__('messages.description')); ?></th> 
                                            <th class="w-30"><?php echo e(__('messages.actions')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="expense_categories">
                                        <?php $__currentLoopData = $expense_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="h6">
                                                    <a href="<?php echo e(route('settings.expense_categories.edit', $expense_category->id)); ?>">
                                                        <strong class="h6">
                                                            <?php echo e($expense_category->name); ?>

                                                        </strong>
                                                    </a>
                                                </td>
                                                <td class="h6">
                                                    <?php echo e($expense_category->description ?? '-'); ?>

                                                </td>
                                                <td class="h6">
                                                    <a href="<?php echo e(route('settings.expense_categories.edit', $expense_category->id)); ?>" class="btn text-primary">
                                                        <i class="material-icons icon-16pt">edit</i>
                                                        <?php echo e(__('messages.edit')); ?>

                                                    </a>
                                                    <a href="<?php echo e(route('settings.expense_categories.delete', $expense_category->id)); ?>" class="btn text-danger delete-confirm">
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
                                <?php echo e($expense_categories->links()); ?>

                            </div>
                        <?php else: ?>
                            <div class="row justify-content-center card-body pb-0 pt-5">
                                <i class="material-icons fs-64px">account_balance_wallet</i>
                            </div>
                            <div class="row justify-content-center card-body pb-5">
                                <p class="h4"><?php echo e(__('messages.no_expense_categories')); ?></p>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', ['page' => 'settings'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/settings/expense_category/index.blade.php ENDPATH**/ ?>