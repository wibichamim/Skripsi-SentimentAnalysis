<?php
 error_reporting(0);
include 'koneksi.php';
include 'class_lib.php';
$newprepro = new preprocessing();
        
$newprepro -> entropy_kata();

?>