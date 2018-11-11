<?php
// 啟用 session
session_start();

$err_msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 驗證非空
    if (empty($_POST['account']) && empty($_POST['password'])) {
        $err_msg = '請輸入帳號及密碼';
    } else {
        $err_msg = '請輸入';
        if (empty($_POST['account'])) {
            $err_msg .= '帳號';
        }
        if (empty($_POST['password'])) {
            $err_msg .= '密碼';
        }
    }

    // 取值
    if (!empty($_POST['account']) && !empty($_POST['password'])) {
        $account = $_POST['account'];
        $password = $_POST['password'];
        $is_login = false;

        // 連接數據庫
        require_once 'conn.php';

        // 查詢數據
        $login = $conn->prepare("SELECT * FROM lmybs112_users WHERE account=?");
        $login->bind_param("s", $account);
        $login->execute();
        $result = $login->get_result();
        if (!$result) {
            exit('查詢數據失敗');
        }
        $row = $result->fetch_assoc();
        if ($row > 0 && password_verify($password, $row['password'])) {
            // 儲存登入狀態
            $is_login = true;
            $_SESSION['account'] = $account;
            setcookie('login', $is_login, time() + 1 * 24 * 60 * 60);
            // 響應頁面
            header('location: index.php');
        } else {
            $err_msg = '登入失敗，請重新登入或註冊會員!';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
  <link rel="stylesheet" href="css/common.css">
  <title>SHARE YOUR STORY</title>
</head>

<body>
  <div class="container">
    <nav class="nav">
      <a href="index.php"><h1 class="logo">SHARE YOUR STORY</h1></a>
      <div class="btn ml-auto">
        <a href="index.php" class="index"><button>回首頁</button></a>
        <a href="join.php" class="login"><button>註冊</button></a>
      </div>
    </nav>
    <main class="member">
    <form action="" method="post" id="login-form"class="form">
      <h2 class="form-title">登入會員</h2>

      <!-- 提示錯誤訊息 -->
      <?php if (!empty($err_msg)): ?>
        <div class="alert">
        <?php echo $err_msg; ?>
        </div>
        <?php endif?>

      <div class="form-group">
        <label for="account">帳號：</label>
        <input type="text" id="account" name="account"placeholder="請輸入帳號"
        value="<?php echo isset($_POST['account']) ? $_POST['account'] : '' ?>" maxLength="10" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')">
      </div>
      <div class="form-group">
        <label for="password">密碼：</label>
        <input type="password" id="password" name="password"placeholder="請輸入密碼"  maxLength="20" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')">
      </div>
      <button class="submit">登入</button>
      <h4><a href="join.php" class="click_join">還不是會員嗎？<strong>點我註冊</strong></a></h4>
    </form>
    </main>
  </div>
  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <!-- bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
    crossorigin="anonymous"></script>
</body>

</html>