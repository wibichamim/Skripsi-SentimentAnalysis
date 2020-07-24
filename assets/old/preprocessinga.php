<form method="post">
    <input type="submit" name="test" id="test" value="RUN" /><br/>
</form>

<?php

function testfun()
{
   echo "Your test function on button click is working";
}

function case_folding()
{
	return strtolower($tweet);
	// menginput data ke database
mysqli_query($koneksi,"INSERT INTO `data_preprocessing` (`username`,
`id_tweet`, `tweet`, `tanggal`) VALUES ('".$user."', ".$id_tweet.",
'".$text."', '".$date."')");

}

if(array_key_exists('test',$_POST)){
   case_folding();
}

?>