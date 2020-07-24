<?php
 require_once "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Case Folding</title>
</head>
<body>
 <table>
 	<form method="post">
    <input type="submit" name="test" id="test" value="RUN" /><br/>
</form>

 <tr>
        <th>No</th>
        <th>Username</th>
        <th>Tweet</th>


    </tr>


 <?php 
 

        $nomor = 1;

        $sql = mysqli_query($koneksi,"select * from data_testing");



            //." and nilai.id_guru=" .$_SESSION['nik']);

        while($data = mysqli_fetch_array($sql)){

      
           
        ?>
        <tr>
            <th><?php echo $nomor++; ?></td>
            <td align="center"><?php echo $data['username']; ?></td>
            <td><?php echo $data['tweet']; ?></td>




</tr>        <?php }  ?>






 
</table>




</body>
</html>