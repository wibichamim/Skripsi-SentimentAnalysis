<?php
  // your db connection ...
  include 'koneksi.php';

  // array with good and bad words
  $good = [
    'bagus', 
  
  ];


  // if you keep using your string approach you can set $good and $bad with $good = explode(' ', $goodwords); and $bad = explode(' ', $badwords);
$query = mysqli_query($koneksi,"select * from `data_training_kata` ORDER BY `nama_kata` ASC");
while ($newsitem =  mysqli_fetch_array($query)) {
 $stoplist[]= $newsitem['nama_kata'];

  $hasil_buah = implode(" ",$stoplist);

  // set up good and bad word counters
  $totalGood = 0;
  $totalBad = 0;


 
}

echo  $hasil_buah;
echo "<br>";



echo "<br>";
$hasil_explode = explode(' ',$hasil_buah);

print_r($hasil_explode);

   // $totalGood += substr_count($hasil_buah, "bagus");
echo "<br>";

echo "<br>";

class a{

public function a()
{
  include 'koneksi.php';

$aquery = mysqli_query($koneksi,"select * from `data_train` where kategori='P'");
while ($anewsitem =  mysqli_fetch_array($aquery)) {
$a = $anewsitem['tweet_preprocessing']; 
 $astoplist[]= $anewsitem['tweet_preprocessing'];

  $ahasil_buah = implode(", ",$astoplist);

}
  return $ahasil_buah;
}

public function negatif()
{
  include 'koneksi.php';

$aquery = mysqli_query($koneksi,"select * from `data_train` where kategori='N'");
while ($anewsitem =  mysqli_fetch_array($aquery)) {
$a = $anewsitem['tweet_preprocessing']; 
 $astoplist[]= $anewsitem['tweet_preprocessing'];

  $ahasil_buah = implode(", ",$astoplist);

}
  return $ahasil_buah;
}


function get_jml_kata_positif($value)
{
echo count(str_word_count($value, 1));
}


function get_jml_kata_negatif($value)
{
echo count(str_word_count($value, 1));
}


function get_jml_semua_kata_unik()
{
  include 'koneksi.php';
    $querylikea = mysqli_query($koneksi,"SELECT * FROM `data_train");
        while($datapositifa = mysqli_fetch_array($querylikea))
        {
        $hasila = $datapositifa['tweet_preprocessing'];
       $stoplist[]= $datapositifa['tweet_preprocessing'];
       $hasil_buah = implode(", ",$stoplist);
       
       } 
    
return count(str_word_count($hasil_buah, 1));

}





}

$aa = new a;
$vv = $aa -> a();
$neg = $aa -> negatif();
echo $vv;
echo "<br>";
echo "<br>";


echo "<br>";

//$totalGood += substr_count($aa -> a(), "bagus");

echo "<br>";
echo $n_positif = $aa -> get_jml_kata_positif($vv);
echo "<br>";
echo $kosakata = $aa -> get_jml_semua_kata_unik();
echo "<br>";
echo $n_negatif = $aa -> get_jml_kata_negatif($neg);
echo "<br>";
echo "<br>";

//$probabilitas_p = round(($ni_positif+1)/($n+$kosakata),17);
//echo $probabilitas_p;

 foreach($hasil_explode as $word) { 


$totalGood = substr_count($vv, ''."$word".'');

$ni_positif = $totalGood;

$probabilitas_p = round(($ni_positif+1)/($n_positif+$kosakata),17);

$totalBad = substr_count($neg, ''."$word".'');

$ni_negatif = $totalBad;

$probabilitas_n = round(($ni_negatif+1)/($n_negatif+$kosakata),17);


$query_simpan_probpos = mysqli_query($koneksi, "UPDATE `data_training_kata`
SET `bobot_bayes_positif` = ".$probabilitas_p." WHERE
`nama_kata` = '$word'");

$query_simpan_probneg = mysqli_query($koneksi, "UPDATE `data_training_kata`
SET `bobot_bayes_negatif` = ".$probabilitas_n." WHERE
`nama_kata` = '$word'");

echo $word ."  |  Probabilitas Positif : " .$probabilitas_p ." |  Probabilitas Negatif : " .$probabilitas_n ."<br>";

}
  ?>