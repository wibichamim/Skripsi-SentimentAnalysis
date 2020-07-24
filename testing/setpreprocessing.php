<?php

//require_once __DIR__ . "../vendor/autoload.php";

require_once '../vendor/autoload.php';
require_once '../koneksi.php';
require_once '../class_lib.php';
 $newprepro = new preprocessing();


        $sql = mysqli_query($koneksi,"select * from data_training");


        while($data = mysqli_fetch_array($sql)){
           $id = $data['id_training'];
 
             $datatweet = $data['tweet_text'];
    

             $emoticonconverted = $newprepro -> convert_emoticon($datatweet);
             $casefolded = $newprepro -> case_folding($emoticonconverted);
             
             
             $cleansed = $newprepro -> cleansing($casefolded);
         
         
             
             $negationconverted = $newprepro -> convert_negation($cleansed);
             
             
             $tokenized = $newprepro -> tokenizing($negationconverted);
           //  $normalized = $newprepro -> normalization($tokenized);
             
           //  $newprepro -> stopword_removal($normalized);
             $stopwordremoved = $newprepro -> stopword_removal($tokenized);
             
             $stemmed =  $newprepro -> stemming($stopwordremoved);
             echo $stemmed ."<br>";
             
        
              //     mysqli_query($koneksi, 'insert into data_train_tes (tweet) values (\'' . $stemmed . '\');');    
                 
              //   mysqli_query($koneksi, 'UPDATE `data_testing` SET `tweet_preprocessing` = (\'' . $stemmed . '\') WHERE `id_training` = (\'' . $id . '\');');   
              $piecesA = explode(' ', $stemmed);
              foreach($piecesA as $piece)
                         mysqli_query($koneksi, "INSERT INTO `data_train_kata` (`nama_kata`) VALUES ".$piece."");   
                     //    mysqli_query($koneksi, 'insert into data_preprocessing (tweet) values (\'' . $stemmed . '\');');    
                              
              // <!-- Stopword Removal / menghilangkan kata yang tidak berpengaruh dalam proses sentimen -->

  } 


?>
             
