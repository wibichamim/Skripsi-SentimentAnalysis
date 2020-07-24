<?php



class a {
	function hitung ()
	{


}

function positif()
{
	  include 'koneksi.php';

	$query_dok = mysqli_query($koneksi,"SELECT `tweet_preprocessing`,`id_training` FROM data_train_tes ORDER BY `id_training`");
while ($row_dok =  mysqli_fetch_array($query_dok)) {

$prob_kata_positif = []; $prob_kata_negatif = [];
$idt = $row_dok['id_training'];
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
}
else {
$prob_kata_positif[$key] = 1; $prob_kata_negatif[$key] = 1;
}

}
}


$kata1 = implode(' ', $prob_kata_positif);
$kata = explode(' ', $kata1);


$total = 1;
foreach ($kata as $isi) {
	# code...
if ($isi!=0){

	$total = $total*$isi*1;
}

else {
	$total = 1;
}
}

$prob_kata_positif = number_format($total,100);
echo $row_dok['tweet_preprocessing'] ." | " .$prob_kata_positif ."<br>";
$query_simpan = mysqli_query($koneksi, "UPDATE `data_train_tes` SET `prob_pos` = ".$prob_kata_positif." WHERE `id_training` = '$idt'");

}
}



function negatif()
{
	  include 'koneksi.php';
	$query_dok = mysqli_query($koneksi,"SELECT `tweet_preprocessing`,`id_training` FROM data_train_tes ORDER BY `id_training`");



while ($row_dok =  mysqli_fetch_array($query_dok)) {

$idt = $row_dok['id_training'];

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
number_format($row_kata['bobot_bayes_positif'], 50);
$prob_kata_negatif[$key] =
number_format($row_kata['bobot_bayes_negatif'], 50);
}
else {
$prob_kata_positif[$key] = 1; $prob_kata_negatif[$key] = 1;
}

}
}


$kata1 = implode(' ', $prob_kata_negatif);
$kata = explode(' ', $kata1);


$total = 1;
foreach ($kata as $isi) {
	# code...
if ($isi!=0){

	$total = $total*$isi*1;
}

else {
	$total = 1;
}
}

$prob_kata_negatif = number_format($total,100);
$query_simpan = mysqli_query($koneksi, "UPDATE `data_train_tes` SET `prob_neg` = ".$prob_kata_negatif." WHERE `id_training` = '$idt'");

}
}

function sentimen()
{
	 include 'koneksi.php';
	$query_dok = mysqli_query($koneksi,"SELECT * FROM data_train_tes ORDER BY `id_training`");

while ($row_dok =  mysqli_fetch_array($query_dok)) {

$idt = $row_dok['id_training'];
$tweet = $row_dok['tweet_text'];
$prob_dokumen_positif= $row_dok['prob_pos'];
$prob_dokumen_negatif= $row_dok['prob_neg'];
$snt= $row_dok['sentimen'];


if ($prob_dokumen_positif > $prob_dokumen_negatif) {
$sentimen = "P";
$query_simpan = mysqli_query($koneksi, "UPDATE `data_train_tes` SET `sentimen` = 'Positif' WHERE `id_training` = '$idt'");

}

else if ($prob_dokumen_positif < $prob_dokumen_negatif) {
$sentimen = "N";
$query_simpan = mysqli_query($koneksi, "UPDATE `data_train_tes` SET `sentimen` = 'Negatif' WHERE `id_training` = '$idt'");
}


echo $tweet ." Adalah tweet : " .$snt ."<br>";

}

}

}


$newa = new a;
$newa -> positif();
$newa -> negatif();
$newa -> sentimen();









?>
