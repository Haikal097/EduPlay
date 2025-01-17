<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EduPlay</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      min-height: 100vh; /* Ensure body takes at least the full height of the viewport */
      background-color: rgb(233, 233, 233) !important; /* Fallback background color */
      background-image: url('{{ asset('images/blue_bg.svg') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      overflow-x: hidden;
    }

    /* Adjusting the navbar spacing */
    nav {
      margin-bottom: 0; /* Remove any margin from navbar */
    }

    .rectangle-box {
      width: 1500px; /* Prevent the box from getting too wide */
      height: 300px;
      background-color: rgba(0, 0, 0, 0.6);
      border: 1px solid rgb(0, 0, 0);
      padding: 20px;
      margin: 0 auto; /* Remove margin at the top to remove the space between navbar */
      border-radius: 15px;
      position: relative;

      /* Flexbox centering */
      display: flex;
      justify-content: center; /* Centers content horizontally */
      align-items: center; /* Centers content vertically */
    }

    /* Darken image class */
    .darkened-image {
      filter: brightness(50%);
    }

    /* Container Row */
    .new-container-row {
      display: flex;
      width: 1500px; /* Same width as rectangle-box */
      margin: 20px auto; /* Center containers */
    }

    /* Left container - 30% width */
    .container-left {
      width: 30%; /* 30% of the total width */
      height: 520px;
      background-color: rgba(0, 0, 0, 0.6);
      border-radius: 15px;
      margin-right: 20px; /* Space between left and right container */
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column; /* Ensures text and chart stack vertically */
    }
    .container-left canvas {
    display: block; /* Ensures the canvas respects its container dimensions */
  }

    /* Right container wrapper to stack two containers vertically */
    .container-right-wrapper {
      width: 70%; /* Right side takes 70% of the total width */
      display: flex;
      flex-direction: column; /* Stack containers vertically */
    }

    /* Right top container - 50% of the right side */
    .container-right-top {
      height: 50%; /* Takes up 50% of the right container */
      background-color: rgba(0, 0, 0, 0.6);
      border-radius: 15px;
      margin-bottom: 10px; /* Space between top and bottom container */
    }

    /* Right bottom container - 50% of the right side */
    .container-right-bottom {
      height: 50%; /* Takes up 50% of the right container */
      background-color: rgba(0, 0, 0, 0.6);
      border-radius: 15px;
    }

    .container-left p,
    .container-right-top p,
    .container-right-bottom p {
      color: white;
      font-size: 1.25rem;
      padding: 10px;
    }
  </style>
</head>

<body>
  @include('mainpage.nav')

  <div class="rectangle-box mt-4 mb-1 text-center" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
    <!-- Website Icon -->
    <img src="{{ asset('images/eduplay_logowhite.svg') }}" alt="EduPlay Logo" width="130" height="130" class="mb-3">

    <!-- Welcome Message -->
    <h1 class="lead" style="font-size: 3rem; color: white;"><strong>Welcome to EduPlay</strong></h1>

    <!-- Catchy Phrase -->
    <p class="lead" style="font-size: 1.5rem; color: white;">Your one-stop gaming and education platform</p>
  </div>

  <!-- New Containers Row -->
  <div class="new-container-row">
  <!-- Left Container -->
  <div class="container-left text-white p-3">
    <p class="text-center" style="font-size: 2rem;"><strong>Total Contents: {{$totalGames+$totalNotes}}</strong></p>
    <!-- Canvas for Doughnut Chart -->
    <canvas id="doughnutChart"></canvas>
  </div>

    <!-- Right Container Wrapper -->
    <div class="container-right-wrapper">
      <!-- Right Top Container -->
      <div class="container-right-top text-white p-3">
        <p><strong>Top Views</strong></p>
      </div>

      <!-- Right Bottom Container -->
      <div class="container-right-bottom text-white p-3">
        <p><strong>Recently Played</strong></p>
      </div>
    </div>
  </div>
  
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    
    const ctx = document.getElementById('doughnutChart').getContext('2d');
    const doughnutChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Games', 'Notes'],
        datasets: [{
          data: [{{ $totalGames }}, {{ $totalNotes }}],
          backgroundColor: ['rgba(128, 179, 255, 0.8)', 'rgba(122, 233, 255, 0.8)'],
          borderColor: ['rgba(0, 0, 0, 0.5)', 'rgba(0, 0, 0, 0.5)'], // Border colors for the segments
          borderWidth: 2 // Thickness of the border
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
            labels: {
          color: '#ffffff' // Set legend text color (e.g., white for dark backgrounds)
        }
          }
        }
      }
    });
  });
</script>
</body>

</html>
