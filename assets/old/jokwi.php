<?php


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
    
        echo '<br>';
        echo  $anus ." : " . count($tes['kata_tidak_boleh']);

        $asiap = array($anus => $ehe);    
    }
    print_r ($asiap);
}


$termquery = ['membantu','transaksi','aman'];

$anu = array("membantu berjualan suka aplikasi efisien praktis aman"
,"membantu transaksi jual beli aman"
,"aplikasi jual beli aman fitur lengkap"
);


foreach($anu as $ez)
{
    echo $ez."<br>";
    wtf($ez,$termquery);
    echo '<br>';
    echo '----------';
    echo '<br>';
    echo '<br>';
}





?>