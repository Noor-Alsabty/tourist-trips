@extends('layout.app')
@section('title','dashbord')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Overview</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
      margin: 0;
      padding: 40px;
      text-align: center;
    }

    .welcome-message {
      font-size: 32px;
      color: #2c3e50;
      margin-bottom: 40px;
      margin-left: 100px;
    }

    .chart-container {
      max-width: 900px;
      margin-left: 250px;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    canvas {
      width: 100% !important;
      height: 500px !important;
    }
  </style>
</head>
<body>

  <!-- رسالة ترحيبية -->
  <div class="welcome-message">
    👋 Welcome to Your Tourism Dashboard  
    <br>
    Here’s a quick overview of your system’s performance.
  </div>

  <!-- المخطط الإحصائي -->
  <div class="chart-container">
    <canvas id="tourismChart"></canvas>
  </div>

  <script>
    const ctx = document.getElementById('tourismChart').getContext('2d');
    const tourismChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Trips', 'Bookings', 'Hotels', 'Activities', 'Users'],
        datasets: [{
          label: 'Total Count',
          data: [128, 76, 34, 22, 512],
          backgroundColor: [
            '#3498db',
            '#2ecc71',
            '#9b59b6',
            '#f39c12',
            '#e74c3c'
          ],
          borderRadius: 6
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: false
          },
          title: {
            display: true,
            text: 'System Overview',
            font: {
              size: 20
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 50
            }
          }
        }
      }
    });
  </script>

</body>
</html>
