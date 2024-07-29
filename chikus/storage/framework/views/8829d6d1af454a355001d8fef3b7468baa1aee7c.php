<?php if($dueInvoices->count() > 0): ?>
    <table class="table table-striped border-bottom mb-0">
        <tbody>
            <?php $__currentLoopData = $dueInvoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <div>
                            <a href="<?php echo e(route('invoices.details', $invoice->id)); ?>" class="text-15pt d-flex align-items-center">
                                <strong><?php echo e($invoice->invoice_number); ?></strong>
                            </a>
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="<?php echo e(route('customers.details', $invoice->customer->id)); ?>">
                            <?php echo e($invoice->customer->display_name); ?>

                        </a>
                    </td>
                    <td class="text-center">
                        <?php if($invoice->status == 'DRAFT'): ?>
                            <div class="badge badge-dark">
                                <?php echo e($invoice->status); ?>

                            </div>
                        <?php elseif($invoice->status == 'SENT'): ?>
                            <div class="badge badge-info">
                                <?php echo e($invoice->status); ?>

                            </div>
                        <?php elseif($invoice->status == 'VIEWED'): ?>
                            <div class="badge badge-primary">
                                <?php echo e($invoice->status); ?>

                            </div>
                        <?php elseif($invoice->status == 'OVERDUE'): ?>
                            <div class="badge badge-danger">
                                <?php echo e($invoice->status); ?>

                            </div>
                        <?php elseif($invoice->status == 'COMPLETED'): ?>
                            <div class="badge badge-success">
                                <?php echo e($invoice->status); ?>

                            </div>
                        <?php endif; ?>
                    </td>
                    <td class="text-right">
                        <?php echo e(money($invoice->due_amount, $invoice->currency_code)); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">receipt</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4"><?php echo e(__('messages.no_due_invoices')); ?></p>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/dashboard/_due_invoices.blade.php ENDPATH**/ ?>