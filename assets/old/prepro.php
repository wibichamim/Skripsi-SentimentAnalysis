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
        <th>Stemming</th>
        <th>Tokenizing</th>
        <th>Stopword removal</th>
        <th>Normalizarion</th>



    </tr>


 <?php 


        $nomor = 1;
        $sql = mysqli_query($koneksi,"select * from data_train");

            //." and nilai.id_guru=" .$_SESSION['nik']);

        while($data = mysqli_fetch_array($sql)){
           $id = $data['id_training'];
        ?>
        <tr>
            <th><?php echo $nomor++; ?></td>
            <td align="center"><?php echo $data['id_training']; ?></td>
            <td><?php echo $data['tweet_text']; ?></td>
<?php
             $datatweet = $data['tweet_text'];
            ?>

             <!-- Case Folding / mengubah huruf kapital menjadi huruf kecil -->

            <td>
                <?php
                    $casefolded = $newprepro -> case_folding($datatweet);
                ?>
            </td>

             <!-- Cleansing / membersihkan data tweet seperti angka, tanda baca, link, hastag, mention -->

            <td>
                <?php 
                    $newprepro -> cleansing($casefolded);
                    $cleansed = $newprepro -> cleansing($casefolded);
                ?>
           </td>

            <!-- Convert Emoticon / mengubah symbol emoticon pada tweet kedalam teks bahasa Indonesia -->

           <td>
                <?php 
                    $emoticonconverted = $newprepro -> convert_emoticon($cleansed);
                ?>
           </td>

            <!-- Convert Negation / mengubah artikata yang bersifat negasi dari kata – kata positif ke kedalam kata negatif dan juga sebaliknya -->

           <td>
                <?php 
                    $negationconverted = $newprepro -> convert_negation($emoticonconverted);
                ?>
           </td>

            <!-- Stemming / mengubah kata yang berimbuhan menjadi kata dasar -->

           <td>
                <?php
                    $stemmed =  $newprepro -> stemming($negationconverted);
                ?>
            </td>
      
            <!-- Tokenizing / memisahkan setiap kata yang dihubungkan dengan karakter spasi menjadi setiap kata yang dihimpun pada array. -->
                     
           <td>
                <?php 
                    $tokenized = $newprepro -> tokenizer2($stemmed);
                ?>
           </td>

           <!-- Stopword Removal / menghilangkan kata yang tidak berpengaruh dalam proses sentimen -->

           <td>
                <?php
                    echo $newprepro -> stopword_removal($tokenized);
                    $stopwordremoved = $newprepro -> stopword_removal($tokenized);
                ?>
           </td>        <!-- Stopword Removal / menghilangkan kata yang tidak berpengaruh dalam proses sentimen -->



  
</tr>        <?php }  ?>






 
</table>




</body>
</html>