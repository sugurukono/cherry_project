<?php
    // echoのカスタマイズ
    function e($val) {
        // 開発中はエラー探しのために表示。
        // リリース時には非表示。
        if (true) {
            echo $val;
        }
    }

    // var_dumpのカスタマイズ
    function v($val,$var_name) {
        if (true) {
            echo '<pre>';
            echo $var_name . '=';
            var_dump($val);
            echo '</pre>';
        }
    }

    // $hoge = array('hoge', 'fuga');
    // var_dump($hoge); // 普通にvar_dump

    // echo '<pre>';
    // var_dump($hoge); // 普通にpreで囲ってvar_dump
    // echo '</pre>';

    // v($hoge); // v関数


    // htmlspecialcharsのカスタマイズ
    function h($val) {
        return htmlspecialchars($val);
    }

    // echo '<h1>ほげ</h1>'; // 普通に出力した場合
    // echo htmlspecialchars('<h1>ほげ</h1>'); // 普通にhtmlspeacialcharsを使った場合
    // echo h('<h1>ほげ</h1>'); // h関数を使った場合


    function magic($change_massage,$send_date,$rule){

        //$change_massage=$talk_each['massage'];という代入が関数の呼び出しの時起こってる

        // $display_message = $change_massage;

        // $display_message = $rule['magic_comment'];

        $display_message=str_replace($rule['comment'],$rule['magic_comment'],$change_massage);

        // 変更したい発言が何時間後に消える設定か
        if ($rule['change_time']==0){
            return $display_message;
        }
        elseif($rule['change_time']==1) {
            $change_time=date($send_date,strtotime("+1 hour"));
        }
        elseif ($rule['change_time']==2) {
            $change_time=date($send_date,strtotime("+12 hour"));
        }

        elseif ($rule['change_time']==3) {
            $change_time=date($send_date,strtotime("+24 hour"));
        }

        // 過去か未来かを確認するifを作る
        if(!empty($change_time) && $change_time > $send_date){
            return $display_message;
        }
        

    }


?>