<?php
    session_start();
    require('functions.php');
    require('dbconnect.php');

    $user_id=$_SESSION['id'];

//トーク削除トライ中
    // echo date_default_timezone_get();  //ベルリンになっている・・・
    date_default_timezone_set('Asia/Manila');
    echo date("Y/m/d H:i:s");
    v($_GET['delete_time'],'$_GET[delete_time]'); //合ってる
    v($_GET['friend_id'],'$_GET[friend_id]');       //合ってる

    if (!empty($_GET['delete_time']) && !empty($_GET['friend_id'])) {
        $delete_time=$_GET['delete_time'];
        $friend_id=$_GET['friend_id'];
        $sql='SELECT * FROM `chatroom` WHERE `owner_id`=? AND`member_id`=?';
        $data = array($user_id,$friend_id);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        $chatroom_data3=$stmt->fetch(PDO::FETCH_ASSOC);
        v($chatroom_data3,'$chatroom_data3');//合ってる

        $send_date=date("Y-m-d H:i:s");
        v($send_date,'$send_date');
        // $send_date20=date("Y/m/d H:i:s", strtotime($send_date." +1 HOUR"));
        // v($send_date20,'$send_date20');

        if($delete_time == -1){//0だとエンプティになるので-1
        $delete_date_time=date($send_date,strtotime($send_date));
        $sql='UPDATE `chatroom` SET `status`=0,`delete_time`=? WHERE `id`=?';
        $data=array($delete_date_time,$chatroom_data3['id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        $chatroom_data3["status"]=0;
        $chatroom_data3["delete_time"]=$delete_date_time;

        }elseif($delete_time == 1){
            $delete_date_time=date("Y-m-d H:i:s", strtotime($send_date." +20 SECONDS"));
            v($delete_date_time,'$delete_time');
            $sql='UPDATE `chatroom` SET `status`=1,`delete_time`=? WHERE `id`=?';
            $data=array($delete_date_time,$chatroom_data3['id']);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);

            $chatroom_data3["status"]=1;
            $chatroom_data3["delete_time"]=$delete_date_time;


        }elseif($delete_time == 2){
            $delete_date_time=date("Y-m-d H:i:s", strtotime($send_date." +12 HOURS"));
            v($delete_date_time,'$delete_time');
            $sql='UPDATE `chatroom` SET `status`=2,`delete_time`=? WHERE `id`=?';
            $data=array($delete_date_time,$chatroom_data3['id']);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);

            $chatroom_data3["status"]=2;
            $chatroom_data3["delete_time"]=$delete_date_time;

        }elseif($delete_time == 3){
            $delete_date_time=date("Y-m-d H:i:s", strtotime($send_date." +24 HOURS"));
            v($delete_date_time,'$delete_time');
            $sql='UPDATE `chatroom` SET `status`=3,`delete_time`=? WHERE `id`=?';
            $data=array($delete_date_time,$chatroom_data3['id']);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);


            $chatroom_data3["status"]=3;
            $chatroom_data3["delete_time"]=$delete_date_time;
        }
        
        $_SESSION['cherry']['data3']=$chatroom_data3;

        v($_SESSION['cherry']['data3'],'session');


    }


    header('Location: talk_main1.php');
    exit();



 ?>