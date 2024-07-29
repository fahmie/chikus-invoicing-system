<script>



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        var randomScalingFactor = function() {
            return (Math.random() > 0.5 ? 1.0 : 1.0) * Math.round(Math.random() * 100);
        };
        //MONTLY
        
        // Define data set for all charts
        Chart.defaults.global.elements.line.fill = true;
        //monthly sales report
        let dataSale = [{{$tot_sales_rm_all}}];
        let dataSaleCon = [{{$tot_sales_rm_con}}];
        let dataSaleCas = [{{$tot_sales_rm_cash}}];
        let dataSale1= [{{$tot_sales_mt_all}}];
        let dataSaleCon1 = [{{$total_sales_con_mt}}];
        let dataSaleCas1 = [{{$total_sales_cash_mt}}];
        
        myData = {
            labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
            datasets: [
            {
                
                label: "Total Sales (RM)",
                fill: false,
                backgroundColor: 'rgb(243,195,0, 0.40)',
                borderColor: 'rgba(255, 99, 132, 0.25)',
                data: dataSale,
                yAxisID: "y-axis-0",
            },
            {
                label: "Sales Contract (RM)",
                fill: false,
                backgroundColor: 'rgb(155,172,102, 0.40)',
                borderColor: 'rgb(155,172,102, 0.40)',
                data: dataSaleCon,
                yAxisID: "y-axis-0",

            },
            {
                label: "Sales Cash (RM)",
                fill: false,
                backgroundColor: 'rgb(190, 99, 255, 0.25)',
                borderColor: 'rgb(190, 99, 255, 0.25)',
                data: dataSaleCas,
                yAxisID: "y-axis-0",

            },
            {
                type: 'line',
                label: "Total Tan (MT)",
                fill: false,
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: dataSale1,
                yAxisID: "y-axis-1",
            },
            {
                type: 'line',
                label: "Tan Contract (MT)",
                fill: false,
                backgroundColor: 'rgb(63,185,180)',
                borderColor: 'rgb(63,185,180)',
                data: dataSaleCon1,
                yAxisID: "y-axis-1",
            },
            {
                type: 'line',
                label: "Tan Cash (MT)",
                fill: false,
                backgroundColor: 'rgb(190, 99, 255)',
                borderColor: 'rgb(190, 99, 255)',
                yAxisID: "y-axis-1",
                data: dataSaleCas1,
            }]
        };
        var chartOptions = {
            tooltips: {
                mode: 'label'
            },
            responsive: true,
            scales: {
                xAxes: [{
                    barPercentage: 1,
                    categoryPercentage: 1.2
                }],
                yAxes: [
                    {
                        stacked: false,
                        position: "left",
                        id: "y-axis-0",
                        scaleLabel: {
                            display: true,
                            labelString: 'Total Amount (RM)'
                        }
                    }, 
                    {
                        stacked: false,
                        position: "right",
                        id: "y-axis-1",
                        scaleLabel: {
                            display: true,
                            labelString: 'Total Tan (MT)'
                        }
                    }]
            }
        };
        
        // Default chart defined with type: 'line'
        Chart.defaults.global.defaultFontFamily = "monospace";
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: myData,
            options: chartOptions
        });

        //monthly inaccuracy report
        let monthInacc= [{{$ina_monthly_rm}}];
        let monthInacc1 = [{{$ina_monthly_unit}}];
        
        myMonthInacc = {
            labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
            datasets: [
            {
                label: "Inaccuracy Amount (RM)",
                fill: false,
                backgroundColor: 'rgba(255, 99, 132, 0.25)',
                borderColor: 'rgba(255, 99, 132, 0.25)',
                data: monthInacc,
                yAxisID: "y-axis-0-ir",
            },
            {
                label: "Inaccuracy Amount (MT)",
                fill: false,
                backgroundColor: 'rgb(214,243,245)',
                borderColor: 'rgb(214,243,245)',
                data: monthInacc1,
                yAxisID: "y-axis-1-ir",
            }]
        };
        var chartOptions = {
            tooltips: {
                mode: 'label'
            },
            responsive: true,
            scales: {
                xAxes: [{
                    barPercentage: 1,
                    categoryPercentage: 1.2
                }],
                yAxes: [
                    {
                        stacked: false,
                        position: "left",
                        id: "y-axis-0-ir",
                        scaleLabel: {
                            display: true,
                            labelString: 'Total Amount (RM)'
                        }
                    }, 
                    {
                        stacked: false,
                        position: "right",
                        id: "y-axis-1-ir",
                        scaleLabel: {
                            display: true,
                            labelString: 'Total Tan (MT)'
                        }
                    }]
            }
        };
        var ctx = document.getElementById('monthAcc').getContext('2d');
        var monthAcc = new Chart(ctx, {
            type: 'bar',
            data: myMonthInacc,
            options: chartOptions
        });

        //monthly qty trip report
        let monthQty= [{{$tr_monthly_all}}];
        let monthQty1 = [{{$tr_monthly_contract}}];
        let monthQty2 = [{{$tr_monthly_cash}}];
        
        myMonthQty = {
            labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
            datasets: [
            {
                label: "Total Trip",
                fill: false,
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: monthQty,
                yAxisID: "y-axis-0-qt",
            },
            {
                label: "Total Trip Contract",
                fill: false,
                backgroundColor: 'rgb(63,185,180)',
                borderColor: 'rgb(63,185,180)',
                data: monthQty1,
                yAxisID: "y-axis-0-qt",
            },
            {
                label: "Total Trip Cash",
                fill: false,
                backgroundColor: 'rgb(190, 99, 255)',
                borderColor: 'rgb(190, 99, 255)',
                data: monthQty2,
                yAxisID: "y-axis-0-qt",
            }]
        };
        var chartOptions = {
            tooltips: {
                mode: 'label'
            },
            responsive: true,
            scales: {
                xAxes: [{
                    barPercentage: 1,
                    categoryPercentage: 0.6
                }],
                yAxes: [
                    {
                        stacked: false,
                        position: "left",
                        id: "y-axis-0-qt",
                        scaleLabel: {
                            display: true,
                            labelString: 'Quantity Trip'
                        }
                    }]
            }
        };
        var ctx = document.getElementById('monthQtys').getContext('2d');
        var monthQtys = new Chart(ctx, {
            type: 'line',
            data: myMonthQty,
            options: chartOptions
        });

        //WEEKLY
        
        //weekly sales report
        let weeks= [200, 300, 250, 231, 123, 475, 122];
        let week1 = [100, 150, 200, 131, 100, 400, 102];
        let week2 = [100, 150, 150, 100, 23, 75, 20];
        let week3 = [50, 40, 35, 63, 79, 45, 12];
        let week4 = [25, 30, 25, 40, 69, 40, 10];
        let week5 = [25, 10, 10, 23, 10, 5, 2];
        
        myData1 = {
            labels: ["Week 1", "Week 2", "Week 3", "Week 4", "Week 5", "Week 6", "Week 7"],
            datasets: [
            {
                
                label: "Total Sales (RM)",
                fill: false,
                backgroundColor: 'rgb(243,195,0, 0.40)',
                borderColor: 'rgba(255, 99, 132, 0.25)',
                data: weeks,
                yAxisID: "y-axis-0-w",
            },
            {
                label: "Sales Contract (RM)",
                fill: false,
                backgroundColor: 'rgb(155,172,102, 0.40)',
                borderColor: 'rgb(155,172,102, 0.40)',
                data: week1,
                yAxisID: "y-axis-0-w",
            },
            {
                label: "Sales Cash (RM)",
                fill: false,
                backgroundColor: 'rgb(190, 99, 255, 0.25)',
                borderColor: 'rgb(190, 99, 255, 0.25)',
                data: week2,
                yAxisID: "y-axis-0-w",
            },
            {
                type: 'line',
                label: "Total Tan (MT)",
                fill: false,
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: week3,
                yAxisID: "y-axis-1-w",
            },
            {
                type: 'line',
                label: "Tan Contract (MT)",
                fill: false,
                backgroundColor: 'rgb(63,185,180)',
                borderColor: 'rgb(63,185,180)',
                data: week4,
                yAxisID: "y-axis-1-w",
            },
            {
                type: 'line',
                label: "Tan Cash (MT)",
                fill: false,
                backgroundColor: 'rgb(190, 99, 255)',
                borderColor: 'rgb(190, 99, 255)',
                data: week5,
                yAxisID: "y-axis-1-w",
            }]
        };
        var chartOptions = {
            tooltips: {
                mode: 'label'
            },
            responsive: true,
            scales: {
                xAxes: [{
                    barPercentage: 1,
                    categoryPercentage: 0.6
                }],
                yAxes: [
                    {
                        stacked: false,
                        position: "left",
                        id: "y-axis-0-w",
                        scaleLabel: {
                            display: true,
                            labelString: 'Total Amount (RM)'
                        }
                    }, 
                    {
                        stacked: false,
                        position: "right",
                        id: "y-axis-1-w",
                        scaleLabel: {
                            display: true,
                            labelString: 'Total Tan (MT)'
                        }
                    }]
            }
        };
        var ctx = document.getElementById('week').getContext('2d');
        var week = new Chart(ctx, {
            type: 'bar',
            data: myData1,
            options: chartOptions
        });
        
        //weekly inaccuracy report
        let weekInacc= [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()];
        let weekInacc1 = [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()];
        
        myWeekInacc = {
            labels: ["Week 1", "Week 2", "Week 3", "Week 4", "Week 5", "Week 6", "Week 7"],
            datasets: [
            {
                label: "Inaccuracy Amount (RM)",
                fill: false,
                backgroundColor: 'rgba(255, 99, 132, 0.25)',
                borderColor: 'rgba(255, 99, 132, 0.25)',
                data: weekInacc,
                yAxisID: "y-axis-0-w-ir",
            },
            {
                label: "Inaccuracy Amount (MT)",
                fill: false,
                backgroundColor: 'rgb(214,243,245)',
                borderColor: 'rgb(63,185,180)',
                data: weekInacc1,
                yAxisID: "y-axis-1-w-ir",
            }]
        };
        var chartOptions = {
            tooltips: {
                mode: 'label'
            },
            responsive: true,
            scales: {
                xAxes: [{
                    barPercentage: 1,
                    categoryPercentage: 0.6
                }],
                yAxes: [
                    {
                        stacked: false,
                        position: "left",
                        id: "y-axis-0-w-ir",
                        scaleLabel: {
                            display: true,
                            labelString: 'Total Amount (RM)'
                        }
                    }, 
                    {
                        stacked: false,
                        position: "right",
                        id: "y-axis-1-w-ir",
                        scaleLabel: {
                            display: true,
                            labelString: 'Total Tan (MT)'
                        }
                    }]
            }
        };
        var ctx = document.getElementById('weekAcc').getContext('2d');
        var weekAcc = new Chart(ctx, {
            type: 'bar',
            data: myWeekInacc,
            options: chartOptions
        });

        //weekly qty trip report
        let weekQty= [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()];
        let weekQty1 = [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()];
        let weekQty2 = [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()];
        
        myWeekQty = {
            labels: ["Week 1", "Week 2", "Week 3", "Week 4", "Week 5", "Week 6", "Week 7"],
            datasets: [
            {
                label: "Total Sales",
                fill: false,
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: weekQty,
                yAxisID: "y-axis-0-w-qt",
            },
            {
                label: "Sales Contract",
                fill: false,
                backgroundColor: 'rgb(63,185,180)',
                borderColor: 'rgb(63,185,180)',
                data: weekQty1,
                yAxisID: "y-axis-0-w-qt",
            },
            {
                label: "Sales Cash",
                fill: false,
                backgroundColor: 'rgb(190, 99, 255)',
                borderColor: 'rgb(190, 99, 255)',
                data: weekQty2,
                yAxisID: "y-axis-0-w-qt",
            }]
        };
        var chartOptions = {
            tooltips: {
                mode: 'label'
            },
            responsive: true,
            scales: {
                xAxes: [{
                    barPercentage: 1,
                    categoryPercentage: 0.6
                }],
                yAxes: [
                    {
                        stacked: false,
                        position: "left",
                        id: "y-axis-0-w-qt",
                        scaleLabel: {
                            display: true,
                            labelString: 'Quantity Trip'
                        }
                    }]
            }
        };
        var ctx = document.getElementById('weekQtys').getContext('2d');
        var weekQtys = new Chart(ctx, {
            type: 'line',
            data: myWeekQty,
            options: chartOptions
        });

        


        //DAILY
        //daily sales report
        let day= [{{$tot_sales_rm_all_daily}}];
        let day1 = [{{$tot_sales_rm_con_daily}}];
        let day2 = [{{$tot_sales_rm_cash_daily}}];
        let day3 = [{{$tot_sales_mt_all_daily}}];
        let day4 = [{{$total_sales_con_mt_daily}}];
        let day5 = [{{$total_sales_cash_mt_daily}}];

        myDay = {
            labels: [{{ $days1 }}],
            datasets: [
            {
                
                label: "Total Sales (RM)",
                fill: false,
                backgroundColor: 'rgb(243,195,0, 0.40)',
                borderColor: 'rgba(255, 99, 132, 0.25)',
                data: day,
                yAxisID: "y-axis-0-d",
            },
            {
                label: "Sales Contract (RM)",
                fill: false,
                backgroundColor: 'rgb(155,172,102, 0.40)',
                borderColor: 'rgb(155,172,102, 0.40)',
                data: day1,
                yAxisID: "y-axis-0-d",
            },
            {
                label: "Sales Cash (RM)",
                fill: false,
                backgroundColor: 'rgb(190, 99, 255, 0.25)',
                borderColor: 'rgb(190, 99, 255, 0.25)',
                data: day2,
                yAxisID: "y-axis-0-d",
            },
            {
                type: 'line',
                label: "Total Tan (MT)",
                fill: false,
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: day3,
                yAxisID: "y-axis-1-d",
            },
            {
                type: 'line',
                label: "Tan Contract (MT)",
                fill: false,
                backgroundColor: 'rgb(63,185,180)',
                borderColor: 'rgb(63,185,180)',
                data: day4,
                yAxisID: "y-axis-1-d",
            },
            {
                type: 'line',
                label: "Tan Cash (MT)",
                fill: false,
                backgroundColor: 'rgb(190, 99, 255)',
                borderColor: 'rgb(190, 99, 255)',
                data: day5,
                yAxisID: "y-axis-1-d",
            }]
        };
        var chartOptions = {
            tooltips: {
                mode: 'label'
            },
            responsive: true,
            scales: {
                xAxes: [{
                    barPercentage: 1,
                    categoryPercentage: 1
                }],
                yAxes: [
                    {
                        stacked: false,
                        position: "left",
                        id: "y-axis-0-d",
                        scaleLabel: {
                            display: true,
                            labelString: 'Total Amount (RM)'
                        }
                    }, 
                    {
                        stacked: false,
                        position: "right",
                        id: "y-axis-1-d",
                        scaleLabel: {
                            display: true,
                            labelString: 'Total Tan (MT)'
                        }
                    }]
            }
        };
        var ctx = document.getElementById('daily').getContext('2d');
        var daily = new Chart(ctx, {
            type: 'bar',
            data: myDay,
            options: chartOptions
        });

        //daily inaccuracy report
        let dayInac = [{{$ina_daily_rm}}];
        let dayInac1 = [{{$ina_daily_unit}}];

        myDayAcc = {
            labels: [{{ $days1 }}],
            datasets: [
            {
                label: "Inaccuracy Amount (RM)",
                fill: false,
                backgroundColor: 'rgba(255, 99, 132, 0.25)',
                borderColor: 'rgba(255, 99, 132, 0.25)',
                data: dayInac,
                yAxisID: "y-axis-0-d-ir",
            },
            {
                label: "Inaccuracy Amount (MT)",
                fill: false,
                backgroundColor: 'rgb(214,243,245)',
                borderColor: 'rgb(214,243,245)',
                data: dayInac1,
                yAxisID: "y-axis-1-d-ir",
            }]
        };
        var chartOptions = {
            tooltips: {
                mode: 'label'
            },
            responsive: true,
            scales: {
                xAxes: [{
                    barPercentage: 1,
                    categoryPercentage: 1
                }],
                yAxes: [
                    {
                        stacked: false,
                        position: "left",
                        id: "y-axis-0-d-ir",
                        scaleLabel: {
                            display: true,
                            labelString: 'Total Amount (RM)'
                        }
                    }, 
                    {
                        stacked: false,
                        position: "right",
                        id: "y-axis-1-d-ir",
                        scaleLabel: {
                            display: true,
                            labelString: 'Total Tan (MT)'
                        }
                    }]
            }
        };
        var ctx = document.getElementById('dailyInacc').getContext('2d');
        var dailyInacc = new Chart(ctx, {
            type: 'bar',
            data: myDayAcc,
            options: chartOptions
        });

        //daily qty trip report
        let dayQty = [{{$tr_daily_all}}];
        let dayQty1 = [{{$tr_daily_contract}}];
        let dayQty2 = [{{$tr_daily_cash}}];

        myDayQty = {
            labels: [{{ $days1 }}],
            datasets: [
            {
                label: "Total Trip",
                fill: false,
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: dayQty,
                yAxisID: "y-axis-0-d-qt",
            },
            {
                label: "Trip Contract",
                fill: false,
                backgroundColor: 'rgb(63,185,180)',
                borderColor: 'rgb(63,185,180)',
                data: dayQty1,
                yAxisID: "y-axis-0-d-qt",
            },
            {
                label: "Trip Cash",
                fill: false,
                backgroundColor: 'rgb(190, 99, 255)',
                borderColor: 'rgb(190, 99, 255)',
                data: dayQty2,
                yAxisID: "y-axis-0-d-qt",
            }]
        };
        var chartOptions = {
            tooltips: {
                mode: 'label'
            },
            responsive: true,
            scales: {
                xAxes: [{
                    barPercentage: 1,
                    categoryPercentage: 0.6
                }],
                yAxes: [
                    {
                        stacked: false,
                        position: "left",
                        id: "y-axis-0-d-qt",
                        scaleLabel: {
                            display: true,
                            labelString: 'Quantity Trip'
                        }
                    }]
            }
        };
        var ctx = document.getElementById('dailyQty').getContext('2d');
        var dailyQty = new Chart(ctx, {
            type: 'line',
            data: myDayQty,
            options: chartOptions
        });
        


        // (function () {
        //     'use strict';
        //     Charts.init();

        //     var Orders = function Orders(id) {
        //         var type = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'roundedBar';
        //         var options = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
        //         options = Chart.helpers.merge({
        //             barRoundness: 1.2,
        //             scales: {
        //                 yAxes: [{
        //                     ticks: {
        //                         callback: function callback(a) {
        //                             return a.toLocaleString("en-US", {style:"currency", currency: "{{ $currency_code }}"});
        //                         }
        //                     }
        //                 }]
        //             },
        //             tooltips: {
        //                 callbacks: {
        //                     label: function label(a, e) {
        //                         var t = e.datasets[a.datasetIndex].label || "",
        //                             o = a.yLabel,
        //                             r = "",
        //                             val = o.toLocaleString("en-US", {style:"currency", currency: "{{ $currency_code }}"});
        //                         return 1 < e.datasets.length && (r += '<span class="popover-body-label mr-auto">' + t + "</span>"), r += '<span class="popover-body-value">' + val + "</span>";
        //                     }
        //                 }
        //             }
        //         }, options);
        //         var data = {
        //             labels: @json($expense_stats_label),
        //             datasets: [{
        //                 label: "Expenses",
        //                 data: @json($expense_stats)
        //             }]
        //         };
        //         Charts.create(id, type, options, data);
        //     };
        //     Orders('#expensesChart');
        // })();
    </script>