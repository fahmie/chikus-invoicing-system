<?php if($expenses->count() > 0): ?>
    <div class="table-responsive">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th class="text-center w-30px"><?php echo e(__('messages.#id')); ?></th>
                    <th><?php echo e(__('messages.category')); ?></th>
                    <th><?php echo e(__('messages.date')); ?></th>
                    <th><?php echo e(__('messages.note')); ?></th>
                    <th><?php echo e(__('messages.amount')); ?></th>
                    <th class="w-50px"><?php echo e(__('messages.view')); ?></th>
                </tr>
            </thead>
            <tbody class="list" id="expenses">
                <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="h6">
                            <a href="<?php echo e(route('expenses.edit', $expense->id)); ?>">
                                #<?php echo e($expense->id); ?>

                            </a>
                        </td>
                        <td class="h6">
                            <a href="<?php echo e(route('expenses.edit', $expense->id)); ?>">
                                <strong class="h6">
                                    <?php echo e($expense->category->name ?? '-'); ?>

                                </strong>
                            </a>
                        </td>
                        <td class="h6">
                            <?php echo e($expense->formatted_expense_date); ?> 
                        </td>
                        <td class="h6 d-inline-block text-truncate maxw-13rem">
                            <?php echo e($expense->notes ?? '-'); ?>

                        </td>
                        <td class="h6">
                            <?php echo e(money($expense->amount, $expense->currency_code)); ?>

                        </td>
                        <td class="h6">
                            <a href="<?php echo e(route('expenses.edit', $expense->id)); ?>" class="btn btn-sm btn-link">
                                <i class="material-icons icon-16pt">arrow_forward</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        <?php echo e($expenses->links()); ?>

    </div>
<?php else: ?>
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">monetization_on</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4"><?php echo e(__('messages.no_expenses_yet')); ?></p>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/expenses/_table.blade.php ENDPATH**/ ?>