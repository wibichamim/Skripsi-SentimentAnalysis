<?php

include "IR.php";
// document yang sebagai percobaan

//$D[0] = "membantu berjualan suka aplikasi efisien praktis aman";
//$D[1] = "membantu transaksi jual beli aman";
//$D[2] = "aplikasi jual beli aman fitur lengkap";
$D = array("membantu berjualan suka aplikasi efisien praktis aman",
"membantu transaksi jual beli aman",
"aplikasi jual beli aman fitur lengkap",);


$ir = new IR();

echo "<p><b>Corpus:</b></p>";


//$D = $ir->getdoc();
//$a = explode(" ",$ir->aa());
echo "<pre>";
print_r($D);

//print_r($doc);
echo "</pre>";

echo "<br>";
echo "<br>";
$ir->show_docs($D);

$ir->create_index($D);

echo "<p><b>Inverted Index:</b></p>";
$ir->show_index();

///include 'koneksi.php';
//$sql =  mysqli_query($koneksi,"");
//$array = ['handphone','harga','awet',];
$array = ['transaksi','membantu','aman',];
//$array = $ir->getword();
foreach($array as $term)
{


//$term = "membantu";  //kata asyik yang akan menjadi pusat perhitungan kita

$tf  = $ir->tf($term);
$ndw = $ir->ndw($term);
$idf = $ir->idf($term);
$tfidf = $ir->tfidf($tf,$idf,$term);

echo "<p>";
echo "Term Frequency of $term is $tf<br />";
echo "Number Of Documents with $term is $ndw<br />";
echo "Inverse Document Frequency of $term is $idf<br />";
echo "TF-IDF of $term is $tfidf";
echo "</p>";

}

//$ir->coba_tambah();



?>