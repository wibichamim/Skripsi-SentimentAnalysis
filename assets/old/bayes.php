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
return $entropy_set;

}

public function set_info_gain() {
  include 'koneksi.php';

$entropy_set = $this -> entropy_set();
$enset =mysqli_query($koneksi, "SELECT `id_kata`, `entropy_kata` FROM `data_training_kata` ORDER BY `id_kata` ASC");
while ($rowd = mysqli_fetch_array($enset)) {
$ig = round($entropy_set - $rowd['entropy_kata'],9);
$query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `bobot_ig` = ".$ig." WHERE `id_kata` = ".$rowd['id_kata']."");
}


}



function entropy_postif_kategori_like()

{
  include 'koneksi.php';
    $querylike = mysqli_query($koneksi,"SELECT count(id_training) as jumlahpos FROM `data_train` where tweet_text LIKE '%kecewa%' and kategori='P'");
        while($datapositif = mysqli_fetch_array($querylike))
        {
        $hasila = $datapositif['jumlahpos'];
        }    
         return $hasila;
}


function entropy_postif_kategori_notlike()

{
  include 'koneksi.php';
    $querylike = mysqli_query($koneksi,"SELECT count(id_training) as jumlahpos FROM `data_train` where tweet_text not LIKE '%kecewa%' and kategori='P'");
        while($datapositif = mysqli_fetch_array($querylike))
        {
        $hasila = $datapositif['jumlahpos'];
        }    
         return $hasila;
}






function entropy_positif()

{
    include 'koneksi.php';

  $total_positif = $this -> jt_positif();
  $j_like_k = $this -> entropy_postif_kategori_like();
  $j_notlike_k = $this -> entropy_postif_kategori_notlike();

echo $total_positif;
echo "<br>";
echo $j_like_k;
echo "<br>";

echo $j_notlike_k;
echo "<br>";

$entropy_positif_set = round((-((($j_like_k/$total_positif)*log($j_like_k/$total_positif,2))+
  ($j_notlike_k/$total_positif)*log($j_notlike_k/$total_positif,2))),4);

return $entropy_positif_set;

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
    $querylike = mysqli_query($koneksi,"SELECT count(id_training) as jumlahpos FROM `data_train` where tweet_text LIKE '%kecewa%' and kategori='N'");
        while($datapositif = mysqli_fetch_array($querylike))
        {
        $hasila = $datapositif['jumlahpos'];
        }    
         return $hasila;
}


function entropy_negatif_kategori_notlike()

{
  include 'koneksi.php';
    $querylike = mysqli_query($koneksi,"SELECT count(id_training) as jumlahpos FROM `data_train` where tweet_text not LIKE '%kecewa%' and kategori='N'");
        while($datapositif = mysqli_fetch_array($querylike))
        {
        $hasila = $datapositif['jumlahpos'];
        }    
         return $hasila;
}

function entropy_negatif()

{
    include 'koneksi.php';

  $total_negatif = $this -> jt_negatif();
  $j_like_k = $this -> entropy_negatif_kategori_like();
  $j_notlike_k = $this -> entropy_negatif_kategori_notlike();

echo $total_negatif;
echo "<br>";
echo $j_like_k;
echo "<br>";

echo $j_notlike_k;
echo "<br>";

$entropy_negatif_set = round((-((($j_like_k/$total_negatif)*log($j_like_k/$total_negatif,2))+
  ($j_notlike_k/$total_negatif)*log($j_notlike_k/$total_negatif,2))),4);

return $entropy_negatif_set;

}

function entropy_kata()

{
    include 'koneksi.php';

  $entropy_negatif = $this -> entropy_negatif();
  $entropy_positif = $this -> entropy_positif();
  $total_negatif = $this -> jt_negatif();  
  $total_positif = $this -> jt_positif();
  $total_pn = $this -> jt_total();

echo $entropy_negatif;
echo "<br>";
echo $entropy_positif;
echo "<br>";
echo "Total negatif :"  .$total_negatif;
echo "<br>";
echo "Total positif :"  . $total_positif; echo "<br>";
echo $total_pn;
echo "<br>";

$entropy_final = round((((($total_positif/$total_pn)*$entropy_positif)+
  ($total_negatif/$total_pn)*$entropy_negatif)),4);
echo $entropy_final;
$query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `entropy_kata` = ".$entropy_final." WHERE `nama_kata` = 'kecewa'");

}




}


class klasifikasi
{
 



function get_jml_kata_positif()
{
  include 'koneksi.php';
    $querylikea = mysqli_query($koneksi,"SELECT * FROM `data_train` where tweet_text LIKE '%kecewa%' and kategori='P'");
        while($datapositifa = mysqli_fetch_array($querylikea))
        {
        $hasila = $datapositifa['tweet_text'];
       $stoplist[]= $datapositifa['tweet_text'];
       $hasil_buah = implode(", ",$stoplist);
       } 

return count(str_word_count($hasil_buah, 1));

}

function get_jml_kata_negatif()
{
  include 'koneksi.php';
    $querylikea = mysqli_query($koneksi,"SELECT * FROM `data_train` where tweet_text LIKE '%kecewa%' and kategori='N'");
        while($datapositifa = mysqli_fetch_array($querylikea))
        {
        $hasila = $datapositifa['tweet_text'];
       $stoplist[]= $datapositifa['tweet_text'];
       $hasil_buah = implode(", ",$stoplist);
       } 

return count(str_word_count($hasil_buah, 1));

}

function get_jml_semua_kata_unik()
{
  include 'koneksi.php';
    $querylikea = mysqli_query($koneksi,"SELECT * FROM `data_train");
        while($datapositifa = mysqli_fetch_array($querylikea))
        {
        $hasila = $datapositifa['tweet_text'];
       $stoplist[]= $datapositifa['tweet_text'];
       $hasil_buah = implode(", ",$stoplist);
       } 

return count(str_word_count($hasil_buah, 1));

}


function nipositif()

{

   include 'koneksi.php';

   // array with good and bad words
   $good = [
     'kecewa',
   
   ];

  
   // if you keep using your string approach you can set $good and $bad with $good = explode(' ', $goodwords); and $bad = explode(' ', $badwords);
 $query = mysqli_query($koneksi,"select * from `data_train` where kategori='P'");
 while ($newsitem =  mysqli_fetch_array($query)) {
  $a = $newsitem['tweet_text'];
  $stoplist[]= $newsitem['tweet_text'];

   $hasil_buah = implode(", ",$stoplist);

   // set up good and bad word counters
   $totalGood = 0;
   $totalBad = 0;

   // check how many times each word is mentioned in newscontent
   foreach($good as $word) { 
     // add spaces arround the word to make sure the full word is matched, not a part
     $totalGood += substr_count($newsitem['tweet_text'], ' ' . "kecewa". ' ');
     
   }

  
 }




 return  $totalGood;


}



function ninegatif()

{

   include 'koneksi.php';

   // array with good and bad words
   $good = [
     'kecewa',
   
   ];

  
   // if you keep using your string approach you can set $good and $bad with $good = explode(' ', $goodwords); and $bad = explode(' ', $badwords);
 $query = mysqli_query($koneksi,"select * from `data_train` where kategori='N'");
 while ($newsitem =  mysqli_fetch_array($query)) {
  $a = $newsitem['tweet_text'];
  $stoplist[]= $newsitem['tweet_text'];

   $hasil_buah = implode(", ",$stoplist);

   // set up good and bad word counters
   $totalGood = 0;
   $totalBad = 0;

   // check how many times each word is mentioned in newscontent
   foreach($good as $word) { 
     // add spaces arround the word to make sure the full word is matched, not a part
     $totalGood += substr_count($newsitem['tweet_text'], ' ' . "kecewa". ' ');
     
   }

  
 }


 return  $totalGood;


}




function set_probabilitas_kata_positif() {
include 'koneksi.php';

$query = mysqli_query($koneksi,"SELECT `id_kata`, `nama_kata` FROM `data_training_kata` ORDER BY `id_kata` ASC");


while ($row_kata = mysqli_fetch_array($query)) {
$ni = $this -> nipositif();
$n = $this -> get_jml_kata_positif();
$kosakata = $this -> get_jml_semua_kata_unik();
$query_dokumen = mysqli_query($koneksi, "SELECT `id_training`,
`tweet_text` FROM `data_train` WHERE `kategori` =
'P' ORDER BY `id_training` ASC");

while ($row_dok = mysqli_fetch_array($query_dokumen)) {
$kata_dok = explode(' ',$row_dok['tweet_text']);
foreach ($kata_dok as $key) {
if ($row_kata['nama_kata'] == $key) {
$ni += 1;
}
}
}

}


$probabilitas_p = round(($ni+1)/($n+$kosakata),17);
return $probabilitas_p;

$query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata`
SET `bobot_bayes_positif` = ".$probabilitas_p." WHERE
`id_kata` = ".$row_kata['id_kata']."");


}

function set_probabilitas_kata_negatif() {
include 'koneksi.php';

$query = mysqli_query($koneksi,"SELECT `id_kata`, `nama_kata` FROM `data_training_kata` ORDER BY `id_kata` ASC");


while ($row_kata = mysqli_fetch_array($query)) {
$ni = $this -> ninegatif();
$n = $this -> get_jml_kata_negatif();
$kosakata = $this -> get_jml_semua_kata_unik();
$query_dokumen = mysqli_query($koneksi, "SELECT `id_training`,
`tweet_text` FROM `data_train` WHERE `kategori` =
'P' ORDER BY `id_training` ASC");

while ($row_dok = mysqli_fetch_array($query_dokumen)) {
$kata_dok = explode(' ',$row_dok['tweet_text']);
foreach ($kata_dok as $key) {
if ($row_kata['nama_kata'] == $key) {
$ni += 1;
}
}
}

}




$probabilitas_p = round(($ni+1)/($n+$kosakata),17);
echo $probabilitas_p;
$query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata`
SET `bobot_bayes_negatif` = ".$probabilitas_p." WHERE
`nama_kata` = ".$row_kata['id_kata']."");


}







function klasifikasi_sentimen() {
include 'koneksi.php';
$query_dok = mysqli_query($koneksi,"SELECT `id_training`,
`tweet_text` FROM
data_train ORDER BY `id_training`");

while ($row_dok =  mysqli_fetch_array($query_dok)) {
$prob_kata_positif = []; $prob_kata_negatif = [];
$kata_dok = $row_dok['tweet_text'];
$kata_hasil = explode(' ', $kata_dok);
foreach ($kata_hasil as $key) {

$query_bobot_kata = mysqli_query($koneksi,"SELECT `id_kata`,
`nama_kata`, `bobot_bayes_positif`, `bobot_bayes_negatif` FROM
`data_training_kata` WHERE `nama_kata` = '".$key."'");
while ($row_kata = mysqli_fetch_array($query_bobot_kata)) {

if ($key == $row_kata['nama_kata']) {
$prob_kata_positif[$key] = round($row_kata['bobot_bayes_positif'], 8);
$prob_kata_negatif[$key] = round($row_kata['bobot_bayes_negatif'], 8);
} else {
$prob_kata_positif[$key] = 1; $prob_kata_negatif[$key] = 1;
}
}
}

$prob_dokumen_positif = 1;
foreach ($prob_kata_positif as $kata_prob => $value) {
$prob_dokumen_positif *= $value;
}
$prob_dokumen_negatif = 0;
foreach ($prob_kata_negatif as $kata_prob => $value) {
$prob_dokumen_negatif *= $value;
}

if ($prob_dokumen_positif > $prob_dokumen_negatif)
{
$sentimen = "P";
}
else if ($prob_dokumen_positif < $prob_dokumen_negatif)
{
$sentimen = "N";
}
else { $sentimen = "Tidak ada"; }
}
echo $sentimen;

}




}

$newcount = new coba;

//$newcount -> entropy_kata();
//$newcount -> set_info_gain();

$newklasifikasi = new klasifikasi;
 // $newklasifikasi -> get_jml_kata_positif();

 // $newklasifikasi -> get_jml_semua_kata_unik();
    echo "<br>";
 // $newklasifikasi -> nipositif();
 //$newklasifikasi -> get_jml_kata_positif();
 //$newklasifikasi -> get_jml_kata_negatif();
   echo "<br>"; 

  //$newklasifikasi -> set_probabilitas_kata_positif();
  // $newklasifikasi -> set_probabilitas_kata_negatif();
   echo "<br>";

//  $newklasifikasi -> set_probabilitas_kata_positif();
 // $newklasifikasi -> set_probabilitas_kata_negatif();
  $newklasifikasi -> set_probabilitas_kata_negatif();
  $newklasifikasi -> set_probabilitas_kata_positif();

?>