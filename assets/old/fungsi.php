<?php


    function reset_information_gain($koneksi)
    {
        $query_hapus = mysqli_query($koneksi, "TRUNCATE TABLE `data_training_kata`");
    }


?>