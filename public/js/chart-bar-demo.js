// Default font family & color (Bootstrap style)
Chart.defaults.global.defaultFontFamily =
    'system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

// Format angka
function number_format(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Bar Chart - Pemakaian Kendaraan
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
        datasets: [{
            label: "Jumlah Pemakaian Kendaraan",
            backgroundColor: "rgba(13, 110, 253, 0.8)",   // Biru
            hoverBackgroundColor: "rgba(13, 110, 253, 1)",
            borderColor: "rgba(13, 110, 253, 1)",
            data: [12, 18, 15, 22, 17, 25],
            maxBarThickness: 30
        }]
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 10,
                top: 20,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 6
                }
            }],
            yAxes: [{
                ticks: {
                    min: 0,
                    maxTicksLimit: 5,
                    padding: 10,
                    callback: function(value) {
                        return number_format(value);
                    }
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }]
        },
        legend: {
            display: false
        },
        tooltips: {
            titleMarginBottom: 10,
            titleFontColor: "#6e707e",
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem) {
                    return "Pemakaian: " + number_format(tooltipItem.yLabel);
                }
            }
        }
    }
});
