
const data = JSON.parse('<?php echo json_encode($data); ?>');

const humidityData = data.map(dataPoint => dataPoint.humidity);
const temperatureData = data.map(dataPoint => dataPoint.temperature);

const ctx = document.getElementById('chart-canvas').getContext('2d');
const chart = new Chart(ctx, {
  type: 'scatter',
  data: {
    labels: humidityData,
    datasets: [{
      label: 'Humidity',
      data: temperatureData,
      backgroundColor: 'rgba(255, 99, 132, 0.2)',
      borderColor: 'rgba(255, 99, 132, 1)',
    }]
  },
  options: {
    scales: {
      xAxes: [{
        type: 'linear',
        position: 'bottom',
        title: 'Humidity'
      }],
      yAxes: [{
        type: 'linear',
        position: 'left',
        title: 'Temperature'
      }]
    }
  }
});

