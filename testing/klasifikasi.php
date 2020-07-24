<?php include "../koneksi.php";
include ("../class_lib.php");
$newaksidb = new aksidatabase;
$newprepro = new preprocessing;
 
$dataPoints = array( 
	array("label"=>"Industrial", "y"=>51.7),
	array("label"=>"Transportation", "y"=>26.6),
	array("label"=>"Residential", "y"=>13.9),
	array("label"=>"Commercial", "y"=>7.8)
)
 

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
    <script>
window.onload = function() {
  var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "World Energy Consumption by Sector - 2012"
	},
	data: [{
		type: "pie",
		indexLabel: "{y}",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabelPlacement: "inside",
		indexLabelFontColor: "#36454F",
		indexLabelFontSize: 18,
		indexLabelFontWeight: "bolder",
		showInLegend: true,
		legendText: "{label}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
      </script>
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
                                    <li><a href="preprocessing">Preprocessing</a></li>
                                    <li><li class="active"><a href="klasifikasi">Klasifikasi</a></li>

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
                                  echo    $newaksidb -> hitung_tweet_positif_datatesting($koneksi);
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
                                echo      $newaksidb -> hitung_tweet_netral_datatesting($koneksi);
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
                               echo       $newaksidb -> hitung_tweet_negatif_datatesting($koneksi);
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
  ['Positif', <?php   echo    $newaksidb -> hitung_tweet_positif_datatesting($koneksi); ?>],
  ['Negatif', <?php   echo    $newaksidb -> hitung_tweet_negatif_datatesting($koneksi); ?>],
  ['', 0],
  ['Netral', <?php   echo    $newaksidb -> hitung_tweet_netral_datatesting($koneksi); ?>],
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
                    <!-- Social Campain area end -->




                    <!-- data table start -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Klasifikasi  Training</h4>

                                 <div class="justify-content-between">
                                <div class="data-tables">
                                    <table id="dataTable" >
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th>NO</th>
                                                <th>Tweet Asli</th>
                                                <th>Sentimen</th>

                                            </tr>
                                        </thead>
                                        <tbody>                        
                                        <?php
                                                $nomor = 1;
                                                $sql = mysqli_query($koneksi,"SELECT * FROM `data_testing` where `sentimen`='POSITIF' or `sentimen` = 'NEGATIF' or `sentimen` = 'NETRAL'");
                                                while($data = mysqli_fetch_array($sql))
                                                {
                                                ?>

                                                    <tr>
                                                        <td><?php echo $nomor++; ?></td>
                                                        <td><?php echo $data['tweet_text']; ?></td>
                                                        <td><?php echo $data['sentimen'];  ?></td>

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
                        <input class="btn btn-flat btn-primary mb-3" name="klasifikasi" type="submit" value="Process">
                        </div>
                    </form>
                </div>
        </div>


        <?php
            if(isset($_POST['klasifikasi']))
            {
                $newklasifikasi = new klasifikasi;
                $newklasifikasi-> set_probabilitas();
                $newklasifikasi-> sentimen();
                echo "<meta http-equiv='refresh' content='0'>";

            }

            if(isset($_POST['reset']))
            {
                $newaksidb = new aksidatabase;
                $newaksidb-> reset_klasifikasi_testing();
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

      <!-- start chart js -->
      <script src="../assets/js/Chart.min.js"></script>


    <script src="../assets/js/pie-chart.js"></script>


    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>



    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>


    <!-- all line chart activation -->
    <script>
    /*-------------- 8 line chart chartjs start ------------*/
if ($('#seolinechart3').length) {
    var ctx = document.getElementById("seolinechart3").getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: ["January", "February", "March", "April"],
            datasets: [{
                backgroundColor: "rgba(96, 241, 205, 0)",
                borderColor: '#fff',
                data: [
                    <?php
                    $bulan = mysqli_query($koneksi,"SELECT * FROM data_training where tanggal between '2019-01-01' and '2019-01-30' and sentimen='POSITIF'");
                    echo mysqli_num_rows($bulan);
                    ?>
                    ,
                    <?php
                    $bulan = mysqli_query($koneksi,"SELECT * FROM data_training where tanggal between '2019-02-01' and '2019-02-28' and sentimen='POSITIF'");
                    echo mysqli_num_rows($bulan);
                    ?>            
                    ,
                    <?php
                    $bulan = mysqli_query($koneksi,"SELECT * FROM data_training where tanggal between '2019-03-01' and '2019-03-31' and sentimen='POSITIF'");
                    echo mysqli_num_rows($bulan);
                    ?> 
                    ,     
                    <?php
                    $bulan = mysqli_query($koneksi,"SELECT * FROM data_training_tes where sentimen='Positif'");
                    echo mysqli_num_rows($bulan);
                    ?>    
                ],
            }]
        },
        // Configuration options go here
        options: {
            legend: {
                display: false
            },
            animation: {
                easing: "easeInOutBack"
            },
            scales: {
                yAxes: [{
                    display: !1,
                    ticks: {
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold",
                        beginAtZero: !0,
                        maxTicksLimit: 5,
                        padding: 0
                    },
                    gridLines: {
                        drawTicks: !1,
                        display: !1
                    }
                }],
                xAxes: [{
                    display: !1,
                    gridLines: {
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: 0,
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold"
                    }
                }]
            },
            elements: {
                line: {
                    tension: 0, // disables bezier curves
                }
            }
        }
    });
}
/*-------------- 8 line chart chartjs end ------------*/
/*-------------- 9 line chart chartjs start ------------*/
if ($('#seolinechart4').length) {
    var ctx = document.getElementById("seolinechart4").getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: ["January", "February", "March", "April"],
            datasets: [{
                backgroundColor: "rgba(96, 241, 205, 0)",
                borderColor: '#fff',
                data: [
                    <?php
                    $bulan = mysqli_query($koneksi,"SELECT * FROM data_training where tanggal between '2019-01-01' and '2019-01-30' and sentimen='NEGATIF'");
                    echo mysqli_num_rows($bulan);
                    ?>
                    ,
                    <?php
                    $bulan = mysqli_query($koneksi,"SELECT * FROM data_training where tanggal between '2019-02-01' and '2019-02-28' and sentimen='NEGATIF'");
                    echo mysqli_num_rows($bulan);
                    ?>            
                    ,
                    <?php
                    $bulan = mysqli_query($koneksi,"SELECT * FROM data_training where tanggal between '2019-03-01' and '2019-03-31' and sentimen='NEGATIF'");
                    echo mysqli_num_rows($bulan);
                    ?> 
                    ,     
                    <?php
                    $bulan = mysqli_query($koneksi,"SELECT * FROM data_training_tes where sentimen='Negatif'");
                    echo mysqli_num_rows($bulan);
                    ?>    
                ],
            }]
        },
        // Configuration options go here
        options: {
            legend: {
                display: false
            },
            animation: {
                easing: "easeInOutBack"
            },
            scales: {
                yAxes: [{
                    display: !1,
                    ticks: {
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold",
                        beginAtZero: !0,
                        maxTicksLimit: 5,
                        padding: 0
                    },
                    gridLines: {
                        drawTicks: !1,
                        display: !1
                    }
                }],
                xAxes: [{
                    display: !1,
                    gridLines: {
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: 0,
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold"
                    }
                }]
            },
            elements: {
                line: {
                    tension: 0, // disables bezier curves
                }
            }
        }
    });
}
/*-------------- 9 line chart chartjs end ------------*/


/*-------------- 6 line chart chartjs start ------------*/
if ($('#seolinechart1').length) {
    var ctx = document.getElementById("seolinechart1").getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: ["January", "February", "March", "April"],
            datasets: [{
                backgroundColor: "rgba(96, 241, 205, 0)",
                borderColor: '#fff',
                data: [
                    <?php
                    $bulan = mysqli_query($koneksi,"SELECT * FROM data_training where tanggal between '2019-01-01' and '2019-01-30' and sentimen='POSITIF'");
                    echo mysqli_num_rows($bulan);
                    ?>
                    ,
                    <?php
                    $bulan = mysqli_query($koneksi,"SELECT * FROM data_training where tanggal between '2019-02-01' and '2019-02-28' and sentimen='POSITIF'");
                    echo mysqli_num_rows($bulan);
                    ?>            
                    ,
                    <?php
                    $bulan = mysqli_query($koneksi,"SELECT * FROM data_training where tanggal between '2019-03-01' and '2019-03-31' and sentimen='POSITIF'");
                    echo mysqli_num_rows($bulan);
                    ?> 
                    ,     
                    <?php
                    $bulan = mysqli_query($koneksi,"SELECT * FROM data_training_tes where sentimen='Positif'");
                    echo mysqli_num_rows($bulan);
                    ?>    
                ],
            }]
        },
        // Configuration options go here
        options: {
            legend: {
                display: false
            },
            animation: {
                easing: "easeInOutBack"
            },
            scales: {
                yAxes: [{
                    display: !1,
                    ticks: {
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold",
                        beginAtZero: !0,
                        maxTicksLimit: 5,
                        padding: 0
                    },
                    gridLines: {
                        drawTicks: !1,
                        display: !1
                    }
                }],
                xAxes: [{
                    display: !1,
                    gridLines: {
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: 0,
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold"
                    }
                }]
            },
            elements: {
                line: {
                    tension: 0, // disables bezier curves
                }
            }
        }
    });
}
/*-------------- 6 line chart chartjs end ------------*/


/*-------------- 7 line chart chartjs start ------------*/
if ($('#seolinechart2').length) {
    var ctx = document.getElementById("seolinechart2").getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "January", "February", "March", "April", "May"],
            datasets: [{
                label: "Share",
                backgroundColor: "rgba(96, 241, 205, 0.2)",
                borderColor: '#3de5bb',
                data: [18, 41, 86, 49, 20, 35, 20, 50, 49, 30, 45, 25],
            }]
        },
        // Configuration options go here
        options: {
            legend: {
                display: false
            },
            animation: {
                easing: "easeInOutBack"
            },
            scales: {
                yAxes: [{
                    display: !1,
                    ticks: {
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold",
                        beginAtZero: !0,
                        maxTicksLimit: 5,
                        padding: 0
                    },
                    gridLines: {
                        drawTicks: !1,
                        display: !1
                    }
                }],
                xAxes: [{
                    display: !1,
                    gridLines: {
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: 0,
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold"
                    }
                }]
            },
            elements: {
                line: {
                    tension: 0, // disables bezier curves
                }
            }
        }
    });
}
/*-------------- 7 line chart chartjs end ------------*/
</script>


</body>

</html>
