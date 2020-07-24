<?php 
include "../koneksi.php";
include "../class_lib.php";
$newaksidb = new aksidatabase;
$newprepro = new preprocessing;
 ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Data Testing - Preprocessing</title>

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

                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Training</span></a>
                                <ul class="collapse">
                                     <li><a href="../training/">Dataset</a></li></li>                                                                           
                                     <li><a href="../training/terms">Bobot Terms</a></li>
                                     <li><a href="../training/bayes">Bobot Bayes</a></li>
                                </ul>
                            </li>
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Testing
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="../testing">Crawling</a></li>
                                    <li><li class="active"><a href="preprocessing">Preprocessing</a></li>
                                    <li><a href="klasifikasi">Klasifikasi</a></li>

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
                                <h4 class="header-title">Dataset Testing - Hasil Preprocessing</h4>

                                 <div class="justify-content-between">
                                <div class="data-tables">
                                    <table id="dataTable">
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th>NO</th>
                                                <th>Tweet</th>
                                                <th>Preprocessing</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                          
  <?php
        $nomor = 1;
        $sql = mysqli_query($koneksi,"SELECT * FROM `data_testing`");
        while($data = mysqli_fetch_array($sql))
        {
        ?>

            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $data['tweet_text']; ?></td>
                <td><?php echo $data['tweet_preprocessing'];  ?></td>
            </tr>

       <?php         
        }
        ?>


                                        </tbody>
                                    </table>
                                </div>
                    
                    <form action="" method="POST">
                        <!-- data table end -->                      
                        <div class=" pull-right"><br>
                        <input class="btn btn-flat btn-danger mb-3" name="reset" type="submit" value="Reset">
                        </div>

                        <div class=" pull-right"><br>     &nbsp;                 &nbsp;                  </div>
        
                        <div class=" pull-right"><br>
                        <input class="btn btn-flat btn-primary mb-3" name="preprocessing" type="submit" value="Process">
                        </div>
                    </form>

                </div>
        </div>

        <?php
                if(isset($_POST['preprocessing']))
                {
                    require_once '../vendor/autoload.php';
                    require_once '../koneksi.php';
                    require_once '../class_lib.php';
                     $newprepro = new preprocessing();
                    
                    
                            $sql = mysqli_query($koneksi,"select * from data_testing");
                    
                    
                            while($data = mysqli_fetch_array($sql)){
                               $id = $data['id_training'];
                     
                                 $datatweet = $data['tweet_text'];
                        
                    
                                 $emoticonconverted = $newprepro -> convert_emoticon($datatweet);
                                 $casefolded = $newprepro -> case_folding($emoticonconverted);
                                 
                                 
                                 $cleansed = $newprepro -> cleansing($casefolded);
                             
                             
                                 
                                 $negationconverted = $newprepro -> convert_negation($cleansed);
                                 
                                 
                                 $tokenized = $newprepro -> tokenizing($negationconverted);
                                $normalized = $newprepro -> normalization($tokenized);
                                 $stopwordremoved = $newprepro -> stopword_removal($normalized);
                                 
                                 $stemmed =  $newprepro -> stemming($stopwordremoved);
                                 echo $stemmed ."<br>";
                                 
                            
                                  //     mysqli_query($koneksi, 'insert into data_train_tes (tweet) values (\'' . $stemmed . '\');');    
                                     
                                     mysqli_query($koneksi, 'UPDATE `data_testing` SET `tweet_preprocessing` = (\'' . $stemmed . '\') WHERE `id_training` = (\'' . $id . '\');');   
                            
                                          //    mysqli_query($koneksi, "INSERT INTO `data_train_kata` (`nama_kata`) VALUES ".$piece."");   
                                         //    mysqli_query($koneksi, 'insert into data_preprocessing (tweet) values (\'' . $stemmed . '\');');    
                                                  
                               //    <!-- Stopword Removal / menghilangkan kata yang tidak berpengaruh dalam proses sentimen -->
                    
                      }                     echo "<meta http-equiv='refresh' content='0'>";
                }
                
                if(isset($_POST['reset']))
                {
                    $newaksidb = new aksidatabase;
                    $newaksidb-> reset_preprocessing_data_testing();
                    echo "<meta http-equiv='refresh' content='0'>";
                }
                
                ?>


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
