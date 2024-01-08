const orderChart = document.querySelector('.order-chart');
let totalOrder = $('#total_order').val();
let codOrder = $('#cod_order').val();
let razorOrder = $('#razorpay_order').val();
let cedit90DaysOrders_order = $('#cedit90DaysOrders_order').val();
const chartData = {
    labels: ['COD', '90 Days', 'Razorpay'],
    data: [codOrder,  cedit90DaysOrders_order, razorOrder],
}

new Chart(orderChart, {
    type: 'pie',
    data: {
        labels: chartData.labels,
        datasets: [
            {
                label: "Language Popularity",
                data: chartData.data
            }
        ]
    }
})

const orderStatusChart = document.querySelector('.order-status-chart');
let totalOrders = $('#totalOrders').val();
let cancelOrders = $('#cancelOrders').val();
let returnOrders = $('#returnOrders').val();
let pendingOrders = $('#pendingOrders').val();
let completedOrders = $('#completedOrders').val();
const orderchartData = {
    labels: ['Completed', 'Pending', 'Cancelled', 'Returned'],
    data: [completedOrders, pendingOrders, cancelOrders,  returnOrders],
}

new Chart(orderStatusChart, {
    type: 'doughnut',
    data: {
        labels: orderchartData.labels,
        datasets: [
            {
                label: "Language Popularity",
                data: orderchartData.data
            }
        ]
    }
})