<?php 

include 'koneksi.php';
include ("class_lib.php");

$newinformationgain = new information_gain;
$newinformationgain-> doall($koneksi);
//$newinformationgain-> positif();

?>