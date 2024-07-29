<?php if($product_units->count() > 0): ?>
    <div class="table-responsive" data-toggle="lists">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th><?php echo e(__('messages.name')); ?></th> 
                    <th class="w-30"><?php echo e(__('messages.actions')); ?></th>
                </tr>
            </thead>
            <tbody class="list" id="product_units">
                <?php $__currentLoopData = $product_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="h6">
                            <a href="<?php echo e(route('settings.product.unit.edit', $product_unit->id)); ?>">
                                <strong class="h6">
                                    <?php echo e($product_unit->name); ?>

                                </strong>
                            </a>
                        </td>
                        <td class="h6">
                            <a href="<?php echo e(route('settings.product.unit.edit', $product_unit->id)); ?>" class="btn text-primary">
                                <i class="material-icons icon-16pt">edit</i>
                                <?php echo e(__('messages.edit')); ?>

                            </a>
                            <a href="<?php echo e(route('settings.product.unit.delete', $product_unit->id)); ?>" class="btn text-danger delete-confirm">
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
        <?php echo e($product_units->links()); ?>

    </div>
<?php else: ?>
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">style</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4"><?php echo e(__('messages.no_product_units_yet')); ?></p>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/settings/product/unit/_table.blade.php ENDPATH**/ ?>