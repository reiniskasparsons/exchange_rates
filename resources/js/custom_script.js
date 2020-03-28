// chart colors
var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

/* large line chart */
var chLine = document.getElementById("chLine");
/*
    Gets the dates and sets them in array for labels
 */
var dates = document.getElementsByClassName("js-dates");
var datesArray = [];
for (var i = 0; i < dates.length; i++) {
    datesArray[i] = dates[i].innerHTML;
}
/*
    Gets the rates and sets them in array for data
 */
var rates = document.getElementsByClassName("js-rates");
var ratesArray = [];
for (var i = 0; i < rates.length; i++) {
    ratesArray[i] = rates[i].innerHTML;
}

var chartData = {
    labels: datesArray,
    datasets: [{
        data: ratesArray,
        backgroundColor: 'transparent',
        borderColor: colors[0],
        borderWidth: 4,
        pointBackgroundColor: colors[0]
    }
    ]
};
if (chLine) {
    new Chart(chLine, {
        type: 'line',
        data: chartData,
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false
            },
            responsive: true
        }
    });
}
