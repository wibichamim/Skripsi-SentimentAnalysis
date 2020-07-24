<!DOCTYPE html>
<?php
include '../koneksi.php';
?>
<html>
<head>
	<title>Insert</title>
</head>
<body>
	<form action="" method="POST">
		Kalimat
		<input type="text" name="kalimat">
		
   	   <input type="submit" name="submit" value="Insert">
	</form>

<?php
if(isset($_POST['submit']))
{
	$kal = $_POST['kalimat'];
	echo $kal;
	if($kal != ''){
	mysqli_query($koneksi,"insert into data_coba (kalimat) values ('$kal') ");
//mysqli_query($koneksi,"insert into kbm (id_mapel,id_guru,id_kelas,id_semester,id_tahunajar) values('$mapel','$guru','$kelas','$semester','$tahunajar')");
	header("location:index.php");
}

}

?>

</body>
</html>