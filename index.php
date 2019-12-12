<?php
include_once 'config.php';
include_once 'includes/functions.php';
require_login();
$male_count = sql_fetch_one( "SELECT COUNT(*) as total FROM employee where gender = 'Male' ");
$female_count = sql_fetch_one("SELECT COUNT(*) as total FROM employee where gender = 'Female' ");

$categories = [
  [
    'label' => 'Male',
    'backgroundColor' => "#4e73df",
    'hoverBackgroundColor' => "#2e59d9",
    'borderColor' => "#4e73df"
  ],
  [
    'label' => 'Female',
    'backgroundColor' => "#ccc",
    'hoverBackgroundColor' =>"#2e59d9",
    'borderColor' => "#4e73df"
  ]
];
$rows = get_employees();
$chart_data = group_employee_chart_data($categories, $rows);

include_once 'includes/header.php' ?>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

  <?php include_once 'includes/sidebar.php' ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <?php include_once 'includes/topbar.php' ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
           <!-- Content Row -->
           <div class="row">

<div class="col-md-12">

<!-- Donut Chart -->
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Stats</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-pie pt-4">
        <canvas id="salaryBarChart"></canvas>
      </div>
      </div>
  </div>
</div>
<div class="col-md-12">

<!-- Donut Chart -->
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Gender Stats.</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-pie pt-4">
        <canvas id="genderPieChart"></canvas>
      </div>
      </div>
  </div>
</div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Dman 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php include_once 'includes/footer.php' ?>
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-bar-demo.js"></script>
  <script>
      
// Salary Bar Chart
var ctx = document.getElementById("salaryBarChart");
var salaryBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?= json_encode(array_values($chart_data['labels'])); ?>,
    datasets: <?= json_encode($chart_data['datasets'], 1); ?>,
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        // time: {
        //   unit: 'month'
        // },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 10,
          maxTicksLimit: 5,
          padding: 10,
          // // Include a dollar sign in the ticks
          // callback: function(value, index, values) {
          //   return '$' + number_format(value);
          // }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [0]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel +  ': ' +tooltipItem.yLabel;
        }
      }
    },
  }
});

</script>
<script>
 //Gender Pie Chart 
var ctx = document.getElementById("genderPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Male", "Female"],
    datasets: [{
      data: [<?= $male_count['total'] ?>, <?= $female_count['total'] ?>],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: true,
      caretPadding: 10,
    },
    legend: {
      display: true
    },
    cutoutPercentage: 80,
  },
});



</script>
</body>

</html>
