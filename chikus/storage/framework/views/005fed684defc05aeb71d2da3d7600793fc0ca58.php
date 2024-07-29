<?php if($invoices->count() > 0): ?>
    <div class="table-responsive">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th><?php echo e(__('messages.invoice_number')); ?></th>
                    <th><?php echo e(__('messages.date')); ?></th>
                    <th><?php echo e(__('messages.customer')); ?></th>
                    <th><?php echo e(__('messages.status')); ?></th>
                    <th><?php echo e(__('messages.paid_status')); ?></th>
                    <th><?php echo e(__('messages.amount_due')); ?></th>
                    <th class="w-50px"><?php echo e(__('messages.view')); ?></th>
                </tr>
            </thead>
            <tbody class="list" id="invoices">
                <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="h6">
                            <a href="<?php echo e(route('invoices.details', $invoice->id)); ?>">
                                <?php echo e($invoice->invoice_number); ?>

                            </a>
                        </td>
                        <td class="h6">
                            <?php echo e($invoice->formatted_invoice_date); ?>

                        </td>
                        <td class="h6">
                            <?php echo e($invoice->customer->display_name); ?>

                        </td>
                        <td class="h6">
                            <?php if($invoice->status == 'DRAFT'): ?>
                                <div class="badge badge-dark fs-0-9rem">
                                    <?php echo e($invoice->status); ?>

                                </div>
                            <?php elseif($invoice->status == 'SENT'): ?>
                                <div class="badge badge-info fs-0-9rem">
                                    <?php echo e($invoice->status); ?>

                                </div>
                            <?php elseif($invoice->status == 'VIEWED'): ?>
                                <div class="badge badge-primary fs-0-9rem">
                                    <?php echo e($invoice->status); ?>

                                </div>
                            <?php elseif($invoice->status == 'OVERDUE'): ?>
                                <div class="badge badge-danger fs-0-9rem">
                                    <?php echo e($invoice->status); ?>

                                </div>
                            <?php elseif($invoice->status == 'COMPLETED'): ?>
                                <div class="badge badge-success fs-0-9rem">
                                    <?php echo e($invoice->status); ?>

                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="h6">
                            <?php if($invoice->paid_status == 'UNPAID'): ?>
                                <div class="badge badge-warning fs-0-9rem">
                                    <?php echo e($invoice->paid_status); ?>

                                </div>
                            <?php elseif($invoice->paid_status == 'PARTIALLY_PAID'): ?>
                                <div class="badge badge-info fs-0-9rem">
                                    <?php echo e($invoice->paid_status); ?>

                                </div>
                            <?php elseif($invoice->paid_status == 'PAID'): ?>
                                <div class="badge badge-success fs-0-9rem">
                                    <?php echo e($invoice->paid_status); ?>

                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="h6">
                            <?php echo e(money($invoice->due_amount, $invoice->currency_code)); ?>

                        </td>
                        <td class="h6">
                            <a href="<?php echo e(route('invoices.details', $invoice->id)); ?>" class="btn btn-sm btn-link">
                                <i class="material-icons icon-16pt">arrow_forward</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        <?php echo e($invoices->links()); ?>

    </div>
<?php else: ?>
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">description</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4"><?php echo e(__('messages.no_invoices_yet')); ?></p>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/invoices/_table.blade.php ENDPATH**/ ?>