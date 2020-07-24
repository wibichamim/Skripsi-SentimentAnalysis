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

public function countall()
{
$this -> entropy_postif_kategori_like();
$this -> entropy_postif_kategori_notlike();
$this -> entropy_negatif_kategori_like();
$this -> entropy_negatif_kategori_notlike();
$this -> entropy_kata();
$this -> set_info_gain();

}

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
return $entropy_set;

}

public function set_info_gain() {
  include 'koneksi.php';

$entropy_set = $this -> entropy_set();
$enset =mysqli_query($koneksi, "SELECT `nama_kata`, `entropy_kata` FROM `data_training_kata` ORDER BY `nama_kata` ASC");
while ($rowd = mysqli_fetch_array($enset)) {
  $id = $rowd['nama_kata'];
$ig = round($entropy_set - $rowd['entropy_kata'],9);
echo $ig;
echo " ";
echo $id;
echo "<br>";


mysqli_query($koneksi, 'UPDATE `data_training_kata` SET `bobot_ig` = (\'' . $ig . '\') WHERE `nama_kata` = (\'' . $id . '\');');   
}


}

public function entropy_postif_kategori_like()
{
  include 'koneksi.php';

  $query = mysqli_query($koneksi,"SELECT `nama_kata` FROM `data_training_kata`");

while ($row_kata = mysqli_fetch_array($query)) {
$a = $row_kata['nama_kata'];
  $querylike = mysqli_query($koneksi,"SELECT count(tweet_text) as jumlahpos FROM `data_train` where tweet_preprocessing LIKE '%" .$row_kata['nama_kata'] ."%' and kategori = 'P'");
        while($datapositif = mysqli_fetch_array($querylike))
        {
        $hasila = $datapositif['jumlahpos'];

$query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `fm_positif` = ".$hasila." WHERE `nama_kata` = '$a'");

        }   

}

}


function entropy_postif_kategori_notlike()

{
  include 'koneksi.php';

    $query = mysqli_query($koneksi,"SELECT `nama_kata` FROM `data_training_kata`");

while ($row_kata = mysqli_fetch_array($query)) {
$a = $row_kata['nama_kata'];
    $querylike = mysqli_query($koneksi,"SELECT count(id_training) as jumlahpos FROM `data_train` where tweet_preprocessing not LIKE '%" .$row_kata['nama_kata'] ."%'and kategori='P'");
        while($datapositif = mysqli_fetch_array($querylike))
        {
        $hasila = $datapositif['jumlahpos'];
     $query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `fh_positif` = ".$hasila." WHERE `nama_kata` = '$a'");

}
}
}

 function jt_positif()

{
  include 'koneksi.php';

    $query = mysqli_query($koneksi,"select count(id_training) as positif FROM data_train where kategori='P' ");
        while($data = mysqli_fetch_array($query)){
     $po = $data['positif'];
     return $po;     
        }
}







function jt_negatif()

{
  include 'koneksi.php';

    $query = mysqli_query($koneksi,"select count(id_training) as negatif FROM data_train where kategori='N'");
        while($data = mysqli_fetch_array($query)){
     $po = $data['negatif'];
     return $po;     
        }
}  

function jt_total()

{
  include 'koneksi.php';

    $query = mysqli_query($koneksi,"select count(id_training) as total FROM data_train");
        while($data = mysqli_fetch_array($query)){
     $po = $data['total'];
     return $po;     
        }
}  


function entropy_negatif_kategori_like()

{
  include 'koneksi.php';
      $query = mysqli_query($koneksi,"SELECT `nama_kata` FROM `data_training_kata`");
      while ($row_kata = mysqli_fetch_array($query)) {
$a = $row_kata['nama_kata'];
    $querylike = mysqli_query($koneksi,"SELECT count(id_training) as jumlahpos FROM `data_train` where tweet_preprocessing LIKE '%" .$row_kata['nama_kata'] ."%' and kategori='N'");
        while($datapositif = mysqli_fetch_array($querylike))
        {
        $hasila = $datapositif['jumlahpos'];
             $query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `fm_negatif` = ".$hasila." WHERE `nama_kata` = '$a'");

        }    
}
}


function entropy_negatif_kategori_notlike()

{
  include 'koneksi.php';

      $query = mysqli_query($koneksi,"SELECT `nama_kata` FROM `data_training_kata`");

while ($row_kata = mysqli_fetch_array($query)) {
  $a = $row_kata['nama_kata'];

    $querylike = mysqli_query($koneksi,"SELECT count(id_training) as jumlahpos FROM `data_train` where tweet_preprocessing not LIKE '%" .$row_kata['nama_kata'] ."%'and kategori='N'");
        while($datapositif = mysqli_fetch_array($querylike))
        {
        $hasila = $datapositif['jumlahpos'];
      $query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `fh_negatif` = ".$hasila." WHERE `nama_kata` = '$a'");

        }    
}
}



function entropy_kata()

{
    include 'koneksi.php';
  $total_positif = $this -> jt_positif(); 
  $total_negatif = $this -> jt_negatif();
   $total_pn = $this -> jt_total();
 
$pos =mysqli_query($koneksi, "SELECT * FROM `data_training_kata` ORDER BY `nama_kata` ASC");
while ($rowd = mysqli_fetch_array($pos)) {

  $idkata = $rowd['nama_kata'];

  $fm_positif = $rowd['fm_positif'];
  $fh_positif = $rowd['fh_positif'];

  $entropy_positif_set = round((-((($fm_positif/$total_positif)*log($fm_positif/$total_positif,2))+
  ($fh_positif/$total_positif)*log($fh_positif/$total_positif,2))),4);

  $query_simpan_po = mysqli_query($koneksi, "UPDATE `data_training_kata`
SET `en_po` = ".$entropy_positif_set." WHERE
`nama_kata` = '$idkata'");
   }


  $neg =mysqli_query($koneksi, "SELECT * FROM `data_training_kata` ORDER BY `nama_kata` ASC");
while ($rowd = mysqli_fetch_array($neg)) {
  $idkata = $rowd['nama_kata'];

  $fm_negatif = $rowd['fm_negatif'];
  $fh_negatif = $rowd['fh_negatif'];

  $entropy_negatif_set = round((-((($fm_negatif/$total_negatif)*log($fm_negatif/$total_negatif,2))+
  ($fh_negatif/$total_negatif)*log($fh_negatif/$total_negatif,2))),4);

  $query_simpan_ne = mysqli_query($koneksi, "UPDATE `data_training_kata`
SET `en_ne` = ".$entropy_negatif_set." WHERE `nama_kata` = '$idkata'");
   }



  $final =mysqli_query($koneksi, "SELECT * FROM `data_training_kata` ORDER BY `nama_kata` ASC");
while ($rowd = mysqli_fetch_array($final)) {

  $idkata = $rowd['nama_kata'];
  $entropy_positif = $rowd['en_po'];
  $entropy_negatif = $rowd['en_ne'];

$entropy_final = round((((($total_positif/$total_pn)*$entropy_positif)+
  ($total_negatif/$total_pn)*$entropy_negatif)),4);
$query_simpan_tot = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `entropy_kata` = ".$entropy_final." WHERE
`nama_kata` = '$idkata'");

}
}





}


class klasifikasi
{
  function klasifikasi_sentimen() {
    include 'koneksi.php';

$query_dok = mysqli_query($koneksi,"SELECT
`tweet_preprocessing` FROM
data_train_tes ORDER BY `id_training`");

while ($row_dok =  mysqli_fetch_array($query_dok)) {
$prob_kata_positif = []; $prob_kata_negatif = [];
$kata_dok = $row_dok['tweet_preprocessing'];
$kata_hasil = explode(' ', $kata_dok);
foreach ($kata_hasil as $key) {

$query_bobot_kata = mysqli_query($koneksi,"SELECT
`nama_kata`, `bobot_bayes_positif`, `bobot_bayes_negatif` FROM
`data_training_kata` WHERE `nama_kata` = '".$key."'");
while ($row_kata = mysqli_fetch_array($query_bobot_kata)) {


if ($key == $row_kata['nama_kata']) {
$prob_kata_positif[$key] =
round($row_kata['bobot_bayes_positif'], 8);
$prob_kata_negatif[$key] =
round($row_kata['bobot_bayes_negatif'], 8);
} else {
$prob_kata_positif[$key] = 1; $prob_kata_negatif[$key] = 1;
}
echo $key ." " .$prob_kata_positif[$key] ."<br>";
//print_r($prob_kata_positif[$key]);

}
}
}
}
}


$newcount = new coba;


//$newcount -> entropy_postif_kategori_like();
//echo "<br>";
//$newcount -> entropy_postif_kategori_notlike();
//echo "<br>";
//$newcount -> entropy_negatif_kategori_like();
//echo "<br>";
//echo $newcount -> entropy_negatif_kategori_notlike();

//$newcount -> entropy_positif();
$newcount -> countall();

//$newcount -> set_info_gain();

$newklasifikasi = new klasifikasi;
 //$newklasifikasi -> get_jml_kata_positif($inputan);

  //$newklasifikasi -> get_jml_semua_kata_unik();
   // echo "<br>";
//echo $newklasifikasi -> klasifikasi_sentimen();
 //$newklasifikasi -> get_jml_kata_positif();
 //$newklasifikasi -> get_jml_kata_negatif();
   //echo "<br>"; 

  // $newklasifikasi -> nipositif();
//   echo "<br>";










?>