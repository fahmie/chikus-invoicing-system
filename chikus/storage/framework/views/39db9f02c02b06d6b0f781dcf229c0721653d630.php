<div class="table-responsive mb-4" data-toggle="gateways">
    <table class="table table-xl mb-0 thead-border-top-0 table-striped">
        <thead>
            <tr>
                <th><?php echo e(__('messages.name')); ?></th> 
                <th><?php echo e(__('messages.status')); ?></th> 
                <th class="text-right"><?php echo e(__('messages.actions')); ?></th>
            </tr>
        </thead>
        <tbody class="list" id="gateways">
            <tr>
                <td class="h6">
                    <a href="<?php echo e(route('settings.payment.gateway.edit', 'paypal')); ?>">
                        <strong class="h6">
                            <?php echo e(__('messages.paypal')); ?>

                        </strong>
                    </a>
                </td>
                <td class="h6">
                    <div class="badge badge-danger fs-0-9-rem">
                        <?php echo e(__('messages.disabled')); ?>

                    </div>
                </td>
                <td class="h6 text-right">
                    <a href="<?php echo e(route('settings.payment.gateway.edit', 'paypal')); ?>" class="btn text-primary">
                        <i class="material-icons icon-16pt">edit</i>
                        <?php echo e(__('messages.edit')); ?>

                    </a>
                </td>
            </tr>
            <tr>
                <td class="h6">
                    <a href="<?php echo e(route('settings.payment.gateway.edit', 'stripe')); ?>">
                        <strong class="h6">
                            <?php echo e(__('messages.stripe')); ?>

                        </strong>
                    </a>
                </td>
                <td class="h6">
                    <div class="badge badge-danger fs-0-9-rem">
                        <?php echo e(__('messages.disabled')); ?>

                    </div>
                </td>
                <td class="h6 text-right">
                    <a href="<?php echo e(route('settings.payment.gateway.edit', 'stripe')); ?>" class="btn text-primary">
                        <i class="material-icons icon-16pt">edit</i>
                        <?php echo e(__('messages.edit')); ?>

                    </a>
                </td>
            </tr>
            <tr>
                <td class="h6">
                    <a href="<?php echo e(route('settings.payment.gateway.edit', 'razorpay')); ?>">
                        <strong class="h6">
                            <?php echo e(__('messages.razorpay')); ?>

                        </strong>
                    </a>
                </td>
                <td class="h6">
                    <div class="badge badge-danger fs-0-9-rem">
                        <?php echo e(__('messages.disabled')); ?>

                    </div>
                </td>
                <td class="h6 text-right">
                    <a href="<?php echo e(route('settings.payment.gateway.edit', 'razorpay')); ?>" class="btn text-primary">
                        <i class="material-icons icon-16pt">edit</i>
                        <?php echo e(__('messages.edit')); ?>

                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/settings/payment/gateways/_table.blade.php ENDPATH**/ ?>