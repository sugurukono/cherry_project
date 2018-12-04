<?php 
    session_start();
    require('functions.php');
    require('dbconnect.php');


    $sql = 'SELECT * FROM `users` WHERE `id`=?';
    $data = array($_SESSION["id"]);//WHEREで入れたやつだけでOK
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    $user_id="";
    $user_id=$signin_user['id'];
    $folder='';


//時間を取ってくる作業
    $d_time=$_SESSION['cherry']['data3']['delete_time'];
    $d_room_id=$_SESSION['cherry']['data3']['id'];
    v($_SESSION['cherry']['data3']['delete_time'],'$_SESSION[cherry][data3][delete_time]');
    v($d_time,'$d_time');
    v($d_room_id,'$d_room_id');
    date_default_timezone_set('Asia/Manila');
    $send_date=date("Y-m-d H:i:s");
    v($send_date,'$send_date');


//foldersテーブルからデータ取得①
    $sql = 'SELECT * FROM `folders` WHERE `user_id`=?';
    $data = array($_SESSION['id']);//WHEREで入れたやつだけでOK
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
//$foldersに格納②
    while(true){
        $folder = $stmt->fetch(PDO::FETCH_ASSOC);

        if($folder == false){
            break;
        }
        $folders[] = $folder;
    }

// フォルダーを押したら
    if (!empty($_POST['folder'])) {
        $folder=$_POST['folder'];
       v($folder,'$folder');//フォルダーの名前が入っている
    }

// フォルダーを押すと友達一覧が表示される処理
    $sql='SELECT `user_name`,`folder_id`,`friend_id`,`user_img` FROM `users` INNER JOIN `friends_folders`
    ON `friends_folders`.`friend_id`= `users`.`id` WHERE `friends_folders`.`folder_owner_id`=?';
    $data= array($_SESSION['id']);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $friends=[];

    while(true){
        $friend =$stmt->fetch(PDO::FETCH_ASSOC);

        if($friend == false){
            break;
        }
            $friends[]=$friend;
             // v($friends,'$friends');
            // $friend_each
    }
    // v($friends,'$friends');

//フォルダー選択→友達選択
    if (!empty($_POST['folder_id'])) {
        $folder_id= "";
        $folder_id= $_POST['folder_id'];
        v($folder_id,'$folder_id');
        $_SESSION['cherry']['folder_id']=$folder_id;
        v($_SESSION['cherry']['folder_id'],'$_SESSION[cherry][folder_id]');//フォルダーのidが入っている
    }

    if (!empty($_GET['friend_id'])) {
        $friend_id= "";
        $friend_id= $_GET['friend_id'];
        // v($friend_id,'$friend_id');
        $_SESSION['cherry']['friend_id']=$friend_id;
        $friend_id2=$_SESSION['cherry']['friend_id'];
        v($_SESSION['cherry']['friend_id'],'$_SESSION[cherry][friend_id]');

        $sql='SELECT `user_name`FROM `users` WHERE `id`=?';
        $data= array($friend_id2);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        $select_friend=$stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['cherry']['select_friend']=$select_friend;
        v($select_friend,'$select_friend');
        v($_SESSION['cherry']['select_friend']['user_name'],'$_SESSION[select_friend]');
        $selected_friend=$_SESSION['cherry']['select_friend']['user_name'];
    }


    // v($friend_id2,'$friend_id2');


    // v($friends,'$friends');
    // v($_GET['sending'],'$_GET[sending]');
    // v($friend_id,'$friend_id');
    // v($signin_user['id'],'$signin_user');
    // v($friends['friend_id'],'$friends[friend_id]');

    //チャットルームを探すSELECT分実行
    if (!empty($friend_id)) {
        $sql='SELECT * FROM `chatroom` WHERE `owner_id`=? AND`member_id`=?';
        $data = array($user_id,$friend_id);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        $chatroom_data=$stmt->fetch(PDO::FETCH_ASSOC);
        // v($chatroom_data,'$chatroom_data');
        // IDの反対の組み合わせでないか確認
        if (empty($chatroom_data)) {
            $sql='SELECT * FROM `chatroom` WHERE `owner_id`=? AND`member_id`=?';
            $data = array($friend_id,$user_id);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);
            $chatroom_data2=$stmt->fetch(PDO::FETCH_ASSOC);
            $chatroom_id=$chatroom_data2['id'];
            v($chatroom_id,'$chatroom_data2');
            $_SESSION['cherry']['chatroom_id']=$chatroom_id;

            //存在していない時はチャットルームにデータを挿入
            if (empty($chatroom_data2["id"])){
                $sql='INSERT INTO `chatroom` SET `owner_id`=?, `member_id`=?, `created`=NOW()';
                $data = array($user_id,$friend_id);
                $stmt = $dbh->prepare($sql);
                $stmt->execute($data);
                $chatroom_id=$dbh->lastInsertId();
                $_SESSION['cherry']['chatroom_id']=$chatroom_id;

            }
        }else{//存在している時はチャットルームIDを取得
            $chatroom_id=$chatroom_data['id'];
            $_SESSION['cherry']['chatroom_id']=$chatroom_id;
            v($_SESSION['cherry']['chatroom_id'],'$chatroom_id');
        }
    }
    // v($_SESSION['cherry']['chatroom_id'],'$_SESSION[cherry][chatroom_id]');

// 送信ボタンを押されたら、自分のトークが表示される
    if (!empty($_POST['sending'])) {
        $sql= 'INSERT INTO `talk` SET `chatroom_id`=?, `sender_id`=?, `receiver_id`=?, `message_type`=1, `message`=?,`send_date`=NOW()';
        $data = array($_SESSION['cherry']['chatroom_id'],$signin_user['id'],$_SESSION['cherry']['friend_id'],$_POST['sending'],);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
    }


//トークの内容を取得
        $sql='SELECT * FROM `talk` WHERE `chatroom_id`=?';
        $data = array($_SESSION['cherry']['chatroom_id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        $talks=[];
        while (true) {
        $talk =$stmt->fetch(PDO::FETCH_ASSOC);
        if ($talk == false) {
            break;
        }
        $talks[]=$talk;
        // v($talks,'$talks');
    }

    // v($_SESSION,('$_SESSION'));

    // ＊＊文字変換ファンクション＊＊
    // ①変更したいルールを取得
    $sql='SELECT * FROM `magic_changes` WHERE user_id=?';
    $data=array($user_id);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rule=$stmt->fetch(PDO::FETCH_ASSOC);

    // v($rule,'$rule');

    if (!empty($_GET['magic_delete'])) {
        $sql='DELETE FROM `magic_changes` WHERE user_id=?';
        $data=array($user_id);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
    }

// リクエストを送られた場合
    $sql='SELECT `users`.`id`,`users`.`user_name` FROM `users` INNER JOIN `friends` ON `friends`.`requester_id`= `users`.`id` WHERE `friends`.`accepter_id`=? AND `friends`.`status`=1';
    $data= array($user_id);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $reqs=[];

    while(true){
        $requesting=$stmt->fetch(PDO::FETCH_ASSOC);

        if($requesting == false){
            break;
        }
            $reqs[]=$requesting;
    }
    // v($reqs, '$reqs');

//リクエスト中の処理
    $sql='SELECT `users`.`id`,`users`.`user_name` FROM `users` INNER JOIN `friends` ON `friends`.`accepter_id`= `users`.`id` WHERE `friends`.`requester_id`=? AND `friends`.`status`=1';
    $data= array($user_id);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $waits=[];

    while(true){
        $wait=$stmt->fetch(PDO::FETCH_ASSOC);
        if($wait == false){
            break;
        }
        $waits[]=$wait;
    }
    // v($waits, '$waits');

// オートマでデリート処理
    if (!empty($d_time) && $d_time < $send_date) {
        $sql='DELETE FROM `chatroom` WHERE `id`=?';
        $data=array($d_room_id);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
    }


?>





<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トーク／メイン</title>


    <link type="text/css" rel="stylesheet" href="bmesse.css" />
    <link rel="stylesheet" type="text/css"  href="css/header.css">
    <link rel="stylesheet" type="text/css"  href="header_only.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

</head>

<body>
    <!-- ヘッダー 開始-->
  <div class="row">
    <div class="col-xs-12" style="background-color: #003366; height: 90px">
    <a href="top.php"><h1 class="title" style="color:white;">🍒Cherry</h1></a>

    <li class="words">
        <a href="">My Page</a>
    </li>
     
    <li class="words"><a href="">Talk</a>
    </li>


    <li class="words">
        <a href="#">Add Friends</a>
    </li>
     

    <li class="words">
        <a href="setting.php">Setting</a>
    </li>
     
     <li class="words">
        <a href="#">Fake Page</a>
    </li>

    <li class="words">

        <a href="signout.php">Log Out</a>

    </li>

         </ul>
    </div>
  </div>

<!-- ヘッダー終わり -->

<!--トークの設定 -->
    <div id="sub_container" class="col-xs-3" style="background-color:black; height:715px">
    <img class="img" src="images/icon_setting.jpg">
    <img class="img" src="images/icon_setting.jpg">
    <img class="img" src="images/icon_setting.jpg">
    <br>
    <span class="karaage">Setting</span></label>
    <br>
    <br>
<!-- モーダル チェックボックス-->
<!-- 文字変換機能設定 -->
    <div class="modal_wrap">
    <input id="trigger" type="checkbox">
    <label for="trigger" style="color:pink; font-size:15px;">文字変換設定</label>

    <div class="modal_overlay">
        <label for="trigger" class="modal_trigger"></label>
        <div class="modal_content">
            <label for="trigger" class="close_button">✖️</label>
            <h2>文字変換設定</h2>
            <?php if(!empty($rule)): ?>
                <p>※すでに登録済みです。※</p>
                <p>もし登録を削除される場合はボタンを押して再登録してください。</p>
                <form method="GET" action="">
                    <input type="submit" name="magic_delete" value="削除" class="square_btn5">
                </form>
            <?php endif; ?>
            <?php if(empty($rule)): ?>
            <p>※注※全てのチャットルームに適応されます。</p>
            <form method="GET" action="magic.php">
            「<input type="text" name="comment" class="textbox"value=""> 」を
            「<input type="text" name="magic_com" class="textbox" value="">」へ
            <select name="time" class="select">
                <option value="now">今すぐ</option>
                <option value="1hour">一時間後</option>
                <option value="12hour">１２時間後</option>
                <option value="24hour">２４時間後</option>
            </select>
            に変更
            <br>
            <br>
            <input type="submit" value="設定" class="square_btn5">
            </form>
        <?php endif; ?>
        </div>
    </div>
    </div>
    <br>
    <br>

<!-- トーク削除設定 -->
    <div class="modal_wrap">
    <input id="trigger3" type="checkbox">
    <label for="trigger3" style="color:pink; font-size:12px;">トークルーム削除</label>

    <div class="modal_overlay">
        <label for="trigger3" class="modal_trigger"></label>
        <div class="modal_content">
            <label for="trigger3" class="close_button">✖️</label>
            <h2>トークルーム削除</h2>

           <form submit="GET" action="delete_magic.php">
            <!-- フレンドセレクト -->
            <select class="select" name="friend_id">
            <?php foreach($friends as $friend_each): ?>
            <option value=<?php echo $friend_each['friend_id'] ?>><?php echo $friend_each['user_name']?><option>
            <?php endforeach; ?>
            </select>
            さんとのトークを

            <select name="delete_time" class="select">
                <option value="-1">今すぐ</option>
                <option value="1">一時間後</option>
                <option value="2">１２時間後</option>
                <option value="3">２４時間後</option>
            </select>
            に削除
            <br>
            <br>
             <p>一度削除したトークは戻せません。よろしいですか？</p>
            <input type="submit" value="削除" class="square_btn5">
            </form>
        </div>
    </div>
    </div>
    <br>
    <br>

<!-- リクエスト申請中 -->
    <div class="modal_wrap">
    <input id="trigger4" type="checkbox">
    <label for="trigger4" style="color:pink; font-size:12px;">
    ＊リクエスト中＊</label>
        <div class="modal_overlay">
        <label for="trigger4" class="modal_trigger"></label>
            <div class="modal_content">
            <label for="trigger4" class="close_button">✖️</label>
            <h2>リクエストを申請中の友だち一覧</h2><br>
            <?php if (!empty($waits)): ?>
            <p>友だちがリクエストを承認すると、全友だちフォルダに追加されます。</p>
            <p>友だちが承認しない場合は、直接連絡を取ってみてくださいね。</p>
            <!-- リクエストを送られた場合 -->
            <form submit="GET" action="">
            <?php foreach ($waits as $waits_each): ?>
                <input type="checkbox" name="requested[]" value="<?php echo $waits_each['id']?>"><b style="font-size: 20px; float: center;"><?php echo $waits_each['user_name']?></b><br><br>
            <?php endforeach; ?>
            <input type="submit" value="申請をやめる" class="square_btn8" name="delete">
            <br>
            <br>
            </form>
            <?php elseif (empty($waits)):?>
            <p>リクエスト中のお友達はいません。</p>
            <?php endif; ?>
            </div>
        </div>
    </div>

<!-- リクエスト送られて来た場合 -->
    <?php if (!empty($reqs)): ?>
    <div class="modal_wrap">
    <input id="trigger2" type="checkbox">
    <label for="trigger2" style="color:pink; font-size:12px;">
    ❗️リクエスト</label>
        <div class="modal_overlay">
        <label for="trigger2" class="modal_trigger"></label>
            <div class="modal_content">
            <label for="trigger2" class="close_button">✖️</label>
            <h2>❗️リクエストが届いています。</h2><br>
            <p>承認したい人を選んで、承認ボタンを押してください。</p>
            <p>見覚えのない申請がある場合は、選択しBlockボタンを押してください。削除されます。</p>
           
            <!-- リクエストを送られた場合 -->
            <form submit="GET" action="rec_accepted.php">
            <?php foreach ($reqs as $reqs_each): ?>
                <input type="checkbox" name="accepted[]" value="<?php echo $reqs_each['id']?>"><b style="font-size: 20px; float: center;"><?php echo $reqs_each['user_name'] ?></b><br><br>
            <?php endforeach; ?>
            <br>
            <br>
            <input type="submit" value="Block" class="square_btn8" name="block">
            <input type="submit" style="margin-right:30px;" name="accept" value="承認" class="square_btn5">
            </form>
            </div>
        </div>
    </div>
        <?php endif ;?>

    </div>

    


    <!-- フォルダー -->
    <div id="container" class="col-xs-3" style="background-color:pink; height:715px">
        <div class="font" style="font-size: 25px;"><p>Folders</p></div>
        <?php if (isset($folders)): ?>
        <?php foreach($folders as $folder_each) :?>
        <form method="POST" action="">
        <input type="submit" name="folder" class="square_btn6" value="<?php echo $folder_each['folder_name'] ?>">
        <input type="hidden" name="folder_id" value="<?php echo $folder_each['id']?>">
        </form>
        <?php endforeach; ?>
        <?php endif ?>
    </div>



    <div id="container" class="col-xs-3" style="background-color:white; height:715px">
    <div class="font" style="font-size: 25px;"><p>Friends</p></div>


    <!-- 友達一覧ボタン-->
        
        <?php if (isset($folder_id)): ?>
        <?php foreach($friends as $friend_each): ?>
        <?php if($friend_each['folder_id'] == $folder_id): ?>
        <div>
        <form method="GET" action="">
        <button class="square_btn7" value="">🍒<?php echo $friend_each['user_name'] ?></button>


        <?php foreach($waits as $waits_each) ?>
        <?php if($friend_each['friend_id'] == $waits_each['id']) :?>
            <b style="font-size: 15px;"><br>リクエスト中</b>
        <?php endif; ?>


        <input type="hidden" name="friend_id"  value="<?php echo $friend_each['friend_id']?>">
        <input type="hidden" name="folder_id" value="<?php echo $friend_each['folder_id']?>">
        </form>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>

    </div>



<!-- トーク -->
    <div id="your_container">
        <!-- チャットの外側部分① -->
        <div id="bms_messages_container">
            <!-- ヘッダー部分② -->
            <div id="bms_chat_header">
                <!--ステータス-->
                <div id="bms_chat_user_status">
                    <!--ステータスアイコン-->
                    <!-- <div id="bms_status_icon">🍒</div> -->
                    <!--ユーザー名-->
                    <!-- <div id="bms_chat_user_name" "><?php echo $signin_user['user_name'] ?></div>
 -->
                    <?php if (isset($chatroom_id)): ?>
                    <div id="bms_status_icon" ">🍒</div>
                    <div id="bms_chat_user_name" ><?php echo $_SESSION['cherry']['select_friend']['user_name'] ?>さん</div>
                    <?php endif ?>
                </div>
            </div>
            <!-- タイムライン部分③ -->
            <div >
                <?php if ($chatroom_id==$d_room_id && !empty($d_time) && $d_time !== "0000-00-00 00:00:00" && $d_time > $send_date) :?>
                <b>削除設定中：<?php echo $d_time ?></b><?php endif; ?>
                <?php if(empty($d_time)): ?>
                    <b>enjoy!</b>
                <?php endif; ?>
            </div>
            <div id="bms_messages">
                <?php if (isset($_SESSION['cherry']['friend_id'])): ?>
                <?php foreach ($talks as $talk_each):?>
                <!--メッセージ１（左側）-->
                <?php if ($talk_each['sender_id']==$_SESSION['cherry']['friend_id'] ): ?>
                <div class="bms_message bms_left">
                    <div class="bms_message_box">
                        <div class="bms_message_content">
                            <div class="bms_message_text"><span></span><?php echo magic($talk_each['message'],$talk_each['send_date'],$rule); ?></div>
                        </div>
                    </div>
                </div>
                <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->
                 <?php endif ?>

                <!--メッセージ（右側）-->
                <?php if($talk_each['sender_id']== $user_id): ?>
                <div class="bms_message bms_right">
                    <div class="bms_message_box">
                        <div class="bms_message_content">
                            <div class="bms_message_text"><?php echo magic($talk_each['message'],$talk_each['send_date'],$rule); ?></div>
                        </div>
                    </div>
                </div>
                <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <!-- テキストボックス、送信ボタン④ -->
            <div id="bms_send">
                <form method="POST" action="">
                <input type="text" name="sending" id="bms_send_message">
                <input type="submit"  id="bms_send_btn"value="送信">
            </div>
                </form>
            </div>
        </div>
    </div>

    <!-- フッター -->
  <div class="row">
    <div class="col-xs-12" style="background-color: #003366; height:50px">
      <p class="footer">Designed by Cherry</p>
    </div>
  </div>
<!-- フッター終わり -->
</body>
</html>