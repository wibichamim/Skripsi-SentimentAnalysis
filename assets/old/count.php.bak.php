<?php
  // your db connection ...
  include 'koneksi.php';

  // array with good and bad words
  $good = [
    'bagus',
  
  ];

 

  // if you keep using your string approach you can set $good and $bad with $good = explode(' ', $goodwords); and $bad = explode(' ', $badwords);
$query = mysqli_query($koneksi,"select * from `data_train` where kategori='P'");
while ($newsitem =  mysqli_fetch_array($query)) {
 $a = $newsitem['tweet_text'];
 $stoplist[]= $newsitem['tweet_text'];

  $hasil_buah = implode(", ",$stoplist);

  // set up good and bad word counters
  $totalGood = 0;
  $totalBad = 0;

  // check how many times each word is mentioned in newscontent
  foreach($good as $word) { 
    // add spaces arround the word to make sure the full word is matched, not a part
    $totalGood += substr_count($newsitem['tweet_text'], ' ' . "bagus". ' ');
    
  }


 
}

echo  $hasil_buah;
echo "<br>";

    $totalGood += substr_count($hasil_buah, "bagus");

echo "<br>";

echo  $totalGood;


$str = "This is a test"; 
$pieces = explode(' ', $str);
foreach($pieces as $piece)
    mysqli_query($koneksi, 'insert into test (words) values (\'' . $piece . '\');');

  ?>