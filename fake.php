<?php
    $num1 = "";
    $num2 = "";

    if (!empty($_POST)) {
      $num1 = $_POST["number_a"];
      $num2 = $_POST["number_b"];
    }

    function calcs($num1, $num2){
    $result = 10000 * $num2 / $num1 / $num1;
    return $result;
    }


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>体重管理</title>
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Invest Register Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->
    <!-- Index-Page-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <!-- //Custom-Stylesheet-Links -->
    <!--fonts -->
  <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
  <!-- //fonts -->
    <!-- Font-Awesome-File -->
    <link rel="stylesheet" href="css/fontawesome-all.css" type="text/css" media="all">
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+1p|M+PLUS+Rounded+1c" rel="stylesheet">

    <!-- viewport meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
  <h1 class="title-agile text-center">BMI計算</h1>
    <div class="content-w3ls">
        <div class="agileits-grid">
            <div class="content-top-agile">
                <br><h2>あなたの身長と体重を<br>入力してください</h2>
            </div>
            <div class="content-bottom">
                <form action="" method="post">
        <i class="fas fa-weight my-example"></i>
                    <div class="field_w3ls">
                        <div class="field-group">
                            <input name="number_a" type="number" step="0.01" value="<?= $num1 ?>" placeholder="身長（cm）" required>
                        </div>
                        <div class="field-group">
                            <input name="number_b" type="number" step="0.01" value="<?= $num2 ?>" placeholder="体重（kg）" required>
                        </div>
                    </div>
                    <div class="wthree-field">
                        <input id="saveForm" name="saveForm" type="submit" value="計算する" />
                    </div>
                    <?php
                    if (!empty($_POST)) {
                        if ($num1 == "" || $num2 == "") {
                            echo '<br>';
                            echo '空欄に数字を入力してください。';
                        }else{
                            echo '<br>';
                            echo "あなたのBMIは、、、";
                            echo calcs($num1, $num2);
                            echo "です。";
                        }
                    }
                    ?>
                    <?php
                    if (!empty($_POST)) {
                        if (calcs($num1, $num2) < 18.5) {
                            echo '<br>';
                            echo "BMIが18.5未満のあなたは痩せすぎです。";
                            echo '<br>';
                            echo "もっとたくさん食べて太りましょう！";
                        }elseif (18.5 <= calcs($num1, $num2) && calcs($num1, $num2) < 25) {
                            echo '<br>';
                            echo "BMIが18.5〜25未満のあなたは標準です。";
                            echo '<br>';
                            echo "今の体形をキープしましょう！";
                        }elseif (25 <= calcs($num1, $num2) && calcs($num1, $num2) < 30) {
                            echo '<br>';
                            echo "BMIが25〜30未満のあなたは肥満です。";
                            echo '<br>';
                            echo "食べる量を減らしたり、運動したりしてもう少し痩せましょう！";
                        }elseif (30 <= calcs($num1, $num2)) {
                            echo '<br>';
                            echo "BMIが30以上のあなたは高度肥満です。";
                            echo '<br>';
                            echo "これ以上太ると命が危険です。直ちに痩せましょう！";
                        }
                    }
                    ?>
                </form>
            </div>
            <!-- //content bottom -->
        </div>
    </div>
    <div class="copyright text-center">
        <p>© 2018 Invest Register Form. All rights reserved | Design by
            <a href="http://w3layouts.com">W3layouts</a>
        </p>
    </div>
    <!--//copyright-->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- script for show password -->
    <script>
        $(".toggle-password").click(function () {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
    <!-- /script for show password -->

    <div class="col-xs-12" style="background-color:#DDDDDD; height:235px">
        <div class="box5">
        <img src="img/Nexseed3.jpg">
        </div>
        <div class="box5">
        <img src="img/Nexseed3.jpg">
        </div>
        <div class="box5">
        <img src="img/Nexseed3.jpg">
        </div>
    </div><br>

    <!-- ボタン -->
    <div class="button_wrapper">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demoNormalModal">
            ご利用はこちら（ログイン）
        </button>
    </div>

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="demoModalTitle">メールアドレス</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title" id="demoModalTitle">パスワード</h5>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                      <button type="button" class="btn btn-primary">ログイン</button>
                    </div>
                </div>
            </div>
        </div>
    <div class="row">
      <div class="col-xs-12" style="background-color:white; height:50px"></div>
    </div>
        
        <!-- jQuery、Popper.js、Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>