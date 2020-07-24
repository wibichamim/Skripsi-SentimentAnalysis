<?php


$array = [0.0294118,0.0294118,0.0294118,0.0441176];


$total = 1;
foreach ($array as $isi) {
	# code...
	$total = $total*$isi;
}

echo $total;
echo "<br>";
echo number_format($total,10)."<br>";

?>