<?php if($payment_types->count() > 0): ?>
    <div class="table-responsive" data-toggle="lists">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th><?php echo e(__('messages.name')); ?></th> 
                    <th class="w-30"><?php echo e(__('messages.actions')); ?></th>
                </tr>
            </thead>
            <tbody class="list" id="payment_types">
                <?php $__currentLoopData = $payment_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="h6">
                            <a href="<?php echo e(route('settings.payment.type.edit', $payment_type->id)); ?>">
                                <strong class="h6">
                                    <?php echo e($payment_type->name); ?>

                                </strong>
                            </a>
                        </td>
                        <td class="h6">
                            <a href="<?php echo e(route('settings.payment.type.edit', $payment_type->id)); ?>" class="btn text-primary">
                                <i class="material-icons icon-16pt">edit</i>
                                <?php echo e(__('messages.edit')); ?>

                            </a>
                            <a href="<?php echo e(route('settings.payment.type.delete', $payment_type->id)); ?>" class="btn text-danger delete-confirm">
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
        <?php echo e($payment_types->links()); ?>

    </div>
<?php else: ?>
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">payment</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4"><?php echo e(__('messages.no_payment_types_yet')); ?></p>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/settings/payment/types/_table.blade.php ENDPATH**/ ?>