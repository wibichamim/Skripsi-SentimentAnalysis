<?php
include 'koneksi.php';
include 'class_lib.php';

$newprepro = new preprocessing;



$sql = mysqli_query($koneksi,"select * from data_train");
$nomor = 1;

//." and nilai.id_guru=" .$_SESSION['nik']);

while($data = mysqli_fetch_array($sql)){
$id = $data['id_training'];
 $datatweet = $data['tweet_text'];

        $casefolded = $newprepro -> case_folding($datatweet);
        $cleansed = $newprepro -> cleansing($casefolded) ."<br>";
       $clean =  $newprepro -> acleansing($cleansed) ."<br>";

      echo  $normal = $newprepro -> normalization3($clean) ."<br>";


}








?>