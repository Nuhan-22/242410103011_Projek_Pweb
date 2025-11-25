// Ensure the Chart.js library is included
// <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

// Initialize the Chart
let visitorChart;

function initializeChart() {
    const ctx = document.getElementById('visitorChart').getContext('2d');

    visitorChart = new Chart(ctx, {
        type: 'line', // Choose chart type: 'line', 'bar', etc.
        data: {
            labels: [], // Empty labels initially (we'll populate this with days of the current month)
            datasets: [{
                label: 'Visitors',
                data: [],  // Empty data initially
                borderColor: 'rgba(75, 192, 192, 1)', // Set the line color
                fill: false // Do not fill the area under the line
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {  // For Chart.js v3+
                    title: {
                        display: true,
                        text: 'Tanggal (Day of the Month)'  // Change label to reflect the days of the month
                    }
                },
                y: {  // For Chart.js v3+
                    title: {
                        display: true,
                        text: 'Jumlah Pengunjung'  // Change label to reflect number of visitors
                    }
                }
            }
        }
    });
}

function updateChart() {
    fetch('/api/visitor-data', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            keySess: 'example-session-key',
        }),
    })
    .then(response => response.text())
    .then(text => {
        // Check if response is JSON
        if (isJsonString(text)) {
            return JSON.parse(text);  // Parse JSON if it is JSON
        } else {
            renderPageToNewTab(text);  // Render in new tab and break the chain
            throw new Error('Response is not JSON');
        }
    })
    .then(data => {
        if (data && data.label && data.data) {
            if (visitorChart) {
                // Update chart labels and data
                visitorChart.data.labels = data.label;  // Labels will be the days of the month
                visitorChart.data.datasets[0].data = data.data;
                visitorChart.update();
            } else {
                console.error("visitorChart is not defined.");
            }
        } else {
            console.error("Data format is invalid:", data);
        }
    })
    .catch(error => console.error('Error fetching data:', error));
}

// Initialize chart after DOM content is loaded
document.addEventListener('DOMContentLoaded', () => {
    initializeChart();  // Initialize the chart
    updateChart();      // Fetch and update chart data
});
