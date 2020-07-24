<?php include "koneksi.php";
include ("class_lib.php");
$newaksidb = new aksidatabase;

 ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Information Gain</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amcharts css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>


</head>

<body>
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="assets/images/icon/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                   <nav>
                        <ul class="metismenu" id="menu">                            
                            <li>
                                <a href="dashmin" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Training</span></a>
                                <ul class="collapse">
                                     <li><a href="training.php">Dataset</a></li></li>                                                                                   
                                     <li><li class="active"><a href="informationgain.php">Bobot Information Gain</a></li>
                                     <li><a href="bobotbayes.php">Bobot Bayes</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Testing
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="crawling.php">Crawling</a></li>
                                    <li><a href="preprocessing.php">Preprocessing</a></li>
                                    <li><a href="klasifikasi.php">Klasifikasi</a></li>
                                    <li><a href="visualisasi.php">Visualisasi</a></li>

                                </ul>
                            </li>
                           </ul></li></ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
    <!-- page title area end -->
    <div class="main-content-inner">
                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Bobot Information Gain</h4>

                                 <div class="justify-content-between">
                                <div class="data-tables">
                                    <table id="dataTable">
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th>NO</th>
                                                <th>Kata</th>
                                                <th>Bobot</th>
                                                <th>Entropy</th>
                                                <th>Frekuensi Muncul di Kalimat bersentimen Positif</th>
                                                <th>Frekuensi Muncul di Kalimat bersentimen Negatif</th>
                                                <th>Opsi</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                          
  <?php
      


    $nomor = 1;
        $sql = mysqli_query($koneksi,"select * from data_training_kata_1
            ");
        while($data = mysqli_fetch_array($sql)){

        ?>

                     <tr>
                                   <td><?php echo $nomor++; ?></td>
                                   <td><?php echo $data['nama_kata'];  ?></td>
                                   <td><?php echo $data['bobot_ig'];  ?></td>                                                                      
                                   <td><?php echo $data['entropy_kata'];  ?></td>
                                   <td><?php echo $data['fm_positif'];  ?></td>
                                   <td><?php echo $data['fm_negatif'];  ?></td>
                                   <td><a class="edit" href="dashmin.dkbm.php?id_kb=<?php echo $data['id_kb']; ?>">Delete</a> </td>
								   </td>
    
                                    </td></tr>



       <?php
                    
}
                    ?>

                                        </tbody>
                                    </table>
                                </div>
   
                    <!-- data table end -->                      
                    <div class=" pull-right"><br>
                        <a href="resetinformationgain.php"><input class="btn btn-flat btn-danger mb-3" type="button" value="Reset"></a>
                    </div>

                    <div class=" pull-right"><br>     &nbsp;                 &nbsp;                  </div>
    
                    <div class=" pull-right"><br>
                        <a href="getinformationgain.php"><input class="btn btn-flat btn-primary mb-3" type="button" value="Process"></a>
                    </div>
        </div>

        <!-- main content area end -->
        <!-- footer area start-->
       
    </div>
    <!-- page container area end -->

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

      <!-- start chart js -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>


    <script src="pie-chart.js"></script>


    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>

<?php

function reset_information_gain()
{
    echo "a";
}

?>
