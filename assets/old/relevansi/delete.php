<?php
include '../koneksi.php';
$id = $_GET['id_training'];
echo $id;
mysqli_query($koneksi,"DELETE FROM `data_coba` WHERE `data_coba`.`id_training` = '$id'");

echo ("<script LANGUAGE='JavaScript'>
	window.alert('Succesfully Deteled');
    window.location.href='index.php';
    </script>");

?>