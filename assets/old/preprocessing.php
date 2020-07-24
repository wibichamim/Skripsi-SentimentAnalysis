<?php

require_once __DIR__ . '/vendor/autoload.php';

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
        <th>Convert Negation</th>
        <th>Tokenizing</th>
        <th>Stopword removal</th>
        <th>Stemmed</th>



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


                        <td><?php echo $newprepro -> case_folding($datatweet);

                        $casefolded = $newprepro -> case_folding($datatweet);

                         ?></td>
                        <td><?php 
                        $cleansed = $newprepro -> acleansing($casefolded);
                        echo $newprepro -> acleansing($casefolded);

                        ?></td>
                              <td><?php 
                        echo $newprepro -> convert_emoticon($cleansed);
                        $emoticonconverted = $newprepro -> convert_emoticon($cleansed);

                        ?></td>        

                        <td><?php 
                        echo $newprepro -> convert_negation($emoticonconverted);
                        $negationconverted = $newprepro -> convert_negation($emoticonconverted);

                        ?></td>

                              <td><?php 
              
                        echo $newprepro -> tokenizer2($negationconverted);
                        $tokenized = $newprepro -> tokenizer2($negationconverted);
                        ?></td>
         <td><?php 
              
                        echo $newprepro -> stopword_removal($tokenized);
                        $stopwordremoved = $newprepro -> stopword_removal($tokenized);
                       
                        ?></td>


   <td><?php 
                
        
                        echo $newprepro -> stemming($negationconverted);
                        ?></td>
</tr>        <?php }  ?>






 
</table>




</body>
</html>