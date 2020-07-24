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

$aquery = mysqli_query($koneksi,"select * from `data_train`");
while ($anewsitem =  mysqli_fetch_array($aquery)) {
$a = $anewsitem['tweet_preprocessing']; 
 $astoplist[]= $anewsitem['tweet_preprocessing'];

  $ahasil_buah = implode(", ",$astoplist);

}
  return $ahasil_buah;
}

}

$aa = new a;
$vv = $aa -> a();
print_r ($vv);

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

//echo $totalGood;

  ?>