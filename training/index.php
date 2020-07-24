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
    <title>Data Training</title>
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
                                     <li><li class="active"><a href="">Dataset</a></li></li>                                                                           
                                     <li><a href="terms">Bobot Terms</a></li>
                                     <li><a href="bayes">Bobot Bayes</a></li>
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
                    <!-- seo fact area start -->
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-4 mt-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact sbg1">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"> Tweet Positif </div>
                                            <h2>    <?php
                                  echo    $newaksidb -> hitung_tweet_positif_datatraining($koneksi);
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-md-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact sbg2">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"> Tweet Netral </div>
                                            <h2>    <?php
                                echo      $newaksidb -> hitung_tweet_netral_datatraining($koneksi);
                                      ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mt-md-5">
                                <div class="card">
                                    <div class="seo-fact sbg3">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"> Tweet Negatif</div>
                                            <h2>    <?php
                               echo       $newaksidb -> hitung_tweet_negatif_datatraining($koneksi);
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <!-- seo fact area end -->

                      <!-- Social Campain area start -->
                      <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div id="piechart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Sentimen', 'Jumlah'],
  ['Positif', <?php   echo    $newaksidb -> hitung_tweet_positif_datatraining($koneksi); ?>],
  ['Negatif', <?php   echo    $newaksidb -> hitung_tweet_negatif_datatraining($koneksi); ?>],
  ['', 0],
  ['Netral', <?php   echo    $newaksidb -> hitung_tweet_netral_datatraining($koneksi); ?>],
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Pie Chart', 'width':350, 'height':200};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
                                          
                                          
                                          </div>
                        </div>
                    </div>
</div>
                    <!-- Social Campain area end -->


                    <!-- seo fact area end -->
            
    

                <div class="row">
                    <!-- data table start -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Dataset Training</h4>

                                 <div class="justify-content-between">
                                <div class="data-tables">
                                    <table id="dataTable">
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th>NO</th>
                                                <th>Tweet Asli</th>
                                                <th>Preprocessing</th>
                                                <th>Sentimen</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                          
  <?php
      


    $nomor = 1;
        $sql = mysqli_query($koneksi,"select * from data_training");
        while($data = mysqli_fetch_array($sql)){
            $id = $data['id_training'];
            $datatweet = $data['tweet_text'];
           // $stemmed =  $data['tweet_preprocessing'];

        ?>

                     <tr>
                                   <td><?php echo $nomor++; ?></td>
                                   <td><?php echo $data['tweet_text'];  ?></td>                                                                      

                                   <td><?php
                                        echo $data['tweet_preprocessing'];                              
                                         ?>
                                    </td>

                                    <?php
                         //           $pieces = explode(' ', $stemmed);
                           //         foreach($pieces as $piece)
                             //       mysqli_query($koneksi, 'insert into data_training_kata (nama_kata) values (\'' . $piece . '\');'); 
                                    ?>

                                   <td><?php echo $data['sentimen'];  ?></td>

								   </td>

                                                </td>
                                            </tr>

       <?php
                    
}
                    ?>






                                        </tbody>
                                    </table>
                                </div>
                   
                    <!-- data table end -->                      
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
                    
                    
                            $sql = mysqli_query($koneksi,"select * from data_training");
                    
                    
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
                                     mysqli_query($koneksi, 'UPDATE `data_training` SET `tweet_preprocessing` = (\'' . $stemmed . '\') WHERE `id_training` = (\'' . $id . '\');');   
                                     $piecesA = explode(' ', $stemmed);
                                     foreach($piecesA as $piece)
                              mysqli_query($koneksi, 'insert into data_training_kata (nama_kata) values (\'' . $piece . '\');');    
                                          //    mysqli_query($koneksi, "INSERT INTO `data_train_kata` (`nama_kata`) VALUES ".$piece."");   
                                         //    mysqli_query($koneksi, 'insert into data_preprocessing (tweet) values (\'' . $stemmed . '\');');    
                                                  
                               //    <!-- Stopword Removal / menghilangkan kata yang tidak berpengaruh dalam proses sentimen -->
                    
                      }                     echo "<meta http-equiv='refresh' content='0'>";
                }
                
                if(isset($_POST['reset']))
                {
                    $newaksidb = new aksidatabase;
                    $newaksidb -> truncate_kata();
                    $newaksidb-> reset_preprocessing_data_training();
                    echo "<meta http-equiv='refresh' content='0'>";
                }
                
                ?>


        <!-- main content area end -->
        <!-- footer area start-->
       
    </div>
    <!-- page container area end -->

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
