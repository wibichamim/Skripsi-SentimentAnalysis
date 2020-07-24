<?php
 require_once "koneksi.php";
 include "test.php";
 include 'function.php';
 $newprepro = new preprocessing();
$newa = new a;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Case Folding</title>
</head>
<body>
 <table>
  <form method="post">
 
	<p><input type="submit" value="Submit" name="submit" /></p>

     <?php
if(isset($_POST['submit'])){

}

?>

 <tr>
        <th>No</th>
        <th>Username</th>
        <th>Tweet</th>
        <th>Case Folding</th>
        <th>Cleansing</th>
        <th>Convert Emoticon</th>
        <th>Tokenizing</th>

        <th>Tokenizing</th>


    </tr>


 <?php 


        $nomor = 1;
        $sql = mysqli_query($koneksi,"select * from data_testing");

            //." and nilai.id_guru=" .$_SESSION['nik']);

        while($data = mysqli_fetch_array($sql)){
           $id = $data['id_tweet'];
        ?>
        <tr>
            <th><?php echo $nomor++; ?></td>
            <td align="center"><?php echo $data['username']; ?></td>
            <td><?php echo $data['tweet']; ?></td>
<?php
             $str = strtolower($data['tweet']);
             $datatweet = $data['tweet'];
            ?>


                        <td><?php echo $newprepro -> case_folding($datatweet); ?></td>
                        <td><?php 
                        $casefolding = $newprepro -> case_folding($datatweet);
                        $cleansing = $newprepro -> acleansing($casefolding);
                        echo $newprepro -> convert_emoticon($cleansing);
                        $onverted = $newprepro -> convert_emoticon($cleansing);

                        ?></td>
                              <td><?php 
              
                        echo $newprepro -> convert_negation($onverted);
                        $negation = $newprepro -> convert_negation($onverted);
                        ?></td>

                              <td><?php 
                      
                        echo $newprepro -> tokenizer2($negation);
                        $tokenized = $newprepro -> tokenizer2($negation);
                        ?></td>

                              <td><?php 
                     $arr = array('>:]',':-(',':D','abjh');
                    
                        echo $newprepro -> convert_emoticon($tokenized);

                        ?></td>

</tr>        <?php }  ?>






 
</table>




</body>
</html>