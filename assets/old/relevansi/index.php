<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
<body>
<div class="table-responsive">
<div class="container-fluid">
    <div class="row">
      	 <div class="col-md-6 col-sm-1 col-lg-12">
<table class="table table-striped table-hover">
  <thead class="thead-dark">
  	<tr>

		<th scope="col"> No </th>
		<th scope="col"> Kalimat </th>
		<th scope="col"> Bobot </th>
		<th scope="col"> Relevansi </th>
		<th scope="col" colspan="2"></th>
		</tr>

	</thead>

<?php
include '../koneksi.php';
$nomor = 1;
	$sql = mysqli_query($koneksi, "SELECT * from `data_coba`");
	while($row = mysqli_fetch_array($sql)) {
		?>
<tr>
	<td scope="ro"><?php echo $nomor++;?> </td>
	<td><?php echo $row['kalimat']; ?> </td>
	<td><?php echo $row['bobot']; ?> </td>
    <td><?php
    if ($row['bobot'] > 0)
    {
        echo "Relevan";
    }

    else{
        echo "Tidak relevan";
    }
    
    
    ?> </td>
	<td><a class="edit" href="edit.php?id_training=<?php echo $row['id_training']?>"> Edit</td>
	<td><a class="delete" href="delete.php?id_training=<?php echo $row['id_training']?>"> Delete</td>
</tr>
<?php } 
?>
</table>


<!-- correct -->
<div class="d-flex justify-content-center"> 
<a href="insert.php"><button id="singlebutton" name="singlebutton" class="btn btn-primary">insert!</button></a>

</div>

  </div>
    </div>
</div>
</div>
</body>
</html>