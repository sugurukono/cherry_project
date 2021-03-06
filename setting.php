<?php
    session_start();
    require('functions.php');
    require('dbconnect.php');


// usersテーブルからデータ取得
    $sql = 'SELECT * FROM `users` WHERE `id`=?';
    $data = array($_SESSION["id"]);//WHEREで入れたやつだけでOK
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['Cherry']['signin_user_id'] = $signin_user['id'];


    $user_id="";
    $user_id = $signin_user['id'];
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
    if (!empty($_GET['folder'])) {
      $folder=$_GET['folder'];

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


// ID検索ファンクション
    if (!empty($_GET['search_friend'])) {
        $search_friend= $_GET['search_friend'];
        $sql= "SELECT * FROM `users` WHERE `search_id`=?";
        $data= array($search_friend);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        $related_friend =$stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['cherry']['related_friend']=$related_friend;
    }


// プロフィール情報の読み込み

    $user_img = $signin_user['user_img'];
    $user_name = $signin_user['user_name'];
    $search_id = $signin_user['search_id'];
    $email = $signin_user['email'];
    $comments = $signin_user['comments'];

//バリデーション
    if(!empty($_SESSION['error'])){
        $error['user_name'] = $_SESSION['error']['name'];
        $error['search_id'] = $_SESSION['error']['search_id'];
        $error['email'] = $_SESSION['error']['email'];
    }

//友達一覧があるかどうかの確認
    $sql = 'SELECT * FROM `folders` WHERE `folder_name`="友達一覧" AND `user_id`=?';
    $data= array($signin_user['id']);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $all_friend_folder =$stmt->fetch(PDO::FETCH_ASSOC);
      if ($all_friend_folder == false) {
            $sql = 'INSERT INTO `folders` SET `folder_name`="友達一覧",`user_id`=?, `created`= NOW()';
            $data = array($signin_user['id']);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);
            $_SESSION['cherry']['all_friend_folder_id']=$dbh->lastInsertId();
      }else{
        //ある場合
        $_SESSION['cherry']['all_friend_folder_id']=$all_friend_folder['id'];
      }

?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <title>Settings</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css"  href="header_only.css">
  <link rel="stylesheet" type="text/css"  href="setting.css">

  <!-- viewport meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<!-- ヘッダー 開始-->
  <div class="row" id="header">
    <div class="col-xs-12" style="background-color: #003366; height: 90px">
      <h1 class="title" style="color:white;">🍒Cherry</h1>

    <li class="words">
        <a href="album01/album01.php">My Page</a>
    </li>
    <li class="words"><a href="talk_main1.php">Talk</a>
    </li>
    <li class="words">
        <a href="#friends">Add Friends</a>
    </li>
    <li class="words">
        <a href="setting.php">Setting</a>
    </li>
     <li class="words">
        <a href="fake.php">Fake Page</a>
    </li>
    <li class="words">
        <a href="signout.php">Log Out</a>
    </li>
    </div>
     <div class=row>
    <div class="col-xs-12" style="background-color: pink; height: 50px">

      <li class="menu">
        Setting Menu:
      </li>
      <li class="words2">
        <a href="#profile">Profile</a>
      </li>

      <li class="words2">
        <a href="#friends">Friends</a>
      </li>

      <li class="words2">
        <a href="#friends_list">Friends list</a>
      </li>

      <li class="words2">
        <a href="#help">help</a>
      </li>

      <li class="words2">
        <a href="#qanda">Q&A</a>
      </li>


    </div>
  </div>
  </div>

  <div class="img background">
    <div class="container">
      <div>
        <h1 id="profile"><span class="title_1">♦︎プロフィール編集♦︎</span></h1>

        <div class="row">
          <form method="POST" action="update_profile.php" enctype="multipart/form-data">
          <div class="col-xs-6" style="height: 500px; background-color: #37b8e061; margin:30px 0px;">
            <div class="profile1">
                <b>プロフィール画像</b> 
                  <?php if($user_img == '') :?>
                  <img src="img/profile_first.jpg" style="width: 300px; height: 300px;">
                  <?php else : ?>
                <img src="user_img/<?php echo $user_img; ?>" style="width: 300px; height: 300px;">
                <?php endif; ?>
                <span class="square_btn"><input type="file" name="img_name" accept="image/*"></span>
            </div>
          </div>
          <div class="col-xs-6" style="height: 500px; background-color: #37b8e061; margin: 30px 0px;">
            <div class="profile2"><br>
                <b>お名前</b>
                <input type="text" name="name" placeholder="さくらんぼ" value="<?php echo htmlspecialchars($user_name); ?>" class="text"><br>
                <?php if (isset($error['user_name']) && $error['user_name'] == 'blank'):?>
                  <p> <span class="error_msg">お名前を入力してください。</span></p>
                <?php endif; ?>
                <b>ID設定</b>
                <input type="text" name="id" placeholder="sakura"value="<?php echo htmlspecialchars($search_id); ?>" class="text"><br>
                <?php if (isset($error['search_id']) && $error['search_id'] == 'blank'):?>
                  <p> <span class="error_msg">IDを入力してください。</span></p>
                <?php endif; ?>
                <b>Email</b>
                <input type="email" name="email" placeholder="sakura@gmail.com" value="<?php echo htmlspecialchars($email); ?>" class="text"><br>
                <?php if (isset($error['email']) && $error['email'] == 'blank'):?>
                  <p> <span class="error_msg">メールアドレスを入力してください。</span></p>
                <?php endif; ?>
                <b>ひとこと</b>
                <textarea placeholder="🍒チェリー" class="text" name="comments"><?php echo htmlspecialchars($comments); ?></textarea>
                <input type="submit" value="更新" class="square_btn4" style="float: right;">
            </div>
          </div>
          </form>
        </div>
        </div>
      </div>
    </div><!-- class="img background" -->

    <div class="row">
      <div class="col-xs-12" style="background-color:black; height:50px;" ></div>
    </div>

<div class="img background2">
  <div class="container">
        <div>
          <h1 id="friends"><span class="title_2">♦︎友達検索♦︎</span></h1>
          <div class="row">
            <div class="col-xs-6" style="height: 600px; background-color: #37b8e061; margin:30px 0px;">
              <!-- ID検索 -->
              <div class="id">
                <b style="font-size: 20px;">ID検索：</b>
                <form action="" method="GET">
                  <input type="text" name="search_friend" value="" class="text">
                  <input type="submit" value="検索" class="square_btn "><br>
                  <b style="font-size: 20px">検索結果:<?php if(!empty($_GET['search_friend'])): ?><?php echo $related_friend['user_name'] ?>
                  <?php endif; ?>
                  </b>
                </form>
              </div>
              <div class="pic">
                <?php if(empty($_GET['search_friend'])): ?>
                <img src="img/profile_first.jpg" style="width: 300px; height: 300px;">
                <?php elseif($related_friend['user_img'] == '') : ?>
                <img src="img/profile_first.jpg" style="width: 300px; height: 300px;">
                <?php else : ?>
                <img src="user_img/<?php echo $related_friend['user_img']; ?>" style="width: 300px; height: 300px;">
                <?php endif; ?>
              </div>
              <form method="POST" action="request_friend.php">
                <input type="hidden" name="request_friend_id" value="<?php echo $related_friend['id']?>">
                <input type="submit" name="request_friend" value="友達申請を送る" class="square_btn3" style="float: right; ">
              </form>
            </div>
            <div class="col-xs-6" style="height: 600px; background-color: #37b8e061; margin: 30px 0px;">
              <br>
              <b class=asking>
                友達申請を送り終わりましたら、<br>
                こちらで友達をフォルダに登録しましょう！<br>
                ※友達が承諾した後に、実際にトークができます<br>
              </b>
<!-- 友達検索・フォルダー作成 -->
              <br>
              <form method="POST" action="creat_folder.php">
                <b style="font-size: 20px">フォルダー新規作成</b>
                <input type="text" name="folder_name" class="text">
                <input type="submit" value="新規作成" class="square_btn">
              </form>
              <b style="font-size: 20px">フォルダー選択：</b><br>
              <b style="font-size: 20px">※チェックボックスを選択してから操作してください！</b><br>
<!-- フォルダーの行を作成 -->
              <form action="folder_related_friend.php" method="GET">
                <div class="scrol_box">
                  <?php if(isset($folders)) :?>
                  <?php foreach($folders as $folder_each) :?>
                    <div class="row">
                    <div style="float:left;margin-top: 5; " class="col-md-5">
                    <input type="checkbox" name="check_folder" value="<?php echo $folder_each['id']?>"><?php echo $folder_each['folder_name'] ;?>
                    </div>
                    <?php if($folder_each['id'] != $all_friend_folder['id']) :?>
                      <div class="col-md-7">
                      <button style="float:right;" class="square_btn2"><a onclick="return confirm('フォルダーを削除しますか？');" href="delete_folders.php?folder_id=<?php echo $folder_each['id']; ?>">フォルダーの削除</a></button>
                      </div>
                    <?php else: ?>
                      <div style="float:right;width:178px;height: 37px;" class="col-md-7"></div>
                    <?php endif; ?>
                    </div>
                   <?php endforeach; ?>
                   <?php else :?>
                  <b style="font-size: 20px">フォルダを作成しよう！</b>
                   <?php endif; ?>
                </div>
                <input type="submit" value="友達をフォルダーに登録" class="square_btn3" style="float: right; ">
              </form>
              </div>
      </div>
    </div>

      <!-- 友達一覧 -->
      <div>
        <h1 id="friends_list"><span class="title_2">♦︎友達一覧♦︎</span></h1>
        <div class="row">
          <div class="col-xs-6" style="height: 450px; background-color: #37b8e061; margin:30px 0px;">
            <br>
            <b style="font-size: 20px">♦︎フォルダー♦︎</b><br>
            <br>
            <?php if(isset($folders)) :?>
            <?php foreach($folders as $folder_each) :?>
              <form method="GET" action="" style="float: left">
                <input type="submit" name="folder" class="friends_folder" data-toggle="modal" data-target="#demoNormalModal" value="<?php echo $folder_each['folder_name']?>">
                <input type="hidden" name="folder_id" value="<?php echo $folder_each['id']?>">
              </form>
            <?php endforeach; ?>
            <?php else :?>
              <b style="font-size: 20px">フォルダを作成しよう！</b>
            <?php endif; ?>
              <form method="POST" action="delete_all_folder.php">
                <input type="submit" name="delete_all_folder" class="square_btn3" onclick="return confirm('フォルダーを全件削除しますか？');"style="float: right;" value="フォルダーの全件削除">
              </form>
          </div>
        <div class="col-xs-6" style="height: 450px; background-color: #37b8e061; margin: 30px 0px;">
        <div>
          <br>
          <b style="font-size: 20px">友達一覧：</b>
          <br>
    <div class="scrol_box2">
      <?php if (isset($_GET['folder_id'])): ?>
        <?php foreach($friends as $friend_each): ?>
          <?php if($friend_each['folder_id']== $_GET['folder_id']): ?>
            <?php if($_GET['folder_id'] == $all_friend_folder['id']) :?>
              <div class="row">
                <div style="float:left;margin-top: 5; " class="col-md-5">
                  <b><?php echo $friend_each['user_name'] ?></b>
                </div>
                <div style="float:right;" class="col-md-7">
                  <?php include("delete_friend_modal.php"); ?>
                </div>
              </div>
            <?php else: ?>
              <div class="row">
                <div style="float:left;margin-top: 5; " class="col-md-4">
                  <b><?php echo $friend_each['user_name'] ?></b>
                </div>
                <div class="col-md-8">
                  <form method="POST" action="omit_friend.php">
                    <input type="submit" name="delete_folder_friend" class="square_btn2" value="フォルダから外す" style="float:left;">
                    <input type="hidden" name="omit_folder_id" value="<?php echo $friend_each['folder_id'] ?>">
                    <input type="hidden" name="omit_friend_id"value="<?php echo $friend_each['friend_id'] ?>">
                  </form>
                  <?php include("delete_friend_modal.php"); ?>
                </div>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        <?php endforeach; ?>
        <?php if($_GET['folder_id'] != $all_friend_folder['id']) :?>
          <button class="delet_button2" >中身を<br>空にする</button>
        <?php endif; ?>
      <?php endif ;?>
    </div>

        </div>
        </div>
        </div>
      </div>
    </div>
  </div><!-- class="container" -->
</div><!-- class="img background2" -->

  <div class="row">
    <div class="col-xs-12" style="background-color:black; height:50px;" >
    </div>
  </div>

    <div class="col-xs-12" style="background-color: white; ">
       <h1 id="help"><span class="title_1">♦Help 使い方ガイド♦</span></h1>
       <img class="help" src="img/howtoalbum.jpeg"><br><br>
       <img class="help" src="img/howtotalk.jpeg"><br><br>
       <img class="help" src="img/howtofakepage.jpeg"><br><br>
       <img class="help" src="img/howtosetting.jpeg"><br><br>
    </div>

<div class="row">
    <div class="col-xs-12" style="background-color:black; height:50px;" >
    </div>
  </div>

<div class="col-xs-12" style="background-color: white;">
      <h1 id="qanda"><span class="title_1">♦Ｑ＆Ａ♦</span></h1>
      <img class="help" src="img/qanda.jpeg">
    </div>


<div class="row">
    <div class="col-xs-12" style="background-color:black; height:50px;" >
    </div>
  </div>





<!-- フッター -->
  <div class="row">
    <div class="col-xs-12" style="background-color: #003366; height:50px">
      <p  class="footer">Designed by Cherry</p>
    </div>
  </div>
<!-- フッター終わり -->

<!-- jQuery、Popper.js、Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>