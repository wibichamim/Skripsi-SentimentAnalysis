<?php

require_once '../vendor/autoload.php';

 require_once "../koneksi.php";
 include '../class_lib.php';
 $newprepro = new preprocessing();

?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
 <table>



 <?php 


        $nomor = 1;
        $sql = mysqli_query($koneksi,"select * from data_training");

        while($data = mysqli_fetch_array($sql)){
           $id = $data['id_training'];
        ?>
        <tr>
            <th><?php echo $nomor++; ?></td>
<?php
             $datatweet = $data['tweet_text'];
            ?>

             <!-- Case Folding / mengubah huruf kapital menjadi huruf kecil -->

            <td>
                <?php
                    $casefolded = $newprepro -> case_folding($datatweet);
                ?>

             <!-- Cleansing / membersihkan data tweet seperti angka, tanda baca, link, hastag, mention -->

                <?php 
                    $newprepro -> cleansing($casefolded);
                    $cleansed = $newprepro -> cleansing($casefolded);
                ?>

            <!-- Convert Emoticon / mengubah symbol emoticon pada tweet kedalam teks bahasa Indonesia -->

                <?php 
                    $emoticonconverted = $newprepro -> convert_emoticon($cleansed);
                ?>

            <!-- Convert Negation / mengubah artikata yang bersifat negasi dari kata – kata positif ke kedalam kata negatif dan juga sebaliknya -->

                <?php 
                    $negationconverted = $newprepro -> convert_negation($emoticonconverted);
                ?>

        
            <!-- Tokenizing / memisahkan setiap kata yang dihubungkan dengan karakter spasi menjadi setiap kata yang dihimpun pada array. -->
                     
                <?php 
                    $tokenized = $newprepro -> tokenizing($negationconverted);
                ?>
                
            <!-- Normalization  -->
                     
            <?php 
                    $normalization = $newprepro -> normalization($tokenized);
                ?>
                


                  <!-- Stopword Removal / menghilangkan kata yang tidak berpengaruh dalam proses sentimen -->

                <?php
                    $stopwordremoved = $newprepro -> stopword_removal($normalization);

                    ?>


     <!-- Stemming / mengubah kata yang berimbuhan menjadi kata dasar -->

                <?php
                    $stemmed =  $newprepro -> stemming($stopwordremoved);
          

                    echo $stemmed;


          //         mysqli_query($koneksi, 'insert into data_train_tes (tweet) values (\'' . $stemmed . '\');');    
                 
                mysqli_query($koneksi, 'UPDATE `data_training` SET `tweet_preprocessing` = (\'' . $stemmed . '\') WHERE `id_training` = (\'' . $id . '\');');   
                        $piecesA = explode(' ', $stemmed);
                        foreach($piecesA as $piece)
                 mysqli_query($koneksi, 'insert into data_training_kata (nama_kata) values (\'' . $piece . '\');');    
               // mysqli_query($koneksi, 'insert into data_training_kata (nama_kata) values (\'' . $piece . '\');');    
                      //    mysqli_query($koneksi, "INSERT INTO `data_train_kata` (`nama_kata`) VALUES ".$piece."");   
                     //    mysqli_query($koneksi, 'insert into data_preprocessing (tweet) values (\'' . $stemmed . '\');');    
                                  ?>
           </td>        <!-- Stopword Removal / menghilangkan kata yang tidak berpengaruh dalam proses sentimen -->


             <td>
<?php  }


?>
             </td>

  
</tr>        






 
</table>




</body>
</html>