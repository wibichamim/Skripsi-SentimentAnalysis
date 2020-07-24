<?php
include "../koneksi.php";
include "../class_lib.php";
 ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bobot Bayes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.jqueryui.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
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
                    <a href="../dashboard/"><h4>Dashboard</h4></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                   <nav>
                        <ul class="metismenu" id="menu">                            

                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Training</span></a>
                                <ul class="collapse">
                                     <li><a href="../training">Dataset</a></li></li>                                                                                   
                                     <li><a href="terms">Bobot Terms</a></li>
                                     <li><li class="active"><a href="">Bobot Bayes</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Testing
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="../testing/">Dataset</a></li>
                                    <li><a href="../testing/preprocessing">Preprocessing</a></li>
                                    <li><a href="../testing/klasifikasi">Klasifikasi</a></li>

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
                                <h4 class="header-title">Bobot Bayes</h4>

                                 <div class="justify-content-between">
                                <div class="data-tables">
                                    <table id="dataTable">
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th>NO</th>
                                                <th>Kata</th>
                                                <th>Bobot Bayes Positif</th>
                                                <th>Bobot Bayes Netral</th>
                                                <th>Bobot Bayes Negatif</th>
                                            </tr>
                                        </thead>

                        <tbody>                            
                                          
        <?php
        $nomor = 1;
        $sql = mysqli_query($koneksi,"select * from data_training_kata");
        while($data = mysqli_fetch_array($sql))
            {
        ?>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $data['nama_kata'];  ?></td>
                <td><?php echo $data['bobot_bayes_positif'];  ?></td>  
                <td><?php echo $data['bobot_bayes_netral'];  ?></td>		
                <td><?php echo $data['bobot_bayes_negatif'];  ?></td>		
            </tr>

       <?php       
            }
        ?>
                        </tbody>
                        </table>
                        </div>
                   
                    <!-- data table end -->                      
                    <div class=" pull-right"><br>
                        <a href="resetbayes"><input class="btn btn-flat btn-danger mb-3" type="button" value="Reset"></a>
                    </div>

                    <div class=" pull-right"><br>     &nbsp;                 &nbsp;                  </div>
    
                    <div class=" pull-right"><br>
                        <a href="getbayes"><input class="btn btn-flat btn-primary mb-3" type="button" value="Process"></a>
                    </div>
        </div>

        <!-- main content area end -->
        <!-- footer area start-->
       
    </div>
    <!-- page container area end -->
    <!-- jquery latest version -->
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- Start datatable js -->
    <script src="../assets/js/jquery.dataTables.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/dataTables.responsive.min.js"></script>
    <script src="../assets/js/responsive.bootstrap.min.js"></script>

    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>
