    <div class="board">
    <!-- 判斷是否登入 -->
      <?php if ($is_login): ?>
      <h3 id="nickname"><?php echo $nickname ?><i class="fas fa-bullhorn"></i></h3>
      <?php else: ?>
      <h3 class="title">我要留言<i class="fas fa-microphone-alt"></i></h3>
      <?php endif?>
      <form action="add_message.php" class="content" id="main_mes" method="post">
        <div class="content_message">
          <textarea name="message" id="sendMessage" cols="100" rows="10" placeholder="請輸入留言內容" maxLength="500"></textarea>
        </div>
        <input type="hidden" name="parent_id" value="0">
        <div class="button">

          <!-- 判斷是否登入 -->
          <?php if ($is_login): ?>
          <button class="btn send">留言</button>
          <?php else: ?>
          <button disabled>登入後留言</button>
          <?php endif?>
        </div>
      </form>
    </div>