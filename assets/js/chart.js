var ctx = document.getElementById('lineChart').getContext('2d');
  
// Data for the line chart
var data = {
  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
  datasets: [
    {
      label: 'Student',
      data: [50, 70, 60, 80, 90, 70, 85],
      borderColor: '#26A69A',
      fill: false,
      tension: 0.1
    },
    {
      label: 'Teacher',
      data: [40, 60, 50, 30, 60, 90, 30],
      borderColor: '#5C6BC0',
      fill: false,
      tension: 0.1
    }
  ]
};

// Configuration options
var options = {
  responsive: true,
  plugins: {
    legend: {
      display: true,
      position: 'top'
    }
  },
  scales: {
    y: {
      beginAtZero: true
    }
  }
};

// Create the line chart
var lineChart = new Chart(ctx, {
  type: 'line',
  data: data,
  options: options
});