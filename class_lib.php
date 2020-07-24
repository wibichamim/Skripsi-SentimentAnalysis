<?php
 // load library twitteroauth
 require_once __DIR__.'/twitteroauth/autoload.php';
 use Abraham\TwitterOAuth\TwitterOAuth;


class database

{
    protected $host = "localhost";
    protected $uname = "root";
    protected $pass = "";
    protected $db = "sentweet";
    protected $koneksidb;

    function __construct()
    {
    $koneksi= mysqli_connect($this->host,$this->uname,$this->pass,$this->db);
    ini_set('max_execution_time', 300); //300 seconds = 5 minutes

    return $this->koneksidb = $koneksi;
    }

    
}

 
class aksidatabase extends database
{

    function lain()
    {
        $sql = mysqli_query($this->koneksidb, "SELECT * FROM data_training");
        while($data = mysqli_fetch_array($sql))
        {
        return $data['sentimen'];
        }
    }

    function truncate_kata()
    {
        $query = mysqli_query($this->koneksidb, "TRUNCATE TABLE `data_training_kata`");
    }
   
    function truncate_data_training()
    {
        $query = mysqli_query($this->koneksidb, "TRUNCATE TABLE `data_testing`");
    }

    function reset_preprocessing_data_testing()
    {
        $query = mysqli_query($this->koneksidb, "UPDATE `data_testing` SET `tweet_preprocessing`='',`prob_pos`='',`prob_neg`='',`sentimen`=''");
    }

    function reset_klasifikasi_testing()
    {
        $query = mysqli_query($this->koneksidb, "UPDATE `data_testing` SET `prob_pos`='',`prob_neg`='', `prob_netral`='',`sentimen`=''");
    }

    function reset_preprocessing_data_training()
    {
        $query = mysqli_query($this->koneksidb, "UPDATE `data_training` SET `tweet_preprocessing`=''");
    }

    function hitung_total_datatraining()    
    {
        $sql = mysqli_query($this->koneksidb,"SELECT count(`id_training`) as total FROM `data_training`");
        while($data = mysqli_fetch_array($sql))
        {
        return $data['total'];
        }
    }

    function hitung_tweet_positif_datatraining()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_training` where `sentimen`='Positif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }    

    function hitung_tweet_netral_datatraining()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_training` where `sentimen`='Netral'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_negatif_datatraining()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_training` where `sentimen`='Negatif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function resetbobotbayes()
    {
        $query_hapus = mysqli_query($this->koneksidb, "update `data_training_kata` set `bobot_bayes_negatif`='', `bobot_bayes_positif`='', `bobot_bayes_netral`=''");
        header("Location: bayes");
    }


    function reset_terms()
    {
        $query_hapus = mysqli_query($this->koneksidb, "update `data_training_kata` set `bobot_tf`='', `bobot_idf`='', `bobot_tfidf`=''");
        header("Location: terms");
    }


    function hitung_total_datatesting()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT count(`id_training`) as total FROM `data_train_tes`");
        while($data = mysqli_fetch_array($sql))
        {
        echo $data['total'];
        }
    }

    function hitung_tweet_positif_datatesting()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `sentimen`='Positif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }
    function hitung_tweet_netral_datatesting()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `sentimen`='Netral'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_negatif_datatesting()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `sentimen`='Negatif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_total_positif()
    {
        
        $total = $this -> hitung_tweet_positif_datatesting($this->koneksidb) + $this -> hitung_tweet_positif_datatraining($this->koneksidb);
        return $total; 
    }

    function hitung_total_negatif()
    {
        $total = $this -> hitung_tweet_negatif_datatesting($this->koneksidb) + $this -> hitung_tweet_negatif_datatraining($this->koneksidb);
        return $total; 
    }
    
    function hitung_total_tidakrelevan()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_train_tes` where `sentimen`=''");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_total_borobudur()    
    {
        $sql = mysqli_query($this->koneksidb,"SELECT COUNT(id_training) AS borobudur FROM `data_testing` WHERE tweet_text LIKE '%borobudur%'");
        while($data = mysqli_fetch_array($sql))
        {
        return $data['borobudur'];
        }
    }

    function hitung_tweet_negatif_borobudur()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%borobudur%' AND `sentimen`='Negatif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_positif_borobudur()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%borobudur%' AND `sentimen`='Positif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_netral_borobudur()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%borobudur%' AND `sentimen`='Netral'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_negatif_borobudur()
    {
        $persen = $this -> hitung_tweet_negatif_borobudur($this->koneksidb) / $this -> hitung_total_borobudur($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_positif_borobudur()
    {
        $persen = $this -> hitung_tweet_positif_borobudur($this->koneksidb) / $this -> hitung_total_borobudur($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_netral_borobudur()
    {
        $persen = $this -> hitung_tweet_netral_borobudur($this->koneksidb) / $this -> hitung_total_borobudur($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_total_lesung()    
    {
        $sql = mysqli_query($this->koneksidb,"SELECT COUNT(id_training) AS lesung FROM `data_testing` WHERE tweet_text LIKE '%lesung%'");
        while($data = mysqli_fetch_array($sql))
        {
        return $data['lesung'];
        }
    }

    function hitung_tweet_negatif_lesung()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%lesung%' AND `sentimen`='Negatif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_positif_lesung()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%lesung%' AND `sentimen`='Positif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_netral_lesung()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%lesung%' AND `sentimen`='Netral'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_negatif_lesung()
    {
        $persen = $this -> hitung_tweet_negatif_lesung($this->koneksidb) / $this -> hitung_total_lesung($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_positif_lesung()
    {
        $persen = $this -> hitung_tweet_positif_lesung($this->koneksidb) / $this -> hitung_total_lesung($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_netral_lesung()
    {
        $persen = $this -> hitung_tweet_netral_lesung($this->koneksidb) / $this -> hitung_total_lesung($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_total_toba()    
    {
        $sql = mysqli_query($this->koneksidb,"SELECT COUNT(id_training) AS toba FROM `data_testing` WHERE tweet_text LIKE '%toba%'");
        while($data = mysqli_fetch_array($sql))
        {
        return $data['toba'];
        }
    }

    function hitung_tweet_negatif_toba()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%toba%' AND `sentimen`='Negatif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_positif_toba()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%toba%' AND `sentimen`='Positif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_netral_toba()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%toba%' AND `sentimen`='Netral'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_negatif_toba()
    {
        $persen = $this -> hitung_tweet_negatif_toba($this->koneksidb) / $this -> hitung_total_toba($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_positif_toba()
    {
        $persen = $this -> hitung_tweet_positif_toba($this->koneksidb) / $this -> hitung_total_toba($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_netral_toba()
    {
        $persen = $this -> hitung_tweet_netral_toba($this->koneksidb) / $this -> hitung_total_toba($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_total_kelayang()    
    {
        $sql = mysqli_query($this->koneksidb,"SELECT COUNT(id_training) AS kelayang FROM `data_testing` WHERE tweet_text LIKE '%kelayang%'");
        while($data = mysqli_fetch_array($sql))
        {
        return $data['kelayang'];
        }
    }

    function hitung_tweet_negatif_kelayang()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%kelayang%' AND `sentimen`='Negatif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_positif_kelayang()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%kelayang%' AND `sentimen`='Positif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_netral_kelayang()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%kelayang%' AND `sentimen`='Netral'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_negatif_kelayang()
    {
        $persen = $this -> hitung_tweet_negatif_kelayang($this->koneksidb) / $this -> hitung_total_kelayang($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_positif_kelayang()
    {
        $persen = $this -> hitung_tweet_positif_kelayang($this->koneksidb) / $this -> hitung_total_kelayang($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_netral_kelayang()
    {
        $persen = $this -> hitung_tweet_netral_kelayang($this->koneksidb) / $this -> hitung_total_kelayang($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_total_mandalika()    
    {
        $sql = mysqli_query($this->koneksidb,"SELECT COUNT(id_training) AS mandalika FROM `data_testing` WHERE tweet_text LIKE '%mandalika%'");
        while($data = mysqli_fetch_array($sql))
        {
        return $data['mandalika'];
        }
    }

    function hitung_tweet_negatif_mandalika()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%mandalika%' AND `sentimen`='Negatif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_positif_mandalika()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%mandalika%' AND `sentimen`='Positif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_netral_mandalika()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%mandalika%' AND `sentimen`='Netral'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_negatif_mandalika()
    {
        $persen = $this -> hitung_tweet_negatif_mandalika($this->koneksidb) / $this -> hitung_total_mandalika($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_positif_mandalika()
    {
        $persen = $this -> hitung_tweet_positif_mandalika($this->koneksidb) / $this -> hitung_total_mandalika($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_netral_mandalika()
    {
        $persen = $this -> hitung_tweet_netral_mandalika($this->koneksidb) / $this -> hitung_total_mandalika($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_total_wakatobi()    
    {
        $sql = mysqli_query($this->koneksidb,"SELECT COUNT(id_training) AS wakatobi FROM `data_testing` WHERE tweet_text LIKE '%wakatobi%'");
        while($data = mysqli_fetch_array($sql))
        {
        return $data['wakatobi'];
        }
    }

    function hitung_tweet_negatif_wakatobi()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%wakatobi%' AND `sentimen`='Negatif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_positif_wakatobi()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%wakatobi%' AND `sentimen`='Positif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_netral_wakatobi()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%wakatobi%' AND `sentimen`='Netral'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_negatif_wakatobi()
    {
        $persen = $this -> hitung_tweet_negatif_wakatobi($this->koneksidb) / $this -> hitung_total_wakatobi($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_positif_wakatobi()
    {
        $persen = $this -> hitung_tweet_positif_wakatobi($this->koneksidb) / $this -> hitung_total_wakatobi($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_netral_wakatobi()
    {
        $persen = $this -> hitung_tweet_netral_wakatobi($this->koneksidb) / $this -> hitung_total_wakatobi($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_total_morotai()    
    {
        $sql = mysqli_query($this->koneksidb,"SELECT COUNT(id_training) AS morotai FROM `data_testing` WHERE tweet_text LIKE '%morotai%'");
        while($data = mysqli_fetch_array($sql))
        {
        return $data['morotai'];
        }
    }

    function hitung_tweet_negatif_morotai()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%morotai%' AND `sentimen`='Negatif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_positif_morotai()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%morotai%' AND `sentimen`='Positif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_netral_morotai()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%morotai%' AND `sentimen`='Netral'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_negatif_morotai()
    {
        $persen = $this -> hitung_tweet_negatif_morotai($this->koneksidb) / $this -> hitung_total_morotai($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_positif_morotai()
    {
        $persen = $this -> hitung_tweet_positif_morotai($this->koneksidb) / $this -> hitung_total_morotai($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_netral_morotai()
    {
        $persen = $this -> hitung_tweet_netral_morotai($this->koneksidb) / $this -> hitung_total_morotai($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_total_bromo()    
    {
        $sql = mysqli_query($this->koneksidb,"SELECT COUNT(id_training) AS bromo FROM `data_testing` WHERE tweet_text LIKE '%bromo%'");
        while($data = mysqli_fetch_array($sql))
        {
        return $data['bromo'];
        }
    }

    function hitung_tweet_negatif_bromo()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%bromo%' AND `sentimen`='Negatif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_positif_bromo()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%bromo%' AND `sentimen`='Positif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_netral_bromo()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%bromo%' AND `sentimen`='Netral'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_negatif_bromo()
    {
        $persen = $this -> hitung_tweet_negatif_bromo($this->koneksidb) / $this -> hitung_total_bromo($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_positif_bromo()
    {
        $persen = $this -> hitung_tweet_positif_bromo($this->koneksidb) / $this -> hitung_total_bromo($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_netral_bromo()
    {
        $persen = $this -> hitung_tweet_netral_bromo($this->koneksidb) / $this -> hitung_total_bromo($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_total_bajo()    
    {
        $sql = mysqli_query($this->koneksidb,"SELECT COUNT(id_training) AS bajo FROM `data_testing` WHERE tweet_text LIKE '%bajo%'");
        while($data = mysqli_fetch_array($sql))
        {
        return $data['bajo'];
        }
    }

    function hitung_tweet_negatif_bajo()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%bajo%' AND `sentimen`='Negatif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_positif_bajo()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%bajo%' AND `sentimen`='Positif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_netral_bajo()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%bajo%' AND `sentimen`='Netral'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_negatif_bajo()
    {
        $persen = $this -> hitung_tweet_negatif_bajo($this->koneksidb) / $this -> hitung_total_bajo($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_positif_bajo()
    {
        $persen = $this -> hitung_tweet_positif_bajo($this->koneksidb) / $this -> hitung_total_bajo($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_netral_bajo()
    {
        $persen = $this -> hitung_tweet_netral_bajo($this->koneksidb) / $this -> hitung_total_bajo($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_total_seribu()    
    {
        $sql = mysqli_query($this->koneksidb,"SELECT COUNT(id_training) AS seribu FROM `data_testing` WHERE tweet_text LIKE '%seribu%'");
        while($data = mysqli_fetch_array($sql))
        {
        return $data['seribu'];
        }
    }

    function hitung_tweet_negatif_seribu()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%seribu%' AND `sentimen`='Negatif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_positif_seribu()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%seribu%' AND `sentimen`='Positif'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_tweet_netral_seribu()
    {
        $sql = mysqli_query($this->koneksidb,"SELECT * FROM `data_testing` where `tweet_text` LIKE '%seribu%' AND `sentimen`='Netral'");
        $hasil = mysqli_num_rows($sql);
        return $hasil;
    }

    function hitung_negatif_seribu()
    {
        $persen = $this -> hitung_tweet_negatif_seribu($this->koneksidb) / $this -> hitung_total_seribu($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_positif_seribu()
    {
        $persen = $this -> hitung_tweet_positif_seribu($this->koneksidb) / $this -> hitung_total_seribu($this->koneksidb) * 100 ;
        return $persen;
    }

    function hitung_netral_seribu()
    {
        $persen = $this -> hitung_tweet_netral_seribu($this->koneksidb) / $this -> hitung_total_seribu($this->koneksidb) * 100 ;
        return $persen;
    }

    
    
}


class preprocessing extends database
{
    public function case_folding($tweet)
    {
        return strtolower($tweet);
    }

    function cleansing($tweet)
    {

        $tweet = preg_replace('/@[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i','', $tweet);
        $tweet = preg_replace('/#[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i','', $tweet);
        $tweet = preg_replace('/\b(https?|ftp|file|http):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i','', $tweet);

        $tweet = str_replace("…", "", $tweet);
        $tweet = str_replace("—", "", $tweet);
        $tweet = str_replace("()", "", $tweet);
        $tweet = str_replace("*", "", $tweet);
        $tweet = str_replace("…", "", $tweet);
        $tweet = str_replace("~", "", $tweet);
        $tweet = str_replace("*", "", $tweet);
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


        $esenang = array("❤️","😍","😊", "👍", ";)", "❣️", "💟", "💕", "💞", "💓", "💗", "💖", "😻", "🥰", "😊",":))))",":))",":)",":o)",":]",":3",":c)",":>","=]","8)","=)",":}",":>)",":D",":-D",":')");
        $esedih = array("😌", "😭", "😢", "😭", "😰", "😨", "😣", "😖", "😞", "😓", "😩", "😫", "😿", "😤", "😠", "😡", "🤬",">:[",":'(",":')",":(",":/",":-(",":(",":'(",":-c",":c",":-<",":-[",":[",":{",">.>","<.<",">.<",":/",":(((");
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

        $kata_tweet = $tweet;
        $i = 0;
        foreach ($kata_tweet as $kata_hasil) {
          
                $query_normalisasi_singkatan = mysqli_query($this->koneksidb,"SELECT * FROM normalisasi_kata_singkatan
                    WHERE kata_singkatan = '".$kata_hasil."'");
        
                    while($row = mysqli_fetch_array($query_normalisasi_singkatan))
                    {
                        $kata_tweet[$i] = $row['kata_ganti'];
                    }      

                $query_normalisasi_inggris = mysqli_query($this->koneksidb,"SELECT * FROM normalisasi_bahasa_inggris
                    WHERE kata_bahasa_inggris = '".$kata_hasil."'");
                    while($row_inggris = mysqli_fetch_array($query_normalisasi_inggris))
                        {
                            $kata_tweet[$i] = $row_inggris['kata_bahasa_indonesia'];
                        }   

                $query_normalisasi_gaul = mysqli_query($this->koneksidb,"SELECT * FROM normalisasi_bahasa_gaul
                WHERE kata_gaul = '".$kata_hasil."'");
        
                    while($row_gaul = mysqli_fetch_array($query_normalisasi_gaul))
                    {
                        $kata_tweet[$i] = $row_gaul['kata_ganti'];
                    }

                $query_normalisasi_baku = mysqli_query($this->koneksidb,"SELECT * FROM normalisasi_kata_baku
                WHERE kata_tidak_baku = '".$kata_hasil."'");
                    while($row_baku = mysqli_fetch_array($query_normalisasi_baku))
                    {
                        $kata_tweet[$i] = $row_baku['kata_baku'];
                    }           
       
        $i++;
        }
        $kata = implode(' ', $kata_tweet);
        return $kata;
        }

        
    function tokenizing($tweet)
    {
        $tweet = explode(" ", $tweet);
        $tweet = implode(" ", $tweet);
        return $tweet;
    }
        
   function stopword_removal($tweet)
   {
       include 'koneksi.php';
       $array = array();
            $query = mysqli_query($this->koneksidb,"select * FROM daftar_kata_stopword");
            while($key = mysqli_fetch_array($query))
            {
                $array[]= $key['stopword'];
            }
            $tweet = preg_replace('/\b('.implode('|',$array).')\b/','',$tweet);
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
        mysqli_query($this->koneksidb, 'UPDATE `data_training` SET `tweet_preprocessing` = (\'' . $stemmed . '\') WHERE `id_training` = (\'' . $id . '\');');   
        $pieces = explode(' ', $stemmed);
        foreach($pieces as $piece)
        mysqli_query($this->koneksidb, 'insert into data_training_kata (nama_kata) values (\'' . $piece . '\');'); 
    }


    function all()
    {
        include 'koneksi.php';
        $sql = mysqli_query($this->koneksidb,"select * from data_training");
        while($data = mysqli_fetch_array($sql)){
            $datatweet = $data['tweet_text'];

            $casefolded = $this -> case_folding($datatweet);
            $cleansed = $this -> cleansing($casefolded);
            $emoticonconverted = $this -> convert_emoticon($cleansed);
            $negationconverted = $this -> convert_negation($emoticonconverted);
            $normalization = $this -> normalization($negationconverted);
            $stopwordremoved = $this -> stopword_removal($normalization);

            //$stemmed =  $this -> stemming($stopwordremoved);
           // $final = implode("",$stemmed);
           // print_r($final);
           $final = explode(' ', $stopwordremoved);
          
           foreach($final as $piece)
           mysqli_query($this->koneksidb, 'insert into data_training_kata (nama_kata) values (\'' . $piece . '\');');  
        }
    }




 
        
}


class information_gain extends database
{
    public function doall()
    {
        $this -> entropy_positif_sentimen_like($this->koneksidb);
        $this -> entropy_positif_sentimen_notlike($this->koneksidb);
        $this -> entropy_negatif_sentimen_like($this->koneksidb);
        $this -> entropy_negatif_sentimen_notlike($this->koneksidb);
        $this -> entropy_kata($this->koneksidb);
        $this -> set_info_gain($this->koneksidb);
    }
   
    public function entropy_positif_sentimen_like()
    {    
      $query = mysqli_query($this->koneksidb,"SELECT `nama_kata` FROM `data_training_kata`");
      while ($row_kata = mysqli_fetch_array($query))
        {
            $kata = $row_kata['nama_kata'];
            $querylike = mysqli_query($this->koneksidb,"SELECT count(tweet_text) as jumlahpos FROM `data_training` where tweet_preprocessing LIKE '%" .$row_kata['nama_kata'] ."%' and sentimen = 'P'");
            while($datapositif = mysqli_fetch_array($querylike))
                {
                    $hasila = $datapositif['jumlahpos'];
                    $query_simpan = mysqli_query($this->koneksidb, "UPDATE `data_training_kata` SET `fm_positif` = ".$hasila." WHERE `nama_kata` = '$kata'");
                }
        }
    }

    public function entropy_negatif_sentimen_like()
    {
      $query = mysqli_query($this->koneksidb,"SELECT `nama_kata` FROM `data_training_kata`");
      while ($row_kata = mysqli_fetch_array($query))
         {
            $kata = $row_kata['nama_kata'];
            $querylike = mysqli_query($this->koneksidb,"SELECT count(id_training) as jumlah FROM `data_training` where tweet_preprocessing LIKE '%" .$row_kata['nama_kata'] ."%' and sentimen='N'");
            while($data = mysqli_fetch_array($querylike))
                {
                    $hasil = $data['jumlah'];
                    echo $kata ." | " .$hasil ."<br>";

                    $query_simpan = mysqli_query($this->koneksidb, "UPDATE `data_training_kata` SET `fm_negatif` = ".$hasil." WHERE `nama_kata` = '$kata'");
                }    
         }
    }

    function entropy_positif_sentimen_notlike()
    {
     $query = mysqli_query($this->koneksidb,"SELECT `nama_kata` FROM `data_training_kata`");
     while ($row_kata = mysqli_fetch_array($query))
      {
        $kata = $row_kata['nama_kata'];
        $querylike = mysqli_query($this->koneksidb,"SELECT count(id_training) as jumlahpos FROM `data_training` where tweet_preprocessing not LIKE '%" .$row_kata['nama_kata'] ."%'and sentimen='P'");
        while($datapositif = mysqli_fetch_array($querylike))
            {
                $hasila = $datapositif['jumlahpos'];
                $query_simpan = mysqli_query($this->koneksidb, "UPDATE `data_training_kata` SET `fh_positif` = ".$hasila." WHERE `nama_kata` = '$kata'");
            }
      }
    }

    function entropy_negatif_sentimen_notlike()
    {
     $query = mysqli_query($this->koneksidb,"SELECT `nama_kata` FROM `data_training_kata`");
     while ($row_kata = mysqli_fetch_array($query))
      {
        $kata = $row_kata['nama_kata'];
        $querylike = mysqli_query($this->koneksidb,"SELECT count(id_training) as jumlah FROM `data_training` where tweet_preprocessing not LIKE '%" .$row_kata['nama_kata'] ."%'and sentimen='N'");
        while($data = mysqli_fetch_array($querylike))
            {
                $hasil = $data['jumlah'];
              //  echo $kata ." | " .$hasila ."<br>";
                $query_simpan = mysqli_query($this->koneksidb, "UPDATE `data_training_kata` SET `fh_negatif` = ".$hasil." WHERE `nama_kata` = '$kata'");
            }
      }
    }

    function entropy_kata()

    {
    include 'koneksi.php';
      $total_positif = $this -> jt_positif($this->koneksidb); 
      $total_negatif = $this -> jt_negatif($this->koneksidb);
       $total_pn = $this -> jt_total($this->koneksidb);
     $entropy_negatif_set = 0;

     $pos =mysqli_query($this->koneksidb, "SELECT * FROM `data_training_kata` ORDER BY `nama_kata` ASC");
     while ($row = mysqli_fetch_array($pos)) {
     
       $idkata = $row['nama_kata'];
     
       $fm_positif = $row['fm_positif'];
       $fh_positif = $row['fh_positif'];
     
       $entropy_positif_set = round((-((($fm_positif/$total_positif)*log($fm_positif/$total_positif,2))+($fh_positif/$total_positif)*log($fh_positif/$total_positif,2))),4);
     
       $query_simpan_po = mysqli_query($this->koneksidb, "UPDATE `data_training_kata` SET `en_po` = ".$entropy_positif_set." WHERE `nama_kata` = '$idkata'");
       echo $idkata ."-" .$entropy_positif_set ."<br>";  

        }   
    
    $neg =mysqli_query($this->koneksidb, "SELECT * FROM `data_training_kata` ORDER BY `nama_kata` ASC");
    while ($row = mysqli_fetch_array($neg)) {
      $idkata = $row['nama_kata'];
    
      $fm_negatif = $row['fm_negatif'];
      $fh_negatif = $row['fh_negatif'];

      if($fm_negatif > 0 && $fh_negatif > 0 ){

    
      $entropy_negatif_set = round((-((($fm_negatif/$total_negatif)*log($fm_negatif/$total_negatif,2))+($fh_negatif/$total_negatif)*log($fh_negatif/$total_negatif,2))),4);
     $query_simpan_ne = mysqli_query($this->koneksidb, "UPDATE `data_training_kata` SET `en_ne` = ".$entropy_negatif_set."  WHERE `data_training_kata`.`nama_kata` = '$idkata'");


      }



    
       }



       $final =mysqli_query($this->koneksidb, "SELECT * FROM `data_training_kata` ORDER BY `nama_kata` ASC");
       while ($row = mysqli_fetch_array($final)) {
       
         $idkata = $row['nama_kata'];
         $entropy_positif = $row['en_po'];
         $entropy_negatif = $row['en_ne'];
       
       $entropy_final = round((((($total_positif/$total_pn)*$entropy_positif)+
         ($total_negatif/$total_pn)*$entropy_negatif)),4);
       $query_simpan_tot = mysqli_query($this->koneksidb, "UPDATE `data_training_kata` SET `entropy_kata` = ".$entropy_final." WHERE
       `nama_kata` = '$idkata'");
       
       }
       
    
    
    
    
    
    }
    

    function jt_positif()
    {  
        $query = mysqli_query($this->koneksidb,"select count(`id_training`) as positif FROM `data_training` where `sentimen` ='P' ");
        while($data = mysqli_fetch_array($query))
            {
                $po = $data['positif'];
                return $po;     
            }
    }
    
    
    function jt_negatif() 
    {    
        $query = mysqli_query($this->koneksidb,"select count(`id_training`) as negatif FROM `data_training` where `sentimen` ='N'");
        while($data = mysqli_fetch_array($query))
            {
                $po = $data['negatif'];
                return $po;     
            }
    }  
    
    function jt_total()
    {    
        $query = mysqli_query($this->koneksidb,"select count(`id_training`) as total FROM `data_training`");
        while($data = mysqli_fetch_array($query))
             {
                $po = $data['total'];
                return $po;     
             }
    }  

    public function entropy_set()
    {
        $jml_p = $this -> jt_positif($this->koneksidb); 
        $jml_n = $this -> jt_negatif($this->koneksidb);
        $jml_t = $this -> jt_total($this->koneksidb);
        
        $entropy_set = round((-((($jml_p/$jml_t)*log($jml_p/$jml_t,2))+($jml_n/$jml_t)*log($jml_n/$jml_t,2))),4);
        return $entropy_set;
    }



    function set_info_gain()
    {
        $entropy_set = $this -> entropy_set($this->koneksidb);
        $enset = mysqli_query($this->koneksidb, "SELECT `nama_kata`, `entropy_kata` FROM `data_training_kata` ORDER BY `nama_kata` ASC");
        while ($row = mysqli_fetch_array($enset))
            {
                $id = $row['nama_kata'];
                $ig = round($entropy_set - $row['entropy_kata'],9);
                mysqli_query($this->koneksidb, 'UPDATE `data_training_kata` SET `bobot_ig` = (\'' . $ig . '\') WHERE `nama_kata` = (\'' . $id . '\');');   
            }
    } 
}

class bayes extends database
{
    public function get_dokumen_positif()
    {
        $query = mysqli_query($this->koneksidb,"select * from `data_training` where sentimen='POSITIF'");
        while ($row =  mysqli_fetch_array($query))
        {
            $array[]= $row['tweet_preprocessing'];

            $value = implode(", ",$array);
        }
        return $value;
    }

    public function get_dokumen_negatif()
    {
        $query = mysqli_query($this->koneksidb,"select * from `data_training` where sentimen='NEGATIF'");
        while ($row =  mysqli_fetch_array($query))
        {
            $array[]= $row['tweet_preprocessing'];

            $value = implode(", ",$array);
        }
        return $value;
    }

    public function get_dokumen_netral()
    {
        $query = mysqli_query($this->koneksidb,"select * from `data_training` where sentimen='NETRAL'");
        while ($row =  mysqli_fetch_array($query))
        {
            $array[]= $row['tweet_preprocessing'];

            $value = implode(", ",$array);
        }
        return $value;
    }

    function get_jml_kata_positif()
    {
        $value = count(str_word_count($this -> get_dokumen_positif() , 1));
        return $value;
    }
    
    function get_jml_kata_negatif()
    {
        $value = count(str_word_count($this -> get_dokumen_negatif() , 1));
        return $value;
    }
    
    function get_jml_kata_netral()
    {
        $value = count(str_word_count($this -> get_dokumen_netral() , 1));
        return $value;
    }

    function get_jml_semua_kata_unik()
    {
        $query = mysqli_query($this->koneksidb,"SELECT * FROM `data_training`");
            while($row = mysqli_fetch_array($query))
            {

           $array[]= $row['tweet_preprocessing'];
           $value = implode(", ",$array);
           
           } 
        
    return count(str_word_count($value, 1));
    
    }


    public function setbobotbayes()
    {
        $query = mysqli_query($this->koneksidb,"select * from `data_training_kata` ORDER BY `nama_kata` ASC");
        while ($row =  mysqli_fetch_array($query))
        {
            $array[]= $row['nama_kata'];
            $value = implode(" ",$array);
        }

        $n_positif = $this -> get_jml_kata_positif();
        $n_netral = $this -> get_jml_kata_netral();
        $n_negatif = $this -> get_jml_kata_negatif();
        $kosakata = $this -> get_jml_semua_kata_unik();

        $hasil = explode(' ',$value);

        foreach($hasil as $word)
        
        {
            $final_value_positif = substr_count($this->get_dokumen_positif(), ''."$word".'');
            $ni_positif = $final_value_positif;

            $final_value_netral = substr_count($this->get_dokumen_netral(), ''."$word".'');
            $ni_netral = $final_value_netral;
        
            $final_value_negatif = substr_count($this->get_dokumen_negatif(), ''."$word".'');
            $ni_negatif = $final_value_negatif;

            $prob_positif = round(($ni_positif+1)/($n_positif+$kosakata),50);

            $prob_netral = round(($ni_netral+1)/($n_positif+$kosakata),50);

            $prob_negatif = round(($ni_negatif+1)/($n_negatif+$kosakata),50);


            $query_simpan_probpos = mysqli_query($this->koneksidb, "UPDATE `data_training_kata` SET `bobot_bayes_positif` = ".$prob_positif.", `bobot_bayes_netral`=".$prob_netral.", `bobot_bayes_negatif` = ".$prob_negatif."  WHERE `nama_kata` = '$word'");
            

             echo $word ."  <br>  Probabilitas Positif : " .$prob_positif ." <br>   Probabilitas Netral : " .$prob_netral ."  <br>  Probabilitas Negatif : " .$prob_negatif ."<br>";
            
        }
    }
}

class crawling extends database
{
    function get()
        {
            include 'koneksi.php';
            $key = 'TNs0LpB5x87qDBAUKgFQzXtUm';
            $secret_key = 'kVfYeDeuHIxu4qy7QaXdeFuyS8zgwIf5zP7g9SDn1kdnADiP2Q';
            $token = '1142374346-A3uQQuANEowSaCxKQRRMKiuhy21z7p40ptHp8CP';
            $secret_token = 'uS1i5xyxCWgDfcw3gWMVTBQl8N7GH4YNEPgxZuZNdgHrQ';

            $conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);
            $response_twet = $conn->get('statuses/home_timeline', array('count'=>25, 'exclude_replies'=>true));

            for ($j=7; $j >= 0 ; $j--)
            {
            $tanggal_crawling = date('Y-m-d', strtotime('-'.$j.' days', strtotime(
            date('Y-m-d') )));
            $tweets = $conn->get('search/tweets', array('q'=>"borobudur",
            'count'=>25, 'lang'=>'id', 'until'=>$tanggal_crawling));
            
            foreach ($tweets->statuses as $tweet)
                {
                    static $i=0;
                    $i+=1;
                    $id_tweet = $tweet->id;
                    $user = $tweet->user->screen_name;
                    $text = $tweet->text;
                    $date = date('Y-m-d', strtotime($tweet->created_at));
 
                    mysqli_query($koneksi,"INSERT INTO `data_testing` (`username`, `tweet_text`, `tanggal`) VALUES ('".$user."', '".$text."', '".$date."')");
                }
            }
        }
        function get1()
        {
            include 'koneksi.php';
            $key = 'TNs0LpB5x87qDBAUKgFQzXtUm';
            $secret_key = 'kVfYeDeuHIxu4qy7QaXdeFuyS8zgwIf5zP7g9SDn1kdnADiP2Q';
            $token = '1142374346-A3uQQuANEowSaCxKQRRMKiuhy21z7p40ptHp8CP';
            $secret_token = 'uS1i5xyxCWgDfcw3gWMVTBQl8N7GH4YNEPgxZuZNdgHrQ';

            $conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);
            $response_twet = $conn->get('statuses/home_timeline', array('count'=>25, 'exclude_replies'=>true));

            for ($j=7; $j >= 0 ; $j--)
            {
            $tanggal_crawling = date('Y-m-d', strtotime('-'.$j.' days', strtotime(
            date('Y-m-d') )));
            $tweets = $conn->get('search/tweets', array('q'=>"tanjung lesung",
            'count'=>25, 'lang'=>'id', 'until'=>$tanggal_crawling));
            
            foreach ($tweets->statuses as $tweet)
                {
                    static $i=0;
                    $i+=1;
                    $id_tweet = $tweet->id;
                    $user = $tweet->user->screen_name;
                    $text = $tweet->text;
                    $date = date('Y-m-d', strtotime($tweet->created_at));
 
                    mysqli_query($koneksi,"INSERT INTO `data_testing` (`username`, `tweet_text`, `tanggal`) VALUES ('".$user."', '".$text."', '".$date."')");
                }
            }
        }
        function get2()
        {
            include 'koneksi.php';
            $key = 'TNs0LpB5x87qDBAUKgFQzXtUm';
            $secret_key = 'kVfYeDeuHIxu4qy7QaXdeFuyS8zgwIf5zP7g9SDn1kdnADiP2Q';
            $token = '1142374346-A3uQQuANEowSaCxKQRRMKiuhy21z7p40ptHp8CP';
            $secret_token = 'uS1i5xyxCWgDfcw3gWMVTBQl8N7GH4YNEPgxZuZNdgHrQ';

            $conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);
            $response_twet = $conn->get('statuses/home_timeline', array('count'=>25, 'exclude_replies'=>true));

            for ($j=7; $j >= 0 ; $j--)
            {
            $tanggal_crawling = date('Y-m-d', strtotime('-'.$j.' days', strtotime(
            date('Y-m-d') )));
            $tweets = $conn->get('search/tweets', array('q'=>"Danau Toba",
            'count'=>25, 'lang'=>'id', 'until'=>$tanggal_crawling));
            
            foreach ($tweets->statuses as $tweet)
                {
                    static $i=0;
                    $i+=1;
                    $id_tweet = $tweet->id;
                    $user = $tweet->user->screen_name;
                    $text = $tweet->text;
                    $date = date('Y-m-d', strtotime($tweet->created_at));
 
                    mysqli_query($koneksi,"INSERT INTO `data_testing` (`username`, `tweet_text`, `tanggal`) VALUES ('".$user."', '".$text."', '".$date."')");
                }
            }
        }
        function get3()
        {
            include 'koneksi.php';
            $key = 'TNs0LpB5x87qDBAUKgFQzXtUm';
            $secret_key = 'kVfYeDeuHIxu4qy7QaXdeFuyS8zgwIf5zP7g9SDn1kdnADiP2Q';
            $token = '1142374346-A3uQQuANEowSaCxKQRRMKiuhy21z7p40ptHp8CP';
            $secret_token = 'uS1i5xyxCWgDfcw3gWMVTBQl8N7GH4YNEPgxZuZNdgHrQ';

            $conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);
            $response_twet = $conn->get('statuses/home_timeline', array('count'=>25, 'exclude_replies'=>true));

            for ($j=7; $j >= 0 ; $j--)
            {
            $tanggal_crawling = date('Y-m-d', strtotime('-'.$j.' days', strtotime(
            date('Y-m-d') )));
            $tweets = $conn->get('search/tweets', array('q'=>"Tanjung Kelayang",
            'count'=>25, 'lang'=>'id', 'until'=>$tanggal_crawling));
            
            foreach ($tweets->statuses as $tweet)
                {
                    static $i=0;
                    $i+=1;
                    $id_tweet = $tweet->id;
                    $user = $tweet->user->screen_name;
                    $text = $tweet->text;
                    $date = date('Y-m-d', strtotime($tweet->created_at));
 
                    mysqli_query($koneksi,"INSERT INTO `data_testing` (`username`, `tweet_text`, `tanggal`) VALUES ('".$user."', '".$text."', '".$date."')");
                }
            }
        }
        function get4()
        {
            include 'koneksi.php';
            $key = 'TNs0LpB5x87qDBAUKgFQzXtUm';
            $secret_key = 'kVfYeDeuHIxu4qy7QaXdeFuyS8zgwIf5zP7g9SDn1kdnADiP2Q';
            $token = '1142374346-A3uQQuANEowSaCxKQRRMKiuhy21z7p40ptHp8CP';
            $secret_token = 'uS1i5xyxCWgDfcw3gWMVTBQl8N7GH4YNEPgxZuZNdgHrQ';

            $conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);
            $response_twet = $conn->get('statuses/home_timeline', array('count'=>25, 'exclude_replies'=>true));

            for ($j=7; $j >= 0 ; $j--)
            {
            $tanggal_crawling = date('Y-m-d', strtotime('-'.$j.' days', strtotime(
            date('Y-m-d') )));
            $tweets = $conn->get('search/tweets', array('q'=>"Mandalika",
            'count'=>25, 'lang'=>'id', 'until'=>$tanggal_crawling));
            
            foreach ($tweets->statuses as $tweet)
                {
                    static $i=0;
                    $i+=1;
                    $id_tweet = $tweet->id;
                    $user = $tweet->user->screen_name;
                    $text = $tweet->text;
                    $date = date('Y-m-d', strtotime($tweet->created_at));
 
                    mysqli_query($koneksi,"INSERT INTO `data_testing` (`username`, `tweet_text`, `tanggal`) VALUES ('".$user."', '".$text."', '".$date."')");
                }
            }
        }
        function get5()
        {
            include 'koneksi.php';
            $key = 'TNs0LpB5x87qDBAUKgFQzXtUm';
            $secret_key = 'kVfYeDeuHIxu4qy7QaXdeFuyS8zgwIf5zP7g9SDn1kdnADiP2Q';
            $token = '1142374346-A3uQQuANEowSaCxKQRRMKiuhy21z7p40ptHp8CP';
            $secret_token = 'uS1i5xyxCWgDfcw3gWMVTBQl8N7GH4YNEPgxZuZNdgHrQ';

            $conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);
            $response_twet = $conn->get('statuses/home_timeline', array('count'=>25, 'exclude_replies'=>true));

            for ($j=7; $j >= 0 ; $j--)
            {
            $tanggal_crawling = date('Y-m-d', strtotime('-'.$j.' days', strtotime(
            date('Y-m-d') )));
            $tweets = $conn->get('search/tweets', array('q'=>"Wakatobi",
            'count'=>25, 'lang'=>'id', 'until'=>$tanggal_crawling));
            
            foreach ($tweets->statuses as $tweet)
                {
                    static $i=0;
                    $i+=1;
                    $id_tweet = $tweet->id;
                    $user = $tweet->user->screen_name;
                    $text = $tweet->text;
                    $date = date('Y-m-d', strtotime($tweet->created_at));
 
                    mysqli_query($koneksi,"INSERT INTO `data_testing` (`username`, `tweet_text`, `tanggal`) VALUES ('".$user."', '".$text."', '".$date."')");
                }
            }
        }
        function get6()
        {
            include 'koneksi.php';
            $key = 'TNs0LpB5x87qDBAUKgFQzXtUm';
            $secret_key = 'kVfYeDeuHIxu4qy7QaXdeFuyS8zgwIf5zP7g9SDn1kdnADiP2Q';
            $token = '1142374346-A3uQQuANEowSaCxKQRRMKiuhy21z7p40ptHp8CP';
            $secret_token = 'uS1i5xyxCWgDfcw3gWMVTBQl8N7GH4YNEPgxZuZNdgHrQ';

            $conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);
            $response_twet = $conn->get('statuses/home_timeline', array('count'=>25, 'exclude_replies'=>true));

            for ($j=7; $j >= 0 ; $j--)
            {
            $tanggal_crawling = date('Y-m-d', strtotime('-'.$j.' days', strtotime(
            date('Y-m-d') )));
            $tweets = $conn->get('search/tweets', array('q'=>"Morotai",
            'count'=>25, 'lang'=>'id', 'until'=>$tanggal_crawling));
            
            foreach ($tweets->statuses as $tweet)
                {
                    static $i=0;
                    $i+=1;
                    $id_tweet = $tweet->id;
                    $user = $tweet->user->screen_name;
                    $text = $tweet->text;
                    $date = date('Y-m-d', strtotime($tweet->created_at));
 
                    mysqli_query($koneksi,"INSERT INTO `data_testing` (`username`, `tweet_text`, `tanggal`) VALUES ('".$user."', '".$text."', '".$date."')");
                }
            }
        }
        function get7()
        {
            include 'koneksi.php';
            $key = 'TNs0LpB5x87qDBAUKgFQzXtUm';
            $secret_key = 'kVfYeDeuHIxu4qy7QaXdeFuyS8zgwIf5zP7g9SDn1kdnADiP2Q';
            $token = '1142374346-A3uQQuANEowSaCxKQRRMKiuhy21z7p40ptHp8CP';
            $secret_token = 'uS1i5xyxCWgDfcw3gWMVTBQl8N7GH4YNEPgxZuZNdgHrQ';

            $conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);
            $response_twet = $conn->get('statuses/home_timeline', array('count'=>25, 'exclude_replies'=>true));

            for ($j=7; $j >= 0 ; $j--)
            {
            $tanggal_crawling = date('Y-m-d', strtotime('-'.$j.' days', strtotime(
            date('Y-m-d') )));
            $tweets = $conn->get('search/tweets', array('q'=>"Bromo",
            'count'=>25, 'lang'=>'id', 'until'=>$tanggal_crawling));
            
            foreach ($tweets->statuses as $tweet)
                {
                    static $i=0;
                    $i+=1;
                    $id_tweet = $tweet->id;
                    $user = $tweet->user->screen_name;
                    $text = $tweet->text;
                    $date = date('Y-m-d', strtotime($tweet->created_at));
 
                    mysqli_query($koneksi,"INSERT INTO `data_testing` (`username`, `tweet_text`, `tanggal`) VALUES ('".$user."', '".$text."', '".$date."')");
                }
            }
        }
        function get8()
        {
            include 'koneksi.php';
            $key = 'TNs0LpB5x87qDBAUKgFQzXtUm';
            $secret_key = 'kVfYeDeuHIxu4qy7QaXdeFuyS8zgwIf5zP7g9SDn1kdnADiP2Q';
            $token = '1142374346-A3uQQuANEowSaCxKQRRMKiuhy21z7p40ptHp8CP';
            $secret_token = 'uS1i5xyxCWgDfcw3gWMVTBQl8N7GH4YNEPgxZuZNdgHrQ';

            $conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);
            $response_twet = $conn->get('statuses/home_timeline', array('count'=>25, 'exclude_replies'=>true));

            for ($j=7; $j >= 0 ; $j--)
            {
            $tanggal_crawling = date('Y-m-d', strtotime('-'.$j.' days', strtotime(
            date('Y-m-d') )));
            $tweets = $conn->get('search/tweets', array('q'=>"Labuan Bajo",
            'count'=>25, 'lang'=>'id', 'until'=>$tanggal_crawling));
            
            foreach ($tweets->statuses as $tweet)
                {
                    static $i=0;
                    $i+=1;
                    $id_tweet = $tweet->id;
                    $user = $tweet->user->screen_name;
                    $text = $tweet->text;
                    $date = date('Y-m-d', strtotime($tweet->created_at));
 
                    mysqli_query($koneksi,"INSERT INTO `data_testing` (`username`, `tweet_text`, `tanggal`) VALUES ('".$user."', '".$text."', '".$date."')");
                }
            }
        }
        function get9()
        {
            include 'koneksi.php';
            $key = 'TNs0LpB5x87qDBAUKgFQzXtUm';
            $secret_key = 'kVfYeDeuHIxu4qy7QaXdeFuyS8zgwIf5zP7g9SDn1kdnADiP2Q';
            $token = '1142374346-A3uQQuANEowSaCxKQRRMKiuhy21z7p40ptHp8CP';
            $secret_token = 'uS1i5xyxCWgDfcw3gWMVTBQl8N7GH4YNEPgxZuZNdgHrQ';

            $conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);
            $response_twet = $conn->get('statuses/home_timeline', array('count'=>25, 'exclude_replies'=>true));

            for ($j=7; $j >= 0 ; $j--)
            {
            $tanggal_crawling = date('Y-m-d', strtotime('-'.$j.' days', strtotime(
            date('Y-m-d') )));
            $tweets = $conn->get('search/tweets', array('q'=>"Kepulauan Seribu",
            'count'=>25, 'lang'=>'id', 'until'=>$tanggal_crawling));
            
            foreach ($tweets->statuses as $tweet)
                {
                    static $i=0;
                    $i+=1;
                    $id_tweet = $tweet->id;
                    $user = $tweet->user->screen_name;
                    $text = $tweet->text;
                    $date = date('Y-m-d', strtotime($tweet->created_at));
 
                    mysqli_query($koneksi,"INSERT INTO `data_testing` (`username`, `tweet_text`, `tanggal`) VALUES ('".$user."', '".$text."', '".$date."')");
                }
            }
        }
}

class klasifikasi extends database
{

    function set_probabilitas()
    {
        $query_dok = mysqli_query($this->koneksidb,"SELECT `tweet_preprocessing`,`id_training` FROM data_testing ORDER BY `id_training`");
        while ($row_dok =  mysqli_fetch_array($query_dok))
        {
            $prob_kata_positif = []; $prob_kata_netral = []; $prob_kata_negatif = [];
            $bobot_tfidf = [];
            $idt = $row_dok['id_training'];
            $kata_dok = $row_dok['tweet_preprocessing'];
            $kata_hasil = explode(' ', $kata_dok);
            foreach ($kata_hasil as $key)
            {
                $query_bobot_kata = mysqli_query($this->koneksidb,"SELECT
                `nama_kata`, `bobot_bayes_positif`, `bobot_bayes_netral`, `bobot_bayes_negatif`, `bobot_tfidf` FROM
                `data_training_kata` WHERE `nama_kata` = '".$key."'");
                while ($row_kata = mysqli_fetch_array($query_bobot_kata))
                {
                    if ($key == $row_kata['nama_kata'] & $row_kata['bobot_tfidf'] > 10)
                    {
                        $prob_kata_positif[$key] = round($row_kata['bobot_bayes_positif'], 20);
                        $prob_kata_netral[$key] = round($row_kata['bobot_bayes_netral'], 20);
                        $prob_kata_negatif[$key] = round($row_kata['bobot_bayes_negatif'], 20);
                        $bobot_tfidf[$key] = round($row_kata['bobot_tfidf'], 20);
                    }
                    else
                    {
                        $prob_kata_positif[$key] = 1;
                        $prob_kata_netral[$key] = 1;
                        $prob_kata_negatif[$key] = 1;
                        $bobot_tfidf[$key] = 0;
                    }

                }
            }

    

        $total_bobot_tfidf = implode(' ', $bobot_tfidf);
        $final_tfidf = explode(' ', $total_bobot_tfidf);

        $prob_positif = implode(' ', $prob_kata_positif);
        $final_positif = explode(' ', $prob_positif);
        
        $prob_netral = implode(' ', $prob_kata_netral);
        $final_netral = explode(' ', $prob_netral);
        
        $prob_negatif = implode(' ', $prob_kata_negatif);
        $final_negatif = explode(' ', $prob_negatif);



            $total_tfidf = 0;

                foreach ($final_tfidf as $isi)
                {
                     if ($isi!=0)
                     {
                        $total_tfidf = $isi+$total_tfidf;
                     }

                }

            $total_positif = 1;

                foreach ($final_positif as $isi)
                {
                     if ($isi!=0)
                     {
                        $total_positif = $isi*$total_positif;
                     }

                    else
                    {
                        $total_positif = 1;
                    }
                }

            $total_netral = 1;

                foreach ($final_netral as $isi)
                {
                     if ($isi!=0)
                     {
                        $total_netral = $isi*$total_netral;
                     }

                    else
                    {
                        $total_netral = 1;
                    }
                }

                $total_negatif  = 1;


                foreach ($final_negatif as $isi)
                {
                    if ($isi!=0)
                    {
                        $total_negatif = $total_negatif*$isi*1;
                    }

                    else
                    {
                        $total_negatif = 1;
                    }
                }

                $bobot_tfidf = number_format($total_tfidf,17);
                $prob_kata_positif = number_format($total_positif,50);
                $prob_kata_netral = number_format($total_netral,50);
                $prob_kata_negatif = number_format($total_negatif,50);
                echo $row_dok['tweet_preprocessing'] ." | " .$prob_kata_positif ."<br>";
                $query_simpan = mysqli_query($this->koneksidb, "UPDATE `data_testing` SET `prob_pos` = ".$prob_kata_positif.", `prob_netral` = ".$prob_kata_netral .", `prob_neg` = ".$prob_kata_negatif .", `bobot_tfidf` = ".$bobot_tfidf ."WHERE `id_training` = '$idt'");
    }
}

function sentimen()
{
	$query_dok = mysqli_query($this->koneksidb,"SELECT * FROM data_testing ORDER BY `id_training`");

while ($row_dok =  mysqli_fetch_array($query_dok)) {

$idt = $row_dok['id_training'];
$tweet = $row_dok['tweet_text'];
$prob_dokumen_positif= $row_dok['prob_pos'];
$prob_dokumen_netral= $row_dok['prob_netral'];
$prob_dokumen_negatif= $row_dok['prob_neg'];
$snt= $row_dok['sentimen'];


    $probabilitas_terbesar = $prob_dokumen_positif;

    if($prob_dokumen_netral > $probabilitas_terbesar)
    {
        $probabilitas_terbesar = $prob_dokumen_netral;
    }
    if($prob_dokumen_negatif > $probabilitas_terbesar)
    {
        $probabilitas_terbesar = $prob_dokumen_negatif;
    }

    echo 'Bilangan terbesar = '.$probabilitas_terbesar;
    echo "<br>";


    if($probabilitas_terbesar == 1 or $probabilitas_terbesar == 0)
    {
        echo "TIDAK TERKLASIFIKASI";
    }

    else if($probabilitas_terbesar == $prob_dokumen_positif)
    {
        $query_simpan = mysqli_query($this->koneksidb, "UPDATE `data_testing` SET `sentimen` = 'POSITIF' WHERE `id_training` = '$idt'");

    }

    else if($probabilitas_terbesar == $prob_dokumen_netral)
    {

        $query_simpan = mysqli_query($this->koneksidb, "UPDATE `data_testing` SET `sentimen` = 'NETRAL' WHERE `id_training` = '$idt'");
    }

    else if($probabilitas_terbesar == $prob_dokumen_negatif)
    {
        $query_simpan = mysqli_query($this->koneksidb, "UPDATE `data_testing` SET `sentimen` = 'NEGATIF' WHERE `id_training` = '$idt'");
    }


echo $tweet ." Adalah tweet : " .$snt ."<br>";

}

}





}


        


?>