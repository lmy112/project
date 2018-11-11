<div class="board">
  <h3 class="title">我要修改<i class="fas fa-user-edit"></i></h3>
  <?php while ($ed = $edit_res->fetch_assoc()): ?>
  <form action="edit.php?id=<?php echo $ed['id'] ?>" class="content" method="post">
    <div class="content_message">
      <textarea name="message" id="textarea" cols="100" rows="10" placeholder="請輸入修改內容" maxLength="500"><?php echo $ed['message'] ?></textarea>
    </div>
    <input type="hidden" name="parent_id" value="0">
    <div class="button">
      <button>修改</button>
    </div>
  </form>
  <?php endwhile?>
</div>