<?php if($dueEstimates->count() > 0): ?>
    <table class="table table-striped border-bottom mb-0">
        <tbody>
            <?php $__currentLoopData = $dueEstimates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estimate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <div>
                            <a href="<?php echo e(route('estimates.details', $estimate->id)); ?>" class="text-15pt d-flex align-items-center">
                                <strong><?php echo e($estimate->estimate_number); ?></strong>
                            </a>
                        </div>
                    </td> 
                    <td class="text-center">
                        <a href="<?php echo e(route('estimates.details', $estimate->customer->id)); ?>">
                            <?php echo e($estimate->customer->display_name); ?>

                        </a>
                    </td>
                    <td class="text-center">
                        <?php if($estimate->status == 'DRAFT'): ?>
                            <div class="badge badge-dark"><?php echo e($estimate->status); ?></div>
                        <?php elseif($estimate->status == 'SENT'): ?>
                            <div class="badge badge-info"><?php echo e($estimate->status); ?></div>
                        <?php elseif($estimate->status == 'VIEWED'): ?>
                            <div class="badge badge-primary"><?php echo e($estimate->status); ?></div>
                        <?php elseif($estimate->status == 'EXPIRED'): ?>
                            <div class="badge badge-danger"><?php echo e($estimate->status); ?></div>
                        <?php elseif($estimate->status == 'ACCEPTED'): ?>
                            <div class="badge badge-success"><?php echo e($estimate->status); ?></div>
                        <?php elseif($estimate->status == 'REJECTED'): ?>
                            <div class="badge badge-danger"><?php echo e($estimate->status); ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="text-right">
                        <?php echo e(money($estimate->total, $estimate->currency_code)); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">description</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4"><?php echo e(__('messages.no_due_estimates')); ?></p>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/dashboard/_due_estimates.blade.php ENDPATH**/ ?>