<!-- 友達削除ボタンには警告を表示 -->
          <button type="button" class="square_btn2" data-toggle="modal" data-target="#demoNormalModal" style="float: right;">友達削除</button>
          <!-- モーダルダイアログ -->
          <div class="modal fade" id="demoNormalModal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="demoModalTitle">友達削除</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  友達削除すると、その友達とのトーク履歴が消え、相手からのメッセージを受信することができなくなります。<br>
                  削除した後にメッセージを送るためには再度リクエストを送信する必要があります。
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                  <form method="POST" action="delete_friend.php">
                  <input type="hidden" name="delete_friend_id" value="<?php echo $friend_each['friend_id'] ?>">
                  <input type="submit" name="delete_friend" class="btn btn-primary" value="友達を削除する"><br>
                  </form>
                </div>
              </div>
            </div>
          </div>