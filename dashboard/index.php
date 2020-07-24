<?php 
include "../koneksi.php";
include "../class_lib.php";
$newaksidb = new aksidatabase;
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Tweet Analyzer</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
        <img src="../assets/images/icon/logo.png" alt="logo" style="height:50px" >
        </div>
        <div class="sidebar-brand-text mx-3">Tweet Sentiment</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="../training/">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Admin Page</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

         
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Training</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Data Training</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php echo    $newaksidb -> hitung_total_datatraining($koneksi); ?> 
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Positif</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo    $newaksidb -> hitung_tweet_positif_datatraining($koneksi); ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Negatif</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                          <?php echo    $newaksidb -> hitung_tweet_negatif_datatraining($koneksi); ?>
                          </div>
                        </div>
                        <div class="col">
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Netral</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php echo    $newaksidb -> hitung_tweet_netral_datatraining($koneksi); ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tanggal Crawling Data Training</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Diagram Perbandingan Data Training</h6>
      
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Positif
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-danger"></i> Negatif
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-warning"></i>Netral
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Testing</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Borobudur</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Positif <span class="float-right"><?php echo    $newaksidb -> hitung_positif_borobudur($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $newaksidb -> hitung_positif_borobudur($koneksi); ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Negatif <span class="float-right"><?php echo    $newaksidb -> hitung_negatif_borobudur($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $newaksidb -> hitung_negatif_borobudur($koneksi); ?>%;" aria-valuenow="<?php echo    $newaksidb -> hitung_tweet_negatif_datatraining($koneksi); ?>" aria-valuemin="0" aria-valuemax="<?php echo    $newaksidb -> hitung_total_datatraining($koneksi); ?>"></div>
                  </div>
                  <h4 class="small font-weight-bold">Netral <span class="float-right"><?php echo    $newaksidb -> hitung_netral_borobudur($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo    $newaksidb -> hitung_netral_borobudur($koneksi); ?>%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Tanjung Lesung</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Positif <span class="float-right"><?php echo    $newaksidb -> hitung_positif_lesung($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $newaksidb -> hitung_positif_lesung($koneksi); ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Negatif <span class="float-right"><?php echo    $newaksidb -> hitung_negatif_lesung($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $newaksidb -> hitung_negatif_lesung($koneksi); ?>%;" aria-valuenow="<?php echo    $newaksidb -> hitung_tweet_negatif_datatraining($koneksi); ?>" aria-valuemin="0" aria-valuemax="<?php echo    $newaksidb -> hitung_total_datatraining($koneksi); ?>"></div>
                  </div>
                  <h4 class="small font-weight-bold">Netral <span class="float-right"><?php echo    $newaksidb -> hitung_netral_lesung($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo    $newaksidb -> hitung_netral_lesung($koneksi); ?>%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Danau Toba</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Positif <span class="float-right"><?php echo    $newaksidb -> hitung_positif_toba($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $newaksidb -> hitung_positif_toba($koneksi); ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Negatif <span class="float-right"><?php echo    $newaksidb -> hitung_negatif_toba($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $newaksidb -> hitung_negatif_toba($koneksi); ?>%;" aria-valuenow="<?php echo    $newaksidb -> hitung_tweet_negatif_datatraining($koneksi); ?>" aria-valuemin="0" aria-valuemax="<?php echo    $newaksidb -> hitung_total_datatraining($koneksi); ?>"></div>
                  </div>
                  <h4 class="small font-weight-bold">Netral <span class="float-right"><?php echo    $newaksidb -> hitung_netral_toba($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo    $newaksidb -> hitung_netral_toba($koneksi); ?>%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Tanjung Kelayang</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Positif <span class="float-right"><?php echo    $newaksidb -> hitung_positif_kelayang($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $newaksidb -> hitung_positif_kelayang($koneksi); ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Negatif <span class="float-right"><?php echo    $newaksidb -> hitung_negatif_kelayang($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $newaksidb -> hitung_negatif_kelayang($koneksi); ?>%;" aria-valuenow="<?php echo    $newaksidb -> hitung_tweet_negatif_datatraining($koneksi); ?>" aria-valuemin="0" aria-valuemax="<?php echo    $newaksidb -> hitung_total_datatraining($koneksi); ?>"></div>
                  </div>
                  <h4 class="small font-weight-bold">Netral <span class="float-right"><?php echo    $newaksidb -> hitung_netral_kelayang($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo    $newaksidb -> hitung_netral_kelayang($koneksi); ?>%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Mandalika</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Positif <span class="float-right"><?php echo    $newaksidb -> hitung_positif_mandalika($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $newaksidb -> hitung_positif_mandalika($koneksi); ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Negatif <span class="float-right"><?php echo    $newaksidb -> hitung_negatif_mandalika($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $newaksidb -> hitung_negatif_mandalika($koneksi); ?>%;" aria-valuenow="<?php echo    $newaksidb -> hitung_tweet_negatif_datatraining($koneksi); ?>" aria-valuemin="0" aria-valuemax="<?php echo    $newaksidb -> hitung_total_datatraining($koneksi); ?>"></div>
                  </div>
                  <h4 class="small font-weight-bold">Netral <span class="float-right"><?php echo    $newaksidb -> hitung_netral_mandalika($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo    $newaksidb -> hitung_netral_mandalika($koneksi); ?>%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Wakatobi</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Positif <span class="float-right"><?php echo    $newaksidb -> hitung_positif_wakatobi($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $newaksidb -> hitung_positif_wakatobi($koneksi); ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Negatif <span class="float-right"><?php echo    $newaksidb -> hitung_negatif_wakatobi($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $newaksidb -> hitung_negatif_wakatobi($koneksi); ?>%;" aria-valuenow="<?php echo    $newaksidb -> hitung_tweet_negatif_datatraining($koneksi); ?>" aria-valuemin="0" aria-valuemax="<?php echo    $newaksidb -> hitung_total_datatraining($koneksi); ?>"></div>
                  </div>
                  <h4 class="small font-weight-bold">Netral <span class="float-right"><?php echo    $newaksidb -> hitung_netral_wakatobi($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo    $newaksidb -> hitung_netral_wakatobi($koneksi); ?>%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Morotai</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Positif <span class="float-right"><?php echo    $newaksidb -> hitung_positif_morotai($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $newaksidb -> hitung_positif_morotai($koneksi); ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Negatif <span class="float-right"><?php echo    $newaksidb -> hitung_negatif_morotai($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $newaksidb -> hitung_negatif_morotai($koneksi); ?>%;" aria-valuenow="<?php echo    $newaksidb -> hitung_tweet_negatif_datatraining($koneksi); ?>" aria-valuemin="0" aria-valuemax="<?php echo    $newaksidb -> hitung_total_datatraining($koneksi); ?>"></div>
                  </div>
                  <h4 class="small font-weight-bold">Netral <span class="float-right"><?php echo    $newaksidb -> hitung_netral_morotai($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo    $newaksidb -> hitung_netral_morotai($koneksi); ?>%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Bromo</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Positif <span class="float-right"><?php echo    $newaksidb -> hitung_positif_bromo($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $newaksidb -> hitung_positif_bromo($koneksi); ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Negatif <span class="float-right"><?php echo    $newaksidb -> hitung_negatif_bromo($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $newaksidb -> hitung_negatif_bromo($koneksi); ?>%;" aria-valuenow="<?php echo    $newaksidb -> hitung_tweet_negatif_datatraining($koneksi); ?>" aria-valuemin="0" aria-valuemax="<?php echo    $newaksidb -> hitung_total_datatraining($koneksi); ?>"></div>
                  </div>
                  <h4 class="small font-weight-bold">Netral <span class="float-right"><?php echo    $newaksidb -> hitung_netral_bromo($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo    $newaksidb -> hitung_netral_bromo($koneksi); ?>%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-md-12 mb-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Labuan Bajo</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Positif <span class="float-right"><?php echo    $newaksidb -> hitung_positif_bajo($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $newaksidb -> hitung_positif_bajo($koneksi); ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Negatif <span class="float-right"><?php echo    $newaksidb -> hitung_negatif_bajo($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $newaksidb -> hitung_negatif_bajo($koneksi); ?>%;" aria-valuenow="<?php echo    $newaksidb -> hitung_tweet_negatif_datatraining($koneksi); ?>" aria-valuemin="0" aria-valuemax="<?php echo    $newaksidb -> hitung_total_datatraining($koneksi); ?>"></div>
                  </div>
                  <h4 class="small font-weight-bold">Netral <span class="float-right"><?php echo    $newaksidb -> hitung_netral_bajo($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo    $newaksidb -> hitung_netral_bajo($koneksi); ?>%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Kepulauan Seribu</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Positif <span class="float-right"><?php echo    $newaksidb -> hitung_positif_seribu($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $newaksidb -> hitung_positif_seribu($koneksi); ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Negatif <span class="float-right"><?php echo    $newaksidb -> hitung_negatif_seribu($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $newaksidb -> hitung_negatif_seribu($koneksi); ?>%;" aria-valuenow="<?php echo    $newaksidb -> hitung_tweet_negatif_datatraining($koneksi); ?>" aria-valuemin="0" aria-valuemax="<?php echo    $newaksidb -> hitung_total_datatraining($koneksi); ?>"></div>
                  </div>
                  <h4 class="small font-weight-bold">Netral <span class="float-right"><?php echo    $newaksidb -> hitung_netral_seribu($koneksi); ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo    $newaksidb -> hitung_netral_seribu($koneksi); ?>%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>

            </div>

            <div class="col-lg-6 mb-4">

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
