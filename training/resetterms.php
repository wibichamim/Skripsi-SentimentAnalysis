<?php 

include '../koneksi.php';
include ("../class_lib.php");

$newaksidb = new aksidatabase;
$newaksidb-> reset_terms($koneksi);

?>