<?php
 // load library twitteroauth
 require_once __DIR__.'/twitteroauth/autoload.php';
 use Abraham\TwitterOAuth\TwitterOAuth;
 
class aksidatabase
{
    function truncate_kata($koneksi)
    {
        $query_hapus = mysqli_query($koneksi, "TRUNCATE TABLE `data_training_kata`");
    }

    function hitung_total_datatraining($koneksi)
    {
        $sql = mysqli_query($koneksi,"SELECT count(`id_training`) as total FROM `data_train`");
        while($data = mysqli_fetch_array($sql))
        {
        return $data['total'];
        }
    }

    function hitung_tweet_positif_datatraining($koneksi)
    {
        $sql = mysqli_query($koneksi,"SELECT * FROM `data_train` where `sentimen`='P'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_negatif_datatraining($koneksi)
    {
        $sql = mysqli_query($koneksi,"SELECT * FROM `data_train` where `sentimen`='N'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function resetbobotbayes($koneksi)
    {
        $query_hapus = mysqli_query($koneksi, "update `data_training_kata` set `bobot_bayes_negatif`='', `bobot_bayes_positif`=''");
        header("Location: bobotbayes.php");

    }

    function reset_information_gain($koneksi)
    {
        $query_hapus = mysqli_query($koneksi, "update `data_training_kata` set `bobot_ig`='', `entropy_kata`='', `fm_positif`='', `fh_positif`='', `fm_negatif`='', `fh_negatif`=''
        , `en_po`='', `en_ne`=''");
        header("Location: informationgain.php");

    }


    function hitung_total_datatesting($koneksi)
    {
        $sql = mysqli_query($koneksi,"SELECT count(`id_training`) as total FROM `data_train_tes`");
        while($data = mysqli_fetch_array($sql))
        {
        echo $data['total'];
        }
    }

    function hitung_tweet_positif_datatesting($koneksi)
    {
        $sql = mysqli_query($koneksi,"SELECT * FROM `data_train_tes` where `sentimen`='Positif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_negatif_datatesting($koneksi)
    {
        $sql = mysqli_query($koneksi,"SELECT * FROM `data_train_tes` where `sentimen`='Negatif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_total_positif($koneksi)
    {
        
        $total = $this -> hitung_tweet_positif_datatesting($koneksi) + $this -> hitung_tweet_positif_datatraining($koneksi);
        return $total; 
    }

    function hitung_total_negatif($koneksi)
    {
        
        $total = $this -> hitung_tweet_negatif_datatesting($koneksi) + $this -> hitung_tweet_negatif_datatraining($koneksi);
        return $total; 
    }

    
    
}


class preprocessing
{
    public function case_folding($tweet)
    {
        return strtolower($tweet);
    }

    function cleansing($tweet)
    {
        // $tweet = iconv("UTF-8","ISO-8859-1//IGNORE", $tweet);
        //mention
        $tweet = preg_replace('/@[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i','', $tweet);
        //hashtag
        $tweet = preg_replace('/#[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i','', $tweet);
        // link
        $tweet = preg_replace('/\b(https?|ftp|file|http):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i','', $tweet);
        //hapus http
        $tweet = str_replace("…", "", $tweet);
        $tweet = str_replace("—", "", $tweet);
        $tweet = str_replace("!", "", $tweet);
        $tweet = str_replace("@", "", $tweet);
        $tweet = str_replace("[]", "", $tweet);
        $tweet = str_replace("()", "", $tweet);
        $tweet = str_replace("-", "", $tweet);
        $tweet = str_replace("?", "", $tweet);
        $tweet = str_replace(" | ", "", $tweet);
        $tweet = str_replace("http", "", $tweet);

        $tweet = explode(' ', $tweet);
        $tweet_hasil = [];
        foreach ($tweet as $tweet_kata) {
        if ($tweet = preg_match('/pic.twitter.com/', $tweet_kata)) {
        $tweet_kata = "";
        } 
        if ($tweet = preg_match('/[0-9]/', $tweet_kata)) {
            $tweet_kata = "";
            } else {
            array_push($tweet_hasil, $tweet_kata);
            }
            }
            $tweet = implode(' ', $tweet_hasil);
            $tweet = str_replace("pic.twit", " ", $tweet);
            $tweet = str_replace("pic.t", " ", $tweet);

            return $tweet;
    }
    


    function convert_emoticon($tweet)
    {
        $esenang = array("❤️","😍","😊", ":))))",":))",":)",":o)",":]",":3",":c)",":>","=]","8)","=)",":}",":>)",":D",":-D",":')");
        $esedih = array("😌","ðŸ˜Œ",">:[",":'(",":')",":(",":/",":-(",":(",":'(",":-c",":c",":-<",":-[",":[",":{",">.>","<.<",">.<",":/",":(((");
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

    function convert_negation($tweet)
    {
        $list = array
        (
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
  


    public function normalization($tweet){

        $tweet = explode(" ", $tweet);
        include 'koneksi.php';

        $kata_tweet = $tweet;
        $i = 0;
        foreach ($kata_tweet as $kata_hasil) {
            $query_singkat = mysqli_query($koneksi,"SELECT * FROM tb_kata_singkatan
            WHERE singkatan_kata = '".$kata_hasil."'");
    
                while($row = mysqli_fetch_array($query_singkat))
                {
                    $kata_tweet[$i] = $row[2];
                }

                $query_baku = mysqli_query($koneksi,"SELECT * FROM tb_kata_baku
                WHERE kata_tidak_baku = '".$kata_hasil."'");
                    while($row_baku = mysqli_fetch_array($query_baku))
                    {
                        $kata_tweet[$i] = $row_baku['kata_baku'];
                    }  

                $query_inggris = mysqli_query($koneksi,"SELECT * FROM tb_kata_english
                WHERE kata_inggris = '".$kata_hasil."'");
                    while($row_inggris = mysqli_fetch_array($query_inggris))
                    {
                        $kata_tweet[$i] = $row_inggris['kata_ganti'];
                    }    
                      
       
        $i++;
        }
        $kata = implode(' ', $kata_tweet);
        return $kata;
        }

        
    function tokenizer($teks)
    {
        $teks = explode(" ", $teks);
        $teks = implode(" ", $teks);
        return $teks;
    }
        
   function stopword_removal($tweet)
   {
       include 'koneksi.php';
       $stoplist = array();
            $query = mysqli_query($koneksi,"select * FROM tb_kata_stopword");
            while($key = mysqli_fetch_array($query))
            {
                $stoplist[]= $key['stopword'];
            }
            $tweet = preg_replace('/\b('.implode('|',$stoplist).')\b/','',$tweet);
        return $tweet;
    }
       
    function stemming($tweet)
    {
        require 'vendor/autoload.php';
        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();
        $sentence = $tweet;
        $output = $stemmer->stem($sentence);     
        return $output . ""; // Menampilkan hasil stemming
    }

    function simpanpreprocessing($stemmed,$id)
    {
        include 'koneksi.php';
        mysqli_query($koneksi, 'UPDATE `data_train` SET `tweet_preprocessing` = (\'' . $stemmed . '\') WHERE `id_training` = (\'' . $id . '\');');   
        $pieces = explode(' ', $stemmed);
        foreach($pieces as $piece)
        mysqli_query($koneksi, 'insert into data_training_kata (nama_kata) values (\'' . $piece . '\');'); 
    }


    function all()
    {
        include 'koneksi.php';
        $sql = mysqli_query($koneksi,"select * from data_train");
        while($data = mysqli_fetch_array($sql)){
            $datatweet = $data['tweet_text'];

            $casefolded = $this -> case_folding($datatweet);
            $cleansed = $this -> cleansing($casefolded);
            $emoticonconverted = $this -> convert_emoticon($cleansed);
            $negationconverted = $this -> convert_negation($emoticonconverted);
            $normalization = $this -> normalization($negationconverted);
            $stopwordremoved = $this -> stopword_removal($normalization);

            $stemmed =  $this -> stemming($stopwordremoved);
           // $final = implode("",$stemmed);
           // print_r($final);
           $final = explode(' ', $stemmed);
          
           foreach($final as $piece)
           mysqli_query($koneksi, 'insert into data_training_kata (nama_kata) values (\'' . $piece . '\');');  
        }
    }


    function insertintodb($koneksi)
    {
  
    

    }

 
        
}


class information_gain
{
    public function doall($koneksi)
    {
        $this -> entropy_positif_sentimen_like($koneksi);
        $this -> entropy_positif_sentimen_notlike($koneksi);
        $this -> entropy_negatif_sentimen_like($koneksi);
        $this -> entropy_negatif_sentimen_notlike($koneksi);
        $this -> entropy_kata($koneksi);
        $this -> set_info_gain($koneksi);
    }
   
    public function entropy_positif_sentimen_like($koneksi)
    {    
      $query = mysqli_query($koneksi,"SELECT `nama_kata` FROM `data_training_kata`");
      while ($row_kata = mysqli_fetch_array($query))
        {
            $kata = $row_kata['nama_kata'];
            $querylike = mysqli_query($koneksi,"SELECT count(tweet_text) as jumlahpos FROM `data_train` where tweet_preprocessing LIKE '%" .$row_kata['nama_kata'] ."%' and sentimen = 'P'");
            while($datapositif = mysqli_fetch_array($querylike))
                {
                    $hasila = $datapositif['jumlahpos'];
                    $query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `fm_positif` = ".$hasila." WHERE `nama_kata` = '$kata'");
                }
        }
    }

    public function entropy_negatif_sentimen_like($koneksi)
    {
      $query = mysqli_query($koneksi,"SELECT `nama_kata` FROM `data_training_kata`");
      while ($row_kata = mysqli_fetch_array($query))
         {
            $kata = $row_kata['nama_kata'];
            $querylike = mysqli_query($koneksi,"SELECT count(id_training) as jumlah FROM `data_train` where tweet_preprocessing LIKE '%" .$row_kata['nama_kata'] ."%' and sentimen='N'");
            while($data = mysqli_fetch_array($querylike))
                {
                    $hasil = $data['jumlah'];
                    echo $kata ." | " .$hasil ."<br>";

                    $query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `fm_negatif` = ".$hasil." WHERE `nama_kata` = '$kata'");
                }    
         }
    }

    function entropy_positif_sentimen_notlike($koneksi)
    {
     $query = mysqli_query($koneksi,"SELECT `nama_kata` FROM `data_training_kata`");
     while ($row_kata = mysqli_fetch_array($query))
      {
        $kata = $row_kata['nama_kata'];
        $querylike = mysqli_query($koneksi,"SELECT count(id_training) as jumlahpos FROM `data_train` where tweet_preprocessing not LIKE '%" .$row_kata['nama_kata'] ."%'and sentimen='P'");
        while($datapositif = mysqli_fetch_array($querylike))
            {
                $hasila = $datapositif['jumlahpos'];
                $query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `fh_positif` = ".$hasila." WHERE `nama_kata` = '$kata'");
            }
      }
    }

    function entropy_negatif_sentimen_notlike($koneksi)
    {
     $query = mysqli_query($koneksi,"SELECT `nama_kata` FROM `data_training_kata`");
     while ($row_kata = mysqli_fetch_array($query))
      {
        $kata = $row_kata['nama_kata'];
        $querylike = mysqli_query($koneksi,"SELECT count(id_training) as jumlah FROM `data_train` where tweet_preprocessing not LIKE '%" .$row_kata['nama_kata'] ."%'and sentimen='N'");
        while($data = mysqli_fetch_array($querylike))
            {
                $hasil = $data['jumlah'];
              //  echo $kata ." | " .$hasila ."<br>";
                $query_simpan = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `fh_negatif` = ".$hasil." WHERE `nama_kata` = '$kata'");
            }
      }
    }

    function entropy_kata()

    {
    include 'koneksi.php';
      $total_positif = $this -> jt_positif($koneksi); 
      $total_negatif = $this -> jt_negatif($koneksi);
       $total_pn = $this -> jt_total($koneksi);
     $entropy_negatif_set = 0;

     $pos =mysqli_query($koneksi, "SELECT * FROM `data_training_kata` ORDER BY `nama_kata` ASC");
     while ($rowd = mysqli_fetch_array($pos)) {
     
       $idkata = $rowd['nama_kata'];
     
       $fm_positif = $rowd['fm_positif'];
       $fh_positif = $rowd['fh_positif'];
     
       $entropy_positif_set = round((-((($fm_positif/$total_positif)*log($fm_positif/$total_positif,2))+($fh_positif/$total_positif)*log($fh_positif/$total_positif,2))),4);
     
       $query_simpan_po = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `en_po` = ".$entropy_positif_set." WHERE `nama_kata` = '$idkata'");
       echo $idkata ."-" .$entropy_positif_set ."<br>";  

        }   
    
    $neg =mysqli_query($koneksi, "SELECT * FROM `data_training_kata` ORDER BY `nama_kata` ASC");
    while ($rowd = mysqli_fetch_array($neg)) {
      $idkata = $rowd['nama_kata'];
    
      $fm_negatif = $rowd['fm_negatif'];
      $fh_negatif = $rowd['fh_negatif'];

      if($fm_negatif > 0 && $fh_negatif > 0 ){

    
      $entropy_negatif_set = round((-((($fm_negatif/$total_negatif)*log($fm_negatif/$total_negatif,2))+($fh_negatif/$total_negatif)*log($fh_negatif/$total_negatif,2))),4);
     $query_simpan_ne = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `en_ne` = ".$entropy_negatif_set."  WHERE `data_training_kata`.`nama_kata` = '$idkata'");


      }



    
       }



       $final =mysqli_query($koneksi, "SELECT * FROM `data_training_kata` ORDER BY `nama_kata` ASC");
       while ($rowd = mysqli_fetch_array($final)) {
       
         $idkata = $rowd['nama_kata'];
         $entropy_positif = $rowd['en_po'];
         $entropy_negatif = $rowd['en_ne'];
       
       $entropy_final = round((((($total_positif/$total_pn)*$entropy_positif)+
         ($total_negatif/$total_pn)*$entropy_negatif)),4);
       $query_simpan_tot = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `entropy_kata` = ".$entropy_final." WHERE
       `nama_kata` = '$idkata'");
       
       }
       
    
    
    
    
    
    }
    

    function jt_positif($koneksi)
    {  
        $query = mysqli_query($koneksi,"select count(`id_training`) as positif FROM `data_train` where `sentimen` ='P' ");
        while($data = mysqli_fetch_array($query))
            {
                $po = $data['positif'];
                return $po;     
            }
    }
    
    
    function jt_negatif($koneksi) 
    {    
        $query = mysqli_query($koneksi,"select count(`id_training`) as negatif FROM `data_train` where `sentimen` ='N'");
        while($data = mysqli_fetch_array($query))
            {
                $po = $data['negatif'];
                return $po;     
            }
    }  
    
    function jt_total($koneksi)
    {    
        $query = mysqli_query($koneksi,"select count(`id_training`) as total FROM `data_train`");
        while($data = mysqli_fetch_array($query))
             {
                $po = $data['total'];
                return $po;     
             }
    }  

    public function entropy_set($koneksi)
    {
        $jml_p = $this -> jt_positif($koneksi); 
        $jml_n = $this -> jt_negatif($koneksi);
        $jml_t = $this -> jt_total($koneksi);
        
        $entropy_set = round((-((($jml_p/$jml_t)*log($jml_p/$jml_t,2))+($jml_n/$jml_t)*log($jml_n/$jml_t,2))),4);
        return $entropy_set;
    }



    function set_info_gain($koneksi)
    {
        $entropy_set = $this -> entropy_set($koneksi);
        $enset = mysqli_query($koneksi, "SELECT `nama_kata`, `entropy_kata` FROM `data_training_kata` ORDER BY `nama_kata` ASC");
        while ($rowd = mysqli_fetch_array($enset))
            {
                $id = $rowd['nama_kata'];
                $ig = round($entropy_set - $rowd['entropy_kata'],9);
                mysqli_query($koneksi, 'UPDATE `data_training_kata` SET `bobot_ig` = (\'' . $ig . '\') WHERE `nama_kata` = (\'' . $id . '\');');   
            }
    } 
}

class bayes
{
    public function getpositif()
    {
        include 'koneksi.php';
        $query = mysqli_query($koneksi,"select * from `data_train` where sentimen='P'");
        while ($rowd =  mysqli_fetch_array($query))
        {
            $a = $rowd['tweet_preprocessing']; 
            $array[]= $rowd['tweet_preprocessing'];

            $value = implode(", ",$array);
        }
        return $value;
    }

    public function getnegatif()
    {
        include 'koneksi.php';
        $query = mysqli_query($koneksi,"select * from `data_train` where sentimen='N'");
        while ($rowd =  mysqli_fetch_array($query))
        {
            $a = $rowd['tweet_preprocessing']; 
            $array[]= $rowd['tweet_preprocessing'];

            $value = implode(", ",$array);
        }
        return $value;
    }

    function get_jml_kata_positif()
    {
        include 'koneksi.php';
        $value = count(str_word_count($this -> getpositif() , 1));
        echo $value;
    }
    
    function get_jml_kata_negatif()
    {
        include 'koneksi.php';
        $value = count(str_word_count($this -> getnegatif() , 1));
        echo $value;
    }

    function get_jml_semua_kata_unik()
    {
        include 'koneksi.php';
        $querylikea = mysqli_query($koneksi,"SELECT * FROM `data_train");
            while($datapositifa = mysqli_fetch_array($querylikea))
            {
            $hasila = $datapositifa['tweet_preprocessing'];
           $stoplist[]= $datapositifa['tweet_preprocessing'];
           $hasil_buah = implode(", ",$stoplist);
           
           } 
        
    return count(str_word_count($hasil_buah, 1));
    
    }


    public function setbobotbayes()
    {
        include 'koneksi.php';
        $query = mysqli_query($koneksi,"select * from `data_training_kata` ORDER BY `nama_kata` ASC");
        while ($rowd =  mysqli_fetch_array($query))
        {
            $array[]= $rowd['nama_kata'];
            $value = implode(" ",$array);
        }

        $n_positif = $this -> get_jml_kata_positif();
        $n_negatif = $this -> get_jml_kata_negatif();
        $kosakata = $this -> get_jml_semua_kata_unik();

        $hasil = explode(' ',$value);

        foreach($hasil as $word)
        
        {
            $totalGood = substr_count($this->getpositif(), ''."$word".'');
            $ni_positif = $totalGood;

            $totalBad = substr_count($this->getnegatif(), ''."$word".'');
            $ni_negatif = $totalBad;

            $probabilitas_p = round(($ni_positif+1)/($n_positif+$kosakata),17);

            $probabilitas_n = round(($ni_negatif+1)/($n_negatif+$kosakata),17);


            $query_simpan_probpos = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `bobot_bayes_positif` = ".$probabilitas_p." WHERE `nama_kata` = '$word'");

            $query_simpan_probneg = mysqli_query($koneksi, "UPDATE `data_training_kata` SET `bobot_bayes_negatif` = ".$probabilitas_n." WHERE `nama_kata` = '$word'");

            echo $word ."  |  Probabilitas Positif : " .$probabilitas_p ." |  Probabilitas Negatif : " .$probabilitas_n ."<br>";
            
        }
    }
}

class crawling
{
    
function get()
{

include "koneksi.php";


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
'count'=>100, 'lang'=>'id', 'until'=>$tanggal_crawling));
foreach ($tweets->statuses as $tweet) {
static $i=0;
$i+=1;
$id_tweet = $tweet->id;
$user = $tweet->user->screen_name;
$text = $tweet->text;
$date = date('Y-m-d', strtotime($tweet->created_at));
?>
<?php

mysqli_query($koneksi,"INSERT INTO `data_train_tes` (`username`, `tweet_text`, `tanggal`) VALUES ('".$user."', '".$text."', '".$date."')");

?>
</pre>
<?php
}
}

}
}

        


?>