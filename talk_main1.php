<?php 
    session_start();
    require('functions.php');
    require('dbconnect.php');

    $sql = 'SELECT * FROM `users` WHERE `id`=?';
    $data = array($_SESSION["id"]);//WHEREで入れたやつだけでOK
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    v($signin_user,'$signin_user');

    $user_id="";
    $signin_user['id'] = $user_id;
    $folder='';
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
    v($folders,'$folders');
    if (!empty($_GET['folder'])) {
      $folder=$_GET['folder'];
       // v($folder,"$folder");
    }

// フォルダーを押すと友達一覧が表示される処理
    $sql='SELECT `user_name`,`folder_id`,`friend_id` FROM `users` INNER JOIN `friends_folders`
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
    }

    v($friends,'$friends');
    v($_GET['sending'],'$_GET[sending]');

// 送信ボタンを押されたら、自分のトークが表示される
    if (!empty($_GET['sending'])) {
        $sql= 'INSERT INTO `talk` SET `sender_id`=?, `receiver_id`=4, `message_type`=1, `message`=?,`send_date`=NOW();';
        $data = array($signin_user['id'], $_GET['sending']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        
    }
//トークの内容を取得
        $sql='SELECT `message` FROM `talk` WHERE `sender_id`=?';
        $data = array($signin_user['id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        $talks=[];

    while (true) {
        $talk =$stmt->fetch(PDO::FETCH_ASSOC);
        if ($talk == false) {
            break;
        }
        $talks[]=$talk;
    }

    v($talks,'$talks');
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

</head>

<body>
    <!-- ヘッダー 開始-->
  <div class="row">
    <div class="col-xs-12" style="background-color: #003366; height: 90px">
      <h1 class="title" style="color:white;">🍒Cherry</h1>

    <li class="words">
        <a href="#">My Page</a>
    </li>
     
    <li class="words"><a href="#">Talk</a>
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
        <a href="#">Log Out</a>
    </li>

         </ul>
    </div>
  </div>

<!-- ヘッダー終わり -->

    <!-- 自分やユーザーの情報 -->
    <div id="sub_container" class="col-xs-3" style="background-color:black; height:690px">
        <img src="images/icon_camera.jpeg"><br><br>
        <img src="images/icon_apple.jpeg"><br><br>
        <img src="images/icon_ninja.jpeg"><br><br>
        <img src="images/icon_hotspring.jpeg"><br><br>
    </div>




    <!-- フォルダー -->
    
    <div id="container" class="col-xs-3" style="background-color:pink; height:690px">
         <div class="font" style="font-size: 25px;"><p>Folders</p></div>
        <?php foreach($folders as $folder_each) :?>
        <form method="GET" action="">
        <input type="submit" name="folder" class="box13" value="<?php echo $folder_each['folder_name'] ?>">
        <input type="hidden" name="folder_id" value="<?php echo $folder_each['id']?>">
        </form>
    <?php endforeach; ?>
    </div>



    <div id="container" class="col-xs-3" style="background-color:white; height:690px">
    <!-- 友達一覧 -->
        <!-- <div class="font" style="font-size: 25px;"><p>Friends</p></div> -->
        <?php if (isset($_GET['folder_id'])): ?>
        <?php foreach($friends as $friend_each): ?>
        <?php if($friend_each['folder_id']== $_GET['folder_id']): ?>
        <div><p class="font">🍒<?php echo $friend_each['user_name'] ?></p></div>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>




    <div id="your_container">
        <!-- チャットの外側部分① -->
        <div id="bms_messages_container">
            <!-- ヘッダー部分② -->
            <div id="bms_chat_header">
                <!--ステータス-->
                <div id="bms_chat_user_status">
                    <!--ステータスアイコン-->
                    <div id="bms_status_icon">🍒</div>
                    <!--ユーザー名-->
                    <div id="bms_chat_user_name"><?php echo $signin_user['user_name'] ?></div>
                </div>
            </div>

            <!-- タイムライン部分③ -->
            <div id="bms_messages">

                <!--メッセージ１（左側）-->
                <div class="bms_message bms_left">
                    <div class="bms_message_box">
                        <div class="bms_message_content">
                            <div class="bms_message_text">ほうほうこりゃー便利じゃないか</div>
                        </div>
                    </div>
                </div>
                <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->

                <div class="bms_message bms_left">
                    <div class="bms_message_box">
                        <div class="bms_message_content">
                            <div class="bms_message_text">なかなかいい感じでしょ</div>
                        </div>
                    </div>
                </div>
                <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->

                <!--メッセージ２（右側）-->
                <?php foreach ($talks as $talk_each):?>
                <div class="bms_message bms_right">
                    <div class="bms_message_box">
                        <div class="bms_message_content">
                            <div class="bms_message_text"><?php echo $talk_each['message']?></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <br>
                <div class="bms_clear"></div>
                <!-- 回り込みを解除（スタイルはcssで充てる） -->
            </div>

            <!-- テキストボックス、送信ボタン④ -->
            <div id="bms_send">
                <form method="GET" action="">
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