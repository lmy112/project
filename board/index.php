<?php
// 啟用 session
session_start();

// 連接數據庫
require_once 'conn.php';

// 判斷是否登入
$is_login = false;
if (isset($_SESSION["account"]) && !empty($_SESSION["account"])) {
    $is_login = true;
    $account = $_SESSION['account'];
}
// 使用者暱稱
$user = $conn->prepare("SELECT nickname FROM lmybs112_users WHERE account = ?");
$user->bind_param('s', $_SESSION['account']);
$user->execute();
$nickname = $user->get_result()->fetch_assoc()['nickname'];

// 分頁
$page = empty($_GET['page']) ? 1 : (int) $_GET['page'];
$page_size = 10;
$offset = ($page - 1) * $page_size;

// 查詢數據 分頁
$stmt = $conn->prepare("SELECT lmybs112_comments.id,lmybs112_comments.message,lmybs112_comments.create_at,lmybs112_users.nickname FROM lmybs112_comments left join lmybs112_users on lmybs112_comments.user_id=lmybs112_users.account WHERE parent_id=? order by create_at DESC LIMIT ?,?");

$parent_id = 0;
$stmt->bind_param('iii', $parent_id, $offset, $page_size);
$stmt->execute();
$query = $stmt->get_result();
if (!$query) {
    exit("查詢數據失敗");
}

// 查詢數據 主留言總數
$count = $conn->prepare("SELECT lmybs112_comments.id FROM lmybs112_comments WHERE parent_id=?");
$count->bind_param('i', $parent_id);
$count->execute();
$count_pages = $count->get_result();
if (!$count_pages) {
    exit("查詢數據失敗");
}

// 計算頁碼
$total = $count_pages->num_rows;
$end = ceil($total / 10);
$begin = 1;

// 查詢可編輯數據
if (!empty($_GET['id'])) {
    $edit = $conn->prepare("SELECT * FROM lmybs112_comments WHERE id =?");
    $edit->bind_param('i', $_GET['id']);
    $edit->execute();
    $edit_res = $edit->get_result();
    if (!$edit_res) {
        exit("查詢數據失敗");
    }
} else {
// 查詢可刪除數據
    $del = $conn->prepare("SELECT * FROM lmybs112_comments WHERE user_id =?");
    $del->bind_param('i', $account);
    $del->execute();
    $de_result = $del->get_result();
    if (!$de_result) {
        exit("查詢數據失敗");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
    crossorigin="anonymous">
  <!-- bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
  <link rel="stylesheet" href="css/main.css">
  <title>SHARE YOUR STORY</title>
</head>
<body>
    <!-- 留言板-導覽列 -->
  <?php include '/board/components/navbar.php'?>
  <!-- 留言板 -->
  <div class="container">
    <!-- 判斷要新增留言 or 修改留言 -->
    <?php if (isset($edit_res)): ?>
    <!-- 留言板-留言內容-我要修改 -->
    <?php include '/board/components/editMessage.php'?>
    <?php else: ?>
    <!-- 留言板-留言內容-我要留言 -->
    <?php include '/board/components/sendMessage.php'?>

    <!-- 輸出下方留言 -->
  <div class="showMessage">
    <?php while ($item = $query->fetch_assoc()): ?>
    <div class="board board-res">
      <div class="content content-child">
        <div class="aside">
          <span>▲</span>
          <span>0</span>
        </div>
        <div class="main main-res">
          <div class="content_info info-child">
            <h3 class="name">
              <?php echo $item['nickname'] ?>
            </h3>
            <h3 class="date ml-auto">
              <?php echo $item['create_at'] ?>
            </h3>
          </div>
          <div class="show">
            <?php echo htmlspecialchars($item['message']) ?>
            <!-- 判斷是否顯示編輯＆刪除功能 -->
            <?php if ($is_login): ?>
            <?php foreach ($de_result as $com): ?>
            <?php if ($com['id'] == $item['id'] && $com['user_id'] == $account): ?>

            <div class="modify">
              <a href="index.php?id=<?php echo $item['id'] ?>"><i class="fas fa-pencil-alt"></i></a>
              <a href="delete.php?id=<?php echo $item['id'] ?>" data-id="<?php echo $item['id'] ?>" class="delete__mes">Delete</a>
            </div>

            <?php endif?>
            <?php endforeach?>
            <?php endif?>
          </div>

          <?php // 查詢子留言數據
$child = $conn->prepare("SELECT lmybs112_comments.id,lmybs112_comments.message,lmybs112_comments.create_at,lmybs112_users.nickname FROM lmybs112_comments left join lmybs112_users on lmybs112_comments.user_id=lmybs112_users.account WHERE parent_id=? order by create_at ASC;");

$parent_id = $item['id'];
$child->bind_param('i', $parent_id);
$child->execute();
$query_child = $child->get_result();
if (!$query_child) {
    exit("查詢數據失敗");
}?>

          <div class="content_message message-child">
            <div class="content content-child content-child-mes">

              <!-- 顯示子留言 -->
              <?php while ($item_child = $query_child->fetch_assoc()): ?>
              <div class="main main-child">
                <div class="content_info info-child line">
                  <h3 class="name">
                    <?php echo $item_child['nickname'] ?>
                  </h3>
                  <h3 class="date">
                    <?php echo $item_child['create_at'] ?>
                  </h3>
                </div>
                <!-- 刪除＆編輯功能 -->
                <?php if ($is_login): ?>
                <?php foreach ($de_result as $com): ?>
                <?php if ($com['id'] == $item_child['id'] && $com['user_id'] == $account): ?>
                <span class="modify">
                  <a href="index.php?id=<?php echo $com['id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                  <a href="delete.php?id=<?php echo $com['id'] ?>"data-id="<?php echo $com['id'] ?>" class="delete__mes delete__mes__response">Delete</a>
                </span>
                <?php if ($item['nickname'] == $item_child['nickname']): ?>
                <div class="show_self"></div>
                <?php endif?>
                <?php endif?>
                <?php endforeach?>
                <?php endif?>

                <div class="show">
                  <?php echo htmlspecialchars($item_child['message']) ?>
                </div>

              </div>
              <?php endwhile?>
            </div>

            <!-- 回覆留言 -->
            <form class="main main-child" action="add_message.php" method="post">
              <div class="content_message">
                <textarea name="message" cols="100" rows="5" placeholder="回覆此留言" maxLength="300"></textarea>
              </div>
              <input type="hidden" name="parent_id" value="<?php echo $item['id'] ?>">
              <div class="button">

                <!-- 判斷是否登入 -->
                <?php if ($is_login): ?>
                <button class="send_res">回應</button>
                <?php else: ?>
                <button disabled class="col-12">登入後回應</button>
                <?php endif?>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile?>
  </div>
    <!-- 留言板-返回頂部 -->
    <div>
      <a href="#top"><i class="fas fa-arrow-alt-circle-up"></i></a>
    </div>
    <!-- 分頁 -->
    <?php include '/board/components/page.php'?>
  </div>
  <?php endif?>


  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <!-- bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
    crossorigin="anonymous"></script>
  <!-- index.js -->
<script src="js/deleteMessage.js"></script>
<script src="js/addMessage.js"></script>
</body>

</html>