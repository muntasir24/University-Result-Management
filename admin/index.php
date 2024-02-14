 <!-- 
session_start();
if (isset($_SESSION['username'])) { -->



  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('includes/styles.php'); ?>
    <title> Admin Dashboard | <?php echo $varsity_name; ?></title>




  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Navbar -->
      <?php include('includes/notifications.php'); ?>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->

      <?php include('includes/sidebar.php'); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-8">
                <h1 class="m-0">Quick Links </h1>




              </div><!-- /.col -->
              <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <?php include 'includes/home_infos.php'; ?>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
              <!-- Left col -->
              <section class="col-lg-12 connectedSortable">
                <div class="card">
                  <div class="card-header">
            will work
                  </div>
                  <div class="card-body">
                    <div id="chart">

                    </div>
                  </div>
                </div>


              </section>
              <!-- /.Left col -->
              <!-- right col (We are only adding the ID to make the widgets sortable)-->

              <!-- right col -->
            </div>
            <!-- /.row (main row) -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <?php include 'includes/footer.php'; ?>

      
