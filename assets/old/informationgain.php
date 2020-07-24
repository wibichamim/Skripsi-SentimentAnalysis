<?php

  function get_jumlah_tweet_positif()

{
	include 'koneksi.php';

	  $query = mysqli_query($koneksi,"select count(id_training) as positif FROM data_train where kategori='P' ");
        while($data = mysqli_fetch_array($query)){
     echo   $po = $data['positif'];
        	
        }
}

function get_jumlah_tweet_negatif()
{
	include 'koneksi.php';

	  $query = mysqli_query($koneksi,"select count(id_training) as negatif FROM data_train where kategori='N' ");
        while($data = mysqli_fetch_array($query)){
        	echo $data['negatif'];
        }
}

function get_jumlah_tweet_total()
{
	include 'koneksi.php';

	  $query = mysqli_query($koneksi,"select count(id_training) as total FROM data_train");
        while($data = mysqli_fetch_array($query)){
        	echo $data['total'];
        }
}


class coba {



 public function entropy_set()
{
  include 'koneksi.php';
  $query = mysqli_query($koneksi,"select count(id_training) as positif FROM data_train where kategori='P' ");
        while($data = mysqli_fetch_array($query))
   {
   $jml_p = $data['positif'];
	}


	$neg = mysqli_query($koneksi,"select count(id_training) as negatif FROM data_train where kategori='N' ");
        while($dataneg = mysqli_fetch_array($neg))
    {
        	$jml_n = $dataneg['negatif'];
        }

  $tot = mysqli_query($koneksi,"select count(id_training) as total FROM data_train");
        while($datatotal = mysqli_fetch_array($tot)){
        	$jml_t = $datatotal['total'];
        }        


$entropy_set = round((-((($jml_p/$jml_t)*log($jml_p/$jml_t,2))+
($jml_n/$jml_t)*log($jml_n/$jml_t,2))),4);
echo $entropy_set;

}

public function set_info_gain() {
  include 'koneksi.php';


 $entropy_set= 0.971;
$enset =mysqli_query($koneksi, "SELECT `id_kata`, `entropy_kata` FROM `data_training_kata` ORDER BY `id_kata` ASC");
while ($rowd = mysqli_fetch_array($enset)) {
$ig = round($entropy_set - $rowd['entropy_kata'],9);
$query_simpan = mysqli_query($koneksi, "UPDATE `data_train` SET `bobot_ig` = ".$ig." WHERE `id_kata` = ".$rowd['id_kata']."");
}

}
}

$newcount = new coba;

echo $newcount->set_info_gain();





?>