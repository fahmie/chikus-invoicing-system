<?php if($payments->count() > 0): ?>
    <div class="table-responsive">
        <table class="table mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th><?php echo e(__('messages.payment_#')); ?></th>
                    <th><?php echo e(__('messages.date')); ?></th>
                    <th><?php echo e(__('messages.customer')); ?></th>
                    <th><?php echo e(__('messages.payment_type')); ?></th>
                    <th><?php echo e(__('messages.invoice')); ?></th>
                    <th><?php echo e(__('messages.amount')); ?></th>
                    <th class="w-50px"><?php echo e(__('messages.view')); ?></th>
                </tr>
            </thead>
            <tbody class="list" id="payments">
                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <a href="<?php echo e(route('payments.edit', $payment->id)); ?>">
                                <?php echo e($payment->payment_number); ?>

                            </a>
                        </td>
                        <td>
                            <?php echo e($payment->formatted_payment_date); ?>

                        </td>
                        <td>
                            <?php echo e($payment->customer->display_name); ?>

                        </td>
                        <td>
                            <?php echo e($payment->payment_method->name ?? "-"); ?>

                        </td>
                        <td>
                            <?php echo e($payment->invoice->invoice_number ?? "-"); ?>

                        </td>
                        <td>
                            <?php echo e(money($payment->amount, $payment->currency_code)); ?>

                        </td>
                        <td>
                            <a href="<?php echo e(route('payments.edit', $payment->id)); ?>" class="btn btn-sm btn-link">
                                <i class="material-icons icon-16pt">arrow_forward</i>
                            </a> 
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        <?php echo e($payments->links()); ?>

    </div>
<?php else: ?>
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">payment</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4"><?php echo e(__('messages.no_payments_yet')); ?></p>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/payments/_table.blade.php ENDPATH**/ ?>