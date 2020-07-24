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
  // if you keep using your string approach you can set $good and $bad with $good = explode(' ', $goodwords); and $bad = explode(' ', $badwords);
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


function get_jml_kata_positif($value)
{
 
echo count(str_word_count($value, 1));
echo "<pre>";
print_r(str_word_count($value, 1));

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
       print_r($hasil_buah);
       echo "<br>";

echo count(str_word_count($hasil_buah, 1));

}


}

$aa = new a;
$vv = $aa -> a();
echo $vv;
echo "<br>";
echo "<br>";

foreach($hasil_explode as $word) { 

$totalGood = substr_count($vv, ''."$word".'');
echo $word;
echo " - ";
echo $totalGood ;


echo "<br>";

}
echo "<br>";

//$totalGood += substr_count($aa -> a(), "bagus");

echo "<br>";
$aa -> get_jml_kata_positif($vv);
echo $aa -> get_jml_semua_kata_unik();



  ?>