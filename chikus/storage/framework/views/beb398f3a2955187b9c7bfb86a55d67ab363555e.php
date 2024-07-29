<?php if($estimates->count() > 0): ?>
    <div class="table-responsive">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th><?php echo e(__('messages.estimate_number')); ?></th>
                    <th><?php echo e(__('messages.date')); ?></th>
                    <th><?php echo e(__('messages.customer')); ?></th>
                    <th><?php echo e(__('messages.status')); ?></th>
                    <th><?php echo e(__('messages.total')); ?></th>
                    <th class="w-50px"><?php echo e(__('messages.view')); ?></th>
                </tr>
            </thead>
            <tbody class="list" id="estimates">
                <?php $__currentLoopData = $estimates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estimate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="h6">
                            <a href="<?php echo e(route('estimates.details', $estimate->id)); ?>">
                                <?php echo e($estimate->estimate_number); ?>

                            </a>
                        </td>
                        <td class="h6">
                            <?php echo e($estimate->formatted_estimate_date); ?>

                        </td>
                        <td class="h6">
                            <?php echo e($estimate->customer->display_name); ?>

                        </td>
                        <td class="h6">
                            <?php if($estimate->status == 'DRAFT'): ?>
                                <div class="badge badge-dark fs-0-9rem">
                                    <?php echo e($estimate->status); ?>

                                </div>
                            <?php elseif($estimate->status == 'SENT'): ?>
                                <div class="badge badge-info fs-0-9rem">
                                    <?php echo e($estimate->status); ?>

                                </div>
                            <?php elseif($estimate->status == 'VIEWED'): ?>
                                <div class="badge badge-primary fs-0-9rem">
                                    <?php echo e($estimate->status); ?>

                                </div>
                            <?php elseif($estimate->status == 'EXPIRED'): ?>
                                <div class="badge badge-danger fs-0-9rem">
                                    <?php echo e($estimate->status); ?>

                                </div>
                            <?php elseif($estimate->status == 'ACCEPTED'): ?>
                                <div class="badge badge-success fs-0-9rem">
                                    <?php echo e($estimate->status); ?>

                                </div>
                            <?php elseif($estimate->status == 'REJECTED'): ?>
                                <div class="badge badge-danger fs-0-9rem">
                                    <?php echo e($estimate->status); ?>

                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="h6">
                            <?php echo e(money($estimate->total, $estimate->currency_code)); ?>

                        </td>
                        <td class="h6">
                            <a href="<?php echo e(route('estimates.details', $estimate->id)); ?>" class="btn btn-sm btn-link">
                                <i class="material-icons icon-16pt">arrow_forward</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        <?php echo e($estimates->links()); ?>

    </div>
<?php else: ?>
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">description</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4"><?php echo e(__('messages.no_estimates_yet')); ?></p>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/estimates/_table.blade.php ENDPATH**/ ?>