<?php 

include '../koneksi.php';
include ("../class_lib.php");


$newbayes = new bayes;
$newbayes-> setbobotbayes();
?>

<script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
<script type="text/javascript">
window.location.href = 'bayes';
</script>