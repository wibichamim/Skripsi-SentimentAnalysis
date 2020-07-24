<?php

/*
* Information Retrievel

*/

define("DOC_ID", 0);
define("TERM_POSITION", 1);

class IR {

    public $num_docs = 0;

    public $corpus_terms = array();
    
    public $doc = array();
    

/*
* Setup D
*/

	function getdoc()
	{
		include '../koneksi.php';
		$query = "SELECT * FROM `data_training`";
		$sql = mysqli_query($koneksi,$query);
		while($row=mysqli_fetch_array($sql))
		{
			$array[]= trim($row['tweet_preprocessing']);
		//	$array[]= $row['kalimat'];
		}
		return $array;
	}

	function getdoccoba()
	{
		include '../koneksi.php';
		$query = "SELECT * FROM `data_coba`";
		$sql = mysqli_query($koneksi,$query);
		while($row=mysqli_fetch_array($sql))
		{
			$array[]= trim($row['kalimat']);
		//	$array[]= $row['kalimat'];
		}
		return $array;
	}

	function getword()
	{
		include '../koneksi.php';
		$query = "SELECT * FROM `data_training_kata`";
		$sql = mysqli_query($koneksi,$query);
		while($row=mysqli_fetch_array($sql))
		{
			$array[]= trim($row['nama_kata']);
		//	$array[]= $row['kalimat'];
		}
		return $array;
	}




		function show_docs($doc) {
    $jumlah_doc = count($doc);
    for($i=0; $i < $jumlah_doc; $i++) {
    echo "Dokumen ke-$i : $doc[$i] <br>       ";
    }
    }




/*
* Membuat  Index
*/
function create_index($D) {
$this->num_docs = count($D);
for($doc_num=0; $doc_num < $this->num_docs; $doc_num++) {

$doc_terms = array();
// simplified word tokenization process
$doc_terms = explode(" ", $D[$doc_num]);

$num_terms = count($doc_terms);
for($term_position=0; $term_position < $num_terms; $term_position++) {
$term = strtolower($doc_terms[$term_position]);
$this->corpus_terms[$term][]=array($doc_num, $term_position);
}
}
}

/*
* Show Index
*
*/
function show_index() {

ksort($this->corpus_terms);

foreach($this->corpus_terms AS $term => $doc_locations) {
echo "<b>$term:</b> ";
foreach($doc_locations AS $doc_location)
echo "{".$doc_location[DOC_ID].", ".$doc_location[TERM_POSITION]."} ";
echo "<br />";
}
}

/*
* Menghitung Term Frequency (TF)
*
*/
function tf($term) {
$term = strtolower($term);
return count($this->corpus_terms[$term]);
}

/*
* Menghitung Number Documents With
*
*/

function andw($term) {
	$term = strtolower($term);
	$doc_locations = $this->corpus_terms[$term];
	$num_locations = count($doc_locations);
	$docs_with_term = array();
	for($doc_location=0; $doc_location < $num_locations; $doc_location++)
	{
	$docs_with_term[$i]++;
	//return count($docs_with_term);
	}
	}

	function ndw($term){
		$doc_locations = $this->corpus_terms[$term];
		$temp = array();
		$i=0;
	
		foreach ($doc_locations as $value) {
			$temp[$i] = $value[0];
			$i++;
		}
	
		return count(array_count_values($temp));
	}
	
        
    /*
    * Menghitung Inverse Document Frequency (IDF)
    *
    */
    function idf($term) {
		include '../koneksi.php';
  $d = $this->num_docs;
  $dfj = $this->ndw($term);
  echo "<br>";
  echo $term;
	$idf = round (log($d/$dfj,10),3);
	
	//$truncatetable= "TRUNCATE TABLE `data_temp`";
 //mysqli_query($koneksi, "insert into `data_temp` (`nama_kata`,`idf`) values ('$term','$idf')");
  return $idf ;
}




	function tfidf($tf,$idf,$term,$ndw)
	{
		$d = $this->num_docs;
		echo $d;

		include '../koneksi.php';
		$total = $tf * $idf;
		//$total = round($tf*(log($d/$ndw,10)+1),3);

	//	echo "TF : " .$tf;
	//	echo "<br>IDF : " .$idf;
		//$total = floatval(str_replace(',', '.', str_replace('.', '', $total)));
	//	echo "<br>Total :" .$total;
	//$truncatetable= "TRUNCATE TABLE `data_training_kata`";
 //mysqli_query($koneksi, $truncatetable);
 //mysqli_query($koneksi, "insert into `data_training_kata` (`nama_kata`,`bobot_tfidf`) values ('$term','$total')");
 $query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `bobot_tf` = '$tf', `bobot_idf`='$idf', `bobot_tfidf` = '$total' WHERE `nama_kata` = '$term'");

	return $total;
	}


	 




	function coba_tambah() {
		include '../koneksi.php';
	//	$jumlah_doc = count($doc);
	//	for($i=0; $i < $jumlah_doc; $i++) {
	//	echo "Dokumen ke-$i : $doc[$i] <br>       ";
	//	$this -> idf($term);
	//	}
	$query_dok = mysqli_query($koneksi,"SELECT * FROM `data_train_tes`");
	while ($row_dok =  mysqli_fetch_array($query_dok)) {
		$idt = $row_dok['id_training'];
		$kal = $row_dok['tweet_preprocessing'];

		$prob_kata_positif = []; $prob_kata_negatif = [];
//		$kata_hasil = explode(' ', $kata_dok);
		$kata_dok = $row_dok['tweet_preprocessing'];
		$kata_hasil = explode(' ', $kata_dok);

		foreach($kata_hasil as $key)
	{
		//echo $key ."<br>";
		$query_bobot_kata = mysqli_query($koneksi,"SELECT * FROM `data_temp` WHERE `nama_kata` = '".$key."'");
		while ($row_kata = mysqli_fetch_array($query_bobot_kata))
			{
				if ($key == $row_kata['nama_kata']) {
					$prob_kata_positif[$key] = $row_kata['idf'];
					}
					else
					{
					$prob_kata_positif[$key] = 0;
					}
			}
		}

		$r = $key;
		$kata1 = implode(' ', $prob_kata_positif);
		$kata = explode(' ', $kata1);
		
		$total = 0;
		foreach ($kata as $isi) {
			# code...
		if ($isi){
			$total = array_sum($kata);
		}
	
	}
	$wat = array($idt => $total);
	//$wat = explode(" ", $idt => $total);
	print_r($wat);
	//	echo "Jumlah(b) =" .array_sum($kata)."<br>";
	//	echo $prob_kata_negatif ."<br>";
	$query_simpan = mysqli_query($koneksi, "UPDATE `data_train_tes` SET `relevansi` = '.$total.' WHERE `id_training` = '$idt'");

	
}

	
	

	}


	function coba_set_relevansi() {
		include '../koneksi.php';
	$query_dok = mysqli_query($koneksi,"SELECT * FROM `data_coba`");
	while ($row_dok =  mysqli_fetch_array($query_dok)) {
		$idt = $row_dok['id_training'];
		$kal = $row_dok['kalimat'];

		$prob_kata_positif = []; $prob_kata_negatif = [];
//		$kata_hasil = explode(' ', $kata_dok);
		$kata_dok = $row_dok['kalimat'];
		$kata_hasil = explode(' ', $kata_dok);

		foreach($kata_hasil as $key)
	{
		//echo $key ."<br>";
		$query_bobot_kata = mysqli_query($koneksi,"SELECT * FROM `data_temp` WHERE `nama_kata` = '".$key."'");
		while ($row_kata = mysqli_fetch_array($query_bobot_kata))
			{
				if ($key == $row_kata['nama_kata']) {
					$prob_kata_positif[$key] = $row_kata['tfidf'];
					}
					else
					{
					$prob_kata_positif[$key] = 0;
					}
			}
		}

		$r = $key;
		$kata1 = implode(' ', $prob_kata_positif);
		$kata = explode(' ', $kata1);
		
		$total = 0;
		foreach ($kata as $isi) {
			# code...
		if ($isi){
			$total = array_sum($kata);
		}
	
	}
	$wat = array($idt => $total);
	//$wat = explode(" ", $idt => $total);
	echo "<pre>";
	print_r($wat);
	echo "</pre>";
	//$total  = floatval($total);

//	$total = number_format($total,3);
$total = floatval(str_replace(',', '.', str_replace('.', '', $total)));
echo $total;
	//	echo "Jumlah(b) =" .array_sum($kata)."<br>";
	//	echo $prob_kata_negatif ."<br>";
	$query_simpan = mysqli_query($koneksi, "UPDATE `data_coba` SET `bobot` = '.$total.' WHERE `id_training` = '$idt'");

}
	}


}

	
			
			
			
			
		
	
	
			
    
	
	
	


    
?>