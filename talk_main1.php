<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トーク／メイン</title>

    <link type="text/css" rel="stylesheet" href="bmesse.css" />

    <link rel="stylesheet" type="text/css"  href="css/header.css">
    <link rel="stylesheet" type="text/css"  href="header_only.css">

    

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
        <a href="#">Setting</a>
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
    <div id="sub_container" class="col-xs-3" style="background-color:white; height:690px">
        <img src="images/icon_camera.jpeg"><br><br>
        <img src="images/icon_apple.jpeg"><br><br>
        <img src="images/icon_ninja.jpeg"><br><br>
        <img src="images/icon_hotspring.jpeg"><br><br>
    </div>
    <div id="container" class="col-xs-3" style="background-color:#fbdac8; height:690px">
        <div class="box8"><p>フォルダ</p></div>
        <div class="box13"><p>ママ友</p></div>
        <div class="box12"><p>フォルダ１</p></div>
        <div class="box12"><p>フォルダ２</p></div>
        <div class="box12"><p>フォルダ３</p></div>
    </div>
    <div id="container" class="col-xs-3" style="background-color:#fffacd; height:690px">
        <div class="box8"><p>友達</p></div>
        <div class="box16"><p>YU</p></div>
        <div class="box15"><p>KATSUE</p></div>
        <div class="box15"><p>ETSUKO</p></div>
    </div>
    <div id="your_container">
        <!-- チャットの外側部分① -->
        <div id="bms_messages_container">
            <!-- ヘッダー部分② -->
            <div id="bms_chat_header">
                <!--ステータス-->
                <div id="bms_chat_user_status">
                    <!--ステータスアイコン-->
                    <div id="bms_status_icon">●</div>
                    <!--ユーザー名-->
                    <div id="bms_chat_user_name">ユーザー</div>
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
                <div class="bms_message bms_right">
                    <div class="bms_message_box">
                        <div class="bms_message_content">
                            <div class="bms_message_text">うん、まあまあいけとるな</div>
                        </div>
                    </div>
                </div>
                <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->
            </div>

            <!-- テキストボックス、送信ボタン④ -->
            <div id="bms_send">
                <textarea id="bms_send_message"></textarea>
                <div id="bms_send_btn">送信</div>
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