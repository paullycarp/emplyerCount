<?php
include_once 'config.php';
include_once 'includes/functions.php';
require_login();

$error =  $success  = null;
$firstname = $_POST['firstname'] ?? '' ;
$lastname = $_POST['lastname'] ?? '' ;
$salary = $_POST['salary'] ?? '' ;
$qualification_id = $_POST['qualification_id'] ?? 1 ;
$gender = $_POST['gender'] ?? '' ;
$date_of_birth = $_POST['date_of_birth'] ?? '' ;
$date_joined = $_POST['date_joined'] ?? '' ;
$form_url = 'add.php';

  if( isset($_POST['submit']))
  {
      $status = sql_insert("employee", [
          'firstname' => $firstname,
          'lastname' => $lastname,
          'date_of_birth' => $date_of_birth,
          'date_joined' => $date_joined,
          'gender' => $gender,
          'qualification_id' => $qualification_id,
          'salary' => $salary,
      ]);
      
      $error = $status['error'];

      if( ! $error )
      {
        $firstname = $lastname = $date_joined = $date_of_birth = '';
        $salary = 0;
        $success = true;
      }
  }
?>

<?php include_once 'includes/header.php' ?>
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

           <div class="row">
              <div class="col"> 

                 <!-- Page Heading -->
          <h1 class="h3 d-inline-block mb-4 text-gray-800">Add Employee</h1>         
              </div>
              <div class="col text-right"> 

         <a  href="list.php" class="btn btn-outline-secondary">
             <i class="fa fa-list"></i> All Employees</a>
              </div>
              
          </div>
              
<div class="row">
<div class="col-md-6 offset-md-3">
<div class="card">
<div class="card-body">
<?php if($success) {  ?>
              <div class="alert alert-success">Employee inserted successfully</div>
          <?php } ?>
          <?php include 'form.php' ; ?>
          </div>
          </div>
          </div>
          <!-- Place form Here -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php include_once 'includes/footer.php' ?>

</body>

</html>
