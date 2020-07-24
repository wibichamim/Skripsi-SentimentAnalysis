<?php
  function getpositif()
 {
     include 'koneksi.php';
     $query = mysqli_query($koneksi,"select * from `data_train` where sentimen='N'");
     while ($rowd =  mysqli_fetch_array($query))
     {
         $a = $rowd['tweet_preprocessing']; 
         $array[]= $rowd['tweet_preprocessing'];

         $value = implode(" ",$array);
     }
     print_r($value);
     return $value;
 }



function kata_sensor($string, $sensor){
    $kata_tidak_boleh = array();
    $kata_boleh = array();
    //menghilangkan tanda titik (jika ada)
    $str = str_replace(".", "", $string);
    $explode = explode(" ", $str);  
    foreach ($explode as $e) {
        // cek tiap kata menggunakan in array case insensitive
        if (in_arrayi($e, $sensor)) {
            // jika ada dalam sensor, tambahkan dalam kata tidak boleh
            $kata_tidak_boleh[] = $e;
        } else {
            // jika tidak ada, tambahkan dalam kata boleh
            $kata_boleh[] = $e;
        }
    }
    // beri return berupa array
    return array(
        'kata_tidak_boleh' => $kata_tidak_boleh,
        'kata_boleh' => $kata_boleh,
    );
}


//case insensitive in array
function in_arrayi($needle, $haystack) {
    return in_array(strtolower($needle), array_map('strtolower', $haystack));
}


function definesensor()
{
    include 'koneksi.php';
    $query = mysqli_query($koneksi,"SELECT * FROM `data_training_kata` ORDER BY `nama_kata` ASC");
    while ($rowda =  mysqli_fetch_array($query))
    {
        $sensor[] = $rowda['nama_kata'] ;
    }
    return $sensor;
}

function wtf($str,$sensor)
{
    include 'koneksi.php';

    $snew = (array_chunk($sensor, 1));

    foreach($snew as $acsa)
    {
        $kalimat = $str;
        $tes = kata_sensor($kalimat, $acsa);
        $anus = implode("",$acsa);

        $ehe =  count($tes['kata_tidak_boleh']);
        $hilangpositif =  count($tes['kata_boleh']);

        $query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `fm_negatif` = ".$ehe." WHERE `nama_kata` = '$anus'");
        $query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `fh_negatif` = ".$hilangpositif." WHERE `nama_kata` = '$anus'");
        echo $anus;
        echo '<br>';
        echo "Kata yang cocok : " . count($tes['kata_tidak_boleh']) . ", yaitu " . implode(', ', $tes['kata_tidak_boleh']);
        echo '<br>';
        echo "Kata yang tidak cocok : " . count($tes['kata_boleh']) . ", yaitu " . implode(', ', $tes['kata_boleh']);
        echo '<br>';
        //echo "Kata yang tidak cocok :  " . count($tes['kata_boleh']) . ", yaitu " . implode(', ', $tes['kata_boleh']);
        echo '<br>';

    }

}



    $a = explode(" ",getpositif());
    echo ("<pre>");

   // print_r($a);
    
    $str = "";
	foreach($a as $val) {
        $str .= $val . " ";
    }

   $ada = definesensor();
   wtf($str,$ada);



    


?>

    