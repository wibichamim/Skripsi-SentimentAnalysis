<!DOCTYPE html>
<?php
include '../koneksi.php';
$idt = $_GET['id_training'];
?>
<html>
<head>
	<title>Edit</title>
	    <link rel="stylesheet" href="../css/bootstrap.min.css" />

</head>
<body>

<?php


$sql = mysqli_query($koneksi, "select * from `data_coba` where `id_training`=$idt");
while($row = mysqli_fetch_array($sql)){
?>
				<form action="" method="POST">
				  <input type="text" hidden="" name="id" value="<?php echo $row['id_training']; ?>"  readonly>
				  <br>
				  Kalimat				  <input size="50" type="text" name="kalimat" value="<?php echo $row['kalimat']; ?>">
				            	   <input type="submit" name="submit" value="Update">
    			</form>
<?php
}

if(isset($_POST['submit']))
{
$id = $_POST['id'];
$kalimat = $_POST['kalimat'];

mysqli_query($koneksi,"update `data_coba` set kalimat = '$kalimat' where id_training='$id'");
echo ("<script LANGUAGE='JavaScript'>
	window.alert('Succesfully Updated');
    window.location.href='setrelevansi.php';
    </script>");
}

?>
</body>
</html>