// Default font
Chart.defaults.global.defaultFontFamily =
    'system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

var ctx = document.getElementById("vehicleStatusPie");

// CEK: kalau canvas tidak ada → stop
if (ctx) {

    // CEK: kalau chart sudah ada → destroy dulu
    if (window.vehicleStatusChart) {
        window.vehicleStatusChart.destroy();
    }

    window.vehicleStatusChart = new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Tersedia", "Dipakai", "Service"],
            datasets: [{
                data: [10, 8, 2],
                backgroundColor: [
                    "rgba(13,110,253,1)",
                    "rgba(255,193,7,1)",
                    "rgba(220,53,69,1)"
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutoutPercentage: 70,
            animation: {
                duration: 800   // sekali animasi saja
            },
            legend: {
                position: "bottom"
            }
        }
    });
}
