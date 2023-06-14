<?php
include 'koneksi/koneksi.php';
require_once 'config_login.php';

session_start();

if(isset($_GET['code'])){
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    $googleAuth = new Google_Service_Oauth2($client);
    $google_info = $googleAuth->userinfo->get();

    $_SESSION['info'] =[
        'name' => $google_info->name,
        'email' => $google_info->email,
        'picture' => $google_info->picture,
    ];
    
    $cek = mysqli_query($conn, "SELECT * FROM customer where email = '$google_info->email'");
    $jml = mysqli_num_rows($cek);
    $row = mysqli_fetch_assoc($cek);

    if($jml ==1){
        $_SESSION['user'] = $row['nama'];
        $_SESSION['kd_cs'] = $row['kode_customer'];
        header('location:../index.php');
    }else{
        $kode = mysqli_query($conn, "SELECT kode_customer from customer order by kode_customer desc");
        $data = mysqli_fetch_assoc($kode);
        $num = substr($data['kode_customer'], 1, 4);
        $add = (int) $num + 1;
        if(strlen($add) == 1){
            $format = "C000".$add;
        }else if(strlen($add) == 2){
            $format = "C00".$add;
        }
        else if(strlen($add) == 3){
            $format = "C0".$add;
        }else{
            $format = "C".$add;
        }

        $hash = password_hash($google_info->email, PASSWORD_DEFAULT);
        $result = mysqli_query($conn, "INSERT INTO customer VALUES('$format','$google_info->name', '$google_info->email', '$google_info->email', '$hash', '', '', '', '', 0)");
        
        $_SESSION['user'] = $google_info->name;
        $_SESSION['kd_cs'] = $format;
        header('location:../index.php');


    }
    //redifect -kehalaman utama
    header('Location: index.php');
}


?>