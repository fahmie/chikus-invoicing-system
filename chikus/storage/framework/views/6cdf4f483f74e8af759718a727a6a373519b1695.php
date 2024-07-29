<?php $__env->startSection('title', __('messages.dashboard')); ?>

<?php $__env->startSection('page_header'); ?>
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.dashboard')); ?></li>
                </ol>
            </nav>
            <h1 class="m-0"><?php echo e(__('messages.dashboard')); ?></h1>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row card-group-row">
        <div class="col-lg-3 col-md-6 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="card-body-x-lg card-body d-flex flex-row align-items-center">
                    <div class="flex">
                        <a href="<?php echo e(route('customers')); ?>" class="text-decoration-none">
                            <div class="card-header__title text-muted mb-2 d-flex">
                                <?php echo e(__('messages.customers')); ?>

                            </div>
                            <span class="h4 m-0"><?php echo e($customersCount); ?></span>
                        </a>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">account_box</i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="card-body-x-lg card-body d-flex flex-row align-items-center">
                    <div class="flex">
                        <a href="<?php echo e(route('invoices')); ?>" class="text-decoration-none">
                            <div class="card-header__title text-muted mb-2 d-flex">
                                <?php echo e(__('messages.invoices')); ?>

                            </div>
                            <span class="h4 m-0"><?php echo e($invoicesCount); ?></span>
                        </a>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">receipt</i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="card-body-x-lg card-body d-flex flex-row align-items-center">
                    <div class="flex">
                        <a href="<?php echo e(route('estimates')); ?>" class="text-decoration-none">
                            <div class="card-header__title text-muted mb-2 d-flex">
                                <?php echo e(__('messages.estimates')); ?>

                            </div>
                            <span class="h4 m-0"><?php echo e($estimatesCount); ?></span>
                        </a>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">description</i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="card-body-x-lg card-body d-flex flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2 d-flex"><?php echo e(__('messages.due_amount')); ?></div>
                        <span class="h4 m-0"><?php echo e(money($totalDueAmount, $currentCompany->currency->code)); ?></span>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">monetization_on</i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white d-flex align-items-center">
            <h3 class="card-header__title mb-0 fs-1-3rem"><?php echo e(__('messages.expenses')); ?></h3>
        </div>
        <div class="card-body">
            <div class="chart">
                <canvas id="expensesChart" class="chart-canvas chartjs-render-monitor" width="1998" height="600"></canvas>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header card-header-large bg-white">
                    <h4 class="card-header__title"><?php echo e(__('messages.due_invoices')); ?></h4>
                </div>

                <?php echo $__env->make('application.dashboard._due_invoices', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
                <div class="card-footer text-center border-0">
                    <a class="text-muted" href="<?php echo e(route('invoices')); ?>"><?php echo e(__('messages.view_all')); ?></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header card-header-large bg-white">
                    <h4 class="card-header__title"><?php echo e(__('messages.due_estimates')); ?></h4>
                </div>

                <?php echo $__env->make('application.dashboard._due_estimates', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="card-footer text-center border-0">
                    <a class="text-muted" href="<?php echo e(route('estimates')); ?>"><?php echo e(__('messages.view_all')); ?></a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_body_scripts'); ?>
    <script src="<?php echo e(asset('assets/js/settings.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chartjs-rounded-bar.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/charts.js')); ?>"></script>

    <script>
        (function () {
            'use strict';
            Charts.init();

            var Orders = function Orders(id) {
                var type = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'roundedBar';
                var options = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
                options = Chart.helpers.merge({
                    barRoundness: 1.2,
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function callback(a) {
                                    return a.toLocaleString("en-US", {style:"currency", currency: "<?php echo e($currency_code); ?>"});
                                }
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function label(a, e) {
                                var t = e.datasets[a.datasetIndex].label || "",
                                    o = a.yLabel,
                                    r = "",
                                    val = o.toLocaleString("en-US", {style:"currency", currency: "<?php echo e($currency_code); ?>"});
                                return 1 < e.datasets.length && (r += '<span class="popover-body-label mr-auto">' + t + "</span>"), r += '<span class="popover-body-value">' + val + "</span>";
                            }
                        }
                    }
                }, options);
                var data = {
                    labels: <?php echo json_encode($expense_stats_label, 15, 512) ?>,
                    datasets: [{
                        label: "Expenses",
                        data: <?php echo json_encode($expense_stats, 15, 512) ?>
                    }]
                };
                Charts.create(id, type, options, data);
            };
            Orders('#expensesChart');
        })();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['page' => 'dashboard'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/dashboard/index.blade.php ENDPATH**/ ?>