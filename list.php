<?php 

include_once 'config.php';
include_once 'includes/functions.php';
require_login();
$message = null;

//implment delete

if(isset($_POST['delete_btn']))
{
  $delete_id = $_POST['employee_id'] ?? '';
  $status = sql_delete('employee', [
    'id' => $delete_id
  ]);
  if( ! $status['error'])
  {
    $message = 'Employee deleted successfully!';
  }
}
$employees = get_employees();

?>

<?php  include_once 'includes/header.php' ?>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

  <?php include_once 'includes/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <?php include_once 'includes/topbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

        <?php if($message) {  ?>
              <div class="alert alert-success"><?= $message ?></div>
          <?php } ?>
          <div class="row">
              <div class="col"> 
        
                 <!-- Page Heading -->
          <h1 class="h3 d-inline-block mb-4 text-gray-800">Add Employee</h1>         
              </div>
              <div class="col text-right"> 

         <a  href="add.php" class="btn btn-outline-secondary">
             <i class="fa fa-plus"></i> Add Employee</a>
              </div>
              
          </div>

          <?php include_once 'employee_table.php' ?>
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
