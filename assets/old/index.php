<?php
include "koneksi.php";
 // load library twitteroauth
 require_once __DIR__.'/twitteroauth/autoload.php';
 use Abraham\TwitterOAuth\TwitterOAuth;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Getwit</title>
</head>
<body>
    <form action="preprocessing.php" method="GET">

	<button>Case Folding</button>

</form>
<?php



 $key = 'V4kr05Sti3Ndx7tl1YUOFS5Bl';
 $secret_key = 'G6wQaAhOqBv431uh63laeROCwficaFRj562BFIXussUM94C8tI';
 $token = '526183118-rE3GiwXSmSiqdy6CEP5nzHRjzV8pXu1fq1OeQlxI';
 $secret_token = 'bEhZ2hgE5j3ijEkg26xQTMrOfFodgi2iV0pezWz06qoaN';

 $conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);
 $response_twet = $conn->get('statuses/home_timeline', array('count'=>25, 'exclude_replies'=>true));


for ($j=7; $j >= 0 ; $j--) {
$tanggal_crawling = date('Y-m-d', strtotime('-'.$j.' days', strtotime(
date('Y-m-d') )));
$tweets = $conn->get('search/tweets', array('q'=>"Xiaomi",
'count'=>100, 'lang'=>'in', 'until'=>$tanggal_crawling));
foreach ($tweets->statuses as $tweet) {
static $i=0;
$i+=1;
$id_tweet = $tweet->id;
$user = $tweet->user->screen_name;
$text = $tweet->text;
$date = date('Y-m-d', strtotime($tweet->created_at));
?>
<pre>
<?php
echo "Username : ";

print_r ($user);
echo "<br>Tweet : ";
print_r ($text);
echo "<br>";
print_r ($id_tweet);
echo "<br>";
print_r ($date);
echo "<br>";




// menginput data ke database
mysqli_query($koneksi,"INSERT INTO `data_train_tes` (`tweet_text`) VALUES ('".$text."')");

?>
</pre>
<?php
}
}


?>
</body>
</html>
