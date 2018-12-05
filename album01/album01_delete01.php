<?php

    session_start();
    require('../functions.php');
    require('../dbconnect.php');

    $user_id=$_SESSION['id'];

//トーク削除トライ中
    // echo date_default_timezone_get();  //ベルリンになっている・・・
    date_default_timezone_set('Asia/Manila');
    echo date("Y/m/d H:i:s");
    v($_GET['delete_time'],'$_GET[delete_time]'); //合ってる
    v($_GET['pic_id'],'$_GET[pic_id]');       //合ってる

    if (!empty($_GET['delete_time']) && !empty($_GET['id'])) {
        $delete_time=$_GET['delete_time'];
        $pic_id=$_GET['id'];
        $sql='SELECT * FROM `pics` WHERE `id`=?';
        $data = array($pic_id);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        $pics_data=$stmt->fetch(PDO::FETCH_ASSOC);
        v($pics_data,'$pics_data');//合ってる

        $send_date=date("Y-m-d H:i:s");
        v($send_date,'$send_date');
        // $send_date20=date("Y/m/d H:i:s", strtotime($send_date." +1 HOUR"));
        // v($send_date20,'$send_date20');

        if($delete_time == -1){//0だとエンプティになるので-1
        $delete_date_time=date($send_date,strtotime($send_date));
        $sql='UPDATE `pics` SET `delete_time`=? WHERE `id`=?';
        $data=array($delete_date_time,$pics_data['id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        $pics_data["delete_time"]=$delete_date_time;

        }elseif($delete_time == 1){
            $delete_date_time=date("Y-m-d H:i:s", strtotime($send_date." +20 SECONDS"));
            v($delete_date_time,'$delete_time');
            $sql='UPDATE `pics` SET `delete_time`=? WHERE `id`=?';
            $data=array($delete_date_time,$pics_data['id']);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);

            $pics_data["delete_time"]=$delete_date_time;


        }elseif($delete_time == 2){
            $delete_date_time=date("Y-m-d H:i:s", strtotime($send_date." +12 HOURS"));
            v($delete_date_time,'$delete_time');
            $sql='UPDATE `pics` SET `delete_time`=? WHERE `id`=?';
            $data=array($delete_date_time,$pics_data['id']);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);

            $pics_data["delete_time"]=$delete_date_time;

        }elseif($delete_time == 3){
            $delete_date_time=date("Y-m-d H:i:s", strtotime($send_date." +24 HOURS"));
            v($delete_date_time,'$delete_time');
            $sql='UPDATE `pics` SET `delete_time`=? WHERE `id`=?';
            $data=array($delete_date_time,$pics_data['id']);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);

            $pics_data["delete_time"]=$delete_date_time;

        }
        
        $_SESSION['cherry']['data3']=$pics_data;

        v($_SESSION['cherry']['data3'],'session');


    }


    header('Location: album01.php');
    exit();



 ?>