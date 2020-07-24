<?php
require 'vendor/autoload.php';
 
// Meload library Sastrawi
$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
$stemmer  = $stemmerFactory->createStemmer();
 
// Menjalankan stemming pada kalimat yang ditentukan
$sentence = 'Perekonomian Indonesia sedang dalam pertumbuhan yang membanggakan';
$output   = $stemmer->stem($sentence);
 
echo $output . "\n"; // Menampilkan hasil stemming
?>