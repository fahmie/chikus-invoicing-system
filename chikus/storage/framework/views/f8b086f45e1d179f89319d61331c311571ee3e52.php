<?php if($products->count() > 0): ?>
    <div class="table-responsive" data-toggle="lists">
        <table class="table mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th class="text-center w-30px"><?php echo e(__('messages.#id')); ?></th>
                    <th><?php echo e(__('messages.product')); ?></th>
                    <th><?php echo e(__('messages.unit')); ?></th>
                    <th class="text-center"><?php echo e(__('messages.price')); ?></th>
                    <th class="text-center width: 120px;"><?php echo e(__('messages.created_at')); ?></th>
                    <th class="w-50px"><?php echo e(__('messages.view')); ?></th>
                </tr>
            </thead>
            <tbody class="list" id="products">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="badge badge-light">
                                <a class="mb-0" href="<?php echo e(route('products.edit', $product->id)); ?>">
                                    #<?php echo e($product->id); ?>

                                </a>
                            </div>
                        </td>
                        <td>
                            <a  class="h6 mb-0" href="<?php echo e(route('products.edit', $product->id)); ?>">
                                <strong><?php echo e($product->name); ?></strong>
                            </a>
                        </td>
                        <td class="text-center w-80px">
                            <?php echo e($product->unit->name ?? '-'); ?>

                        </td>
                        <td class="text-center w-80px">
                            <?php echo e(money($product->price, $product->currency_code)); ?>

                        </td>
                        <td class="text-center">
                            <?php echo e($product->formatted_created_at); ?>

                        </td>
                        <td>
                            <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="btn btn-sm btn-link">
                                <i class="material-icons icon-16pt">arrow_forward</i>
                            </a> 
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        <?php echo e($products->links()); ?>

    </div>
<?php else: ?>
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">store</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4"><?php echo e(__('messages.no_products_yet')); ?></p>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/products/_table.blade.php ENDPATH**/ ?>