<?php
class preprocessing{


public function case_folding($tweet){
return strtolower($tweet);
}

public function acleansing($tweet){
$tweet = explode(' ', $tweet);
$tweet_hasil = [];
foreach ($tweet as $tweet_kata) {
if ($tweet = preg_match('/pic.twitter.com/', $tweet_kata)) {
$tweet_kata = "";
} else {
array_push($tweet_hasil, $tweet_kata);
}

if ($tweet = preg_match('/[0-9]/', $tweet_kata)) {
$tweet_kata = "";
} else {
array_push($tweet_hasil, $tweet_kata);
}
}
$tweet = implode(' ', $tweet_hasil);
$tweet = str_replace("?", " ", $tweet);
$tweet=str_replace("\r\n","",$str);
$tweet = str_replace(".", " ", $tweet);
$tweet = str_replace(",", " ", $tweet);
$tweet = str_replace(":", " ", $tweet);
$tweet = preg_replace('/@[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~\n_|$]/i',' ', $tweet);
$tweet = preg_replace('/#[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i',' ', $tweet);

$tweet = preg_replace('/\b(https?|ftp|file|http):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i',' ', $tweet);
$tweet = preg_replace('/rt | â€¦/i', '', $tweet);
}


function cleansing($tweet){
// $tweet = iconv("UTF-8","ISO-8859-1//IGNORE", $tweet);
//mention
$tweet = preg_replace('/@[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i','', $tweet);
//hashtag
$tweet = preg_replace('/#[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i','', $tweet);
// link
$tweet = preg_replace('/\b(https?|ftp|file|http):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i','', $tweet);
$tweet = preg_replace('/rt | â€¦/i', '', $tweet);
//hapus http
$tweet = str_replace("…", "", $tweet);
// $tweet = str_replace("http", "", $tweet);
// $tweet = str_replace(" rt", "", $tweet);
// $tweet = str_replace(" rt ", "", $tweet);
// $tweet = str_replace("rt ", "", $tweet);
return $tweet;
}


function convert_emoticon($tweet)
{
$esenang = array("❤️","😍","😊",":)",":o)",":]",":3",":c)",":>","=]","8)","=)",":}",":>)",":D",":-D");
$esedih = array(">:[",":(",
	":-(",":(",":'(",":-c",":c",":-<",":-[",":[",":{",">.>","<.<",">.<",":/");
foreach ($esenang as $item){
$quotedSenang[] = preg_quote($item,'#');
}
$regexSenang = implode('|', $quotedSenang);
$fullSenang = '#(^|\W)('.$regexSenang.')($|\W)#';
foreach ($esedih as $item){
$quotedSedih[] = preg_quote($item,'#');
}
$regexSedih = implode('|', $quotedSedih);
$fullSedih = '#(^|\W)('.$regexSedih.')($|\W)#';
$tweet = preg_replace($fullSenang, ' emojipositif ', $tweet);
$tweet = preg_replace($fullSedih, ' emojinegatif ', $tweet);
return $tweet;
}

function convert_negation($tweet){
$list = array(
'gak ' => 'gak',
'ga ' => 'ga',
'ngga ' => 'ngga',
'tidak ' => 'tidak',
'bkn '=>'bkn',
'tida '=>'tida',
'tak '=>'tak',
'jangan '=>'jangan',
'enggak '=>'enggak',
'gak ' => 'gak',
'ga ' => 'ga',
'ngga ' => 'ngga',
'tidak ' => 'tidak',
'bkn '=>'bkn',
'tida '=>'tida',
'tak '=>'tak',
'jangan '=>'jangan',
'enggak '=>'enggak'
);
$patterns = array();
$replacement = array();
foreach ($list as $from => $to)
{
	$from = '/\b' . $from . '\b/';
$patterns[] = $from;
$replacement[] = $to;
}
return $tweet = preg_replace($patterns, $replacement, $tweet);
$tweet;
}



function tokenizer($tweet){
$tweet = stripcslashes($tweet);
//karakter
$tweet = preg_replace('/[-0-9+&@#\/%?=~_|$!:^>`{}<*,.;()"-$]/i', '', $tweet);
//hapus satu karakter
$tweet = preg_replace('/\b\w\b(\s|.\s)?/', '', $tweet);
//hapus bracket
$tweet = preg_replace("/[\[(.)\]]/", '', $tweet);
//hapus kutip satu
$tweet = str_replace("'", "", $tweet);
$tweet = preg_replace('/\s+/', ' ', $tweet);
$tweet = trim($tweet);
return $tweet;
}

function tokenizer2($teks){
$teks = explode(" ", $teks);
$teks = implode(" ", $teks);
return $teks;
}

function stopword_removal($tweet){
		include 'koneksi.php';

$stoplist = array();
        $aquery = mysqli_query($koneksi,"select * FROM tb_kata_stopword");
        while($key = mysqli_fetch_array($aquery)){

	$stoplist[]= $key['stopword'];
}
$tweet = preg_replace('/\b('.implode('|',$stoplist).')\b/','',$tweet);
return $tweet;
}

function stemming($tweet){
require 'vendor/autoload.php';

$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
$stemmer = $stemmerFactory->createStemmer();
$sentence = $tweet;
$output = $stemmer->stem($sentence);

 
return $output . ""; // Menampilkan hasil stemming
}

public function normalization($tweet){
	 		include 'koneksi.php';


$kata_tweet = $tweet;
$i = 0;
foreach ($kata_tweet as $kata_hasil) {
   $query_inggris = mysqli_query($koneksi,"SELECT * FROM tb_kata_inggris
WHERE inggris_kata = '".$kata_hasil."'");

if ($row = $query_inggris->mysqli_fetch_array()) {
$kata_tweet[$i] = $row[2];
}
$i++;
}
$kata = implode(' ', $kata_tweet);
return $kata;
}



}

class featureselection
{





	

public function entropy_set() {
$jml_p = 100;
$jml_n = 50;
$jml_t = 40;
$entropy_set = round((-((($jml_p/$jml_t)*log($jml_p/$jml_t,2))+
($jml_n/$jml_t)*log($jml_n/$jml_t,2))),4);
return $entropy_set;
}
public function set_info_gain() {
include 'koneksi.php';
$entropy_set = $this->entropy_set();
$query = mysqli_query($koneksi, "SELECT `id_kata`, `entropy_kata` FROM
`data_training_kata` ORDER BY `id_kata` ASC");

while ($row = mysqli_fetch_array($query)){

$ig = round($entropy_set - $row['entropy_kata'],9);
$query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata` SET
`bobot_ig` = ".$ig." WHERE `id_kata` = ".$row['id_kata']."");
}
}

}
?>