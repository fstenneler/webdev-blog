<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Backoffice d'administration du blog WebDev.fr">
  <meta name="author" content="Fabien Stenneler">
  <meta name="robots" content="noindex,nofollow"/>

  <title>Admin WebDev.fr</title>

  <!-- Custom fonts for this template-->
  <link href="../public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../public/admin/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../public/admin/vendor/jquery.datatables/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="../public/admin/css/custom.css" rel="stylesheet">
  <link href="../public/admin/vendor/jquery.richtext/jquery.richtext.min.css" rel="stylesheet">

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="../public/admin/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../public/admin/favicon.ico" type="image/x-icon">
 
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?= $this->app()->getContent('navbar'); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?= $this->app()->getContent('topbar'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <?= $this->app()->getContent($this->app()->getPageName()); ?>
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

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= $this->app()->route()->setUrl(array('logout' => 'true')); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../public/admin/vendor/jquery/jquery.min.js"></script>
  <script src="../public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../public/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../public/admin/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../public/admin/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../public/admin/vendor/jquery.dataTables/js/jquery.dataTables.min.js"></script>
  <script src="../public/admin/vendor/jquery.richtext/jquery.richtext.js"></script>
  <script src="../public/admin/js/custom.js"></script>


</body>

</html>
