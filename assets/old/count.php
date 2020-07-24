<?php
  // your db connection ...
  include 'koneksi.php';


$query = mysqli_query($koneksi,"select * from `data_train`");
while ($newsitem =  mysqli_fetch_array($query)) {

 $a = $newsitem['tweet_text'];
 $stoplist[]= $newsitem['tweet_preprocessing'];

  $hasil_buah = implode(" ",$stoplist);

$pieces = explode(' ', $hasil_buah);
foreach($pieces as $piece)
    mysqli_query($koneksi, 'insert into data_training_kata (nama_kata) values (\'' . $piece . '\');');

    }
  ?>