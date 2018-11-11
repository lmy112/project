<?php
// 啟用 session
session_start();

$err_msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 驗證非空
    if (empty($_POST['nickname']) && empty($_POST['account']) && empty($_POST['password'])) {
        $err_msg = '請輸入以下資料';
    } elseif (empty($_POST['nickname']) && empty($_POST['account'])) {
        $err_msg = '請輸入暱稱及帳號';
    } elseif (empty($_POST['nickname']) && empty($_POST['password'])) {
        $err_msg = '請輸入暱稱及密碼';
    } elseif (empty($_POST['account']) && empty($_POST['password'])) {
        $err_msg = '請輸入帳號及密碼';
    } else {
        $err_msg = '請輸入';
        if (empty($_POST['nickname'])) {
            $err_msg .= '暱稱';
        }
        if (empty($_POST['account'])) {
            $err_msg .= '帳號';
        }
        if (empty($_POST['password'])) {
            $err_msg .= '密碼';
        }
    }

    if (!empty($_POST['nickname']) && !empty($_POST['account']) && !empty($_POST['password'])) {
        // 取值
        $nickname = $_POST['nickname'];
        $account = $_POST['account'];
        $password = $_POST['password'];
        $is_login = false;

        // 密碼加密
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // 連接數據庫
        require_once 'conn.php';

        // 判斷是否註冊過
        $check_acc = $conn->prepare("SELECT * FROM lmybs112_users WHERE account=?");
        $check_acc->bind_param("s", $account);
        $check_acc->execute();
        $res_acc = $check_acc->get_result();
        if (!$res_acc) {
            exit('查詢數據失敗');
        }
        $row = $res_acc->fetch_assoc();
        if ($row > 1) {
            $err_msg = '註冊失敗，此帳號已存在!';
        } else {
            // 增加數據
            $join = $conn->prepare("INSERT INTO lmybs112_users(id, nickname, account, password) VALUES (?,?,?,?)");
            $id = null;
            $join->bind_param('ssss', $id, $nickname, $account, $hash);
            $join->execute();

            if (!$join) {
                exit('增加數據失敗');
            } else {
                // 註冊成功後自動登入
                $last_id = $conn->insert_id;
                $_SESSION["account"] = $account;
                $is_login = true;

                setcookie('login', $is_login, time() + 1 * 24 * 60 * 60);
                // 響應頁面
                header('location: index.php');
            }
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
        <nav class=nav>
            <a href="index.php">
                <h1 class="logo">SHARE YOUR STORY</h1>
            </a>
            <div class="btn ml-auto">
                <a href="index.php" class="index"><button>回首頁</button></a>
                <a href="login.php" class="login"><button>登入</button></a>
            </div>
        </nav>
        <main class="member">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="join-form" class="form" autocomplete="off">
                <h2 class="form-title">註冊成為會員</h2>

                <!-- 提示錯誤訊息 -->
                <?php if (!empty($err_msg)): ?>
                <div class="alert">
                    <?php echo $err_msg; ?>
                </div>
                <?php endif?>

                <div class="form-group">
                    <label for="nickname">暱稱：</label>
                    <input type="text" id="nickname" name="nickname" placeholder="請輸入暱稱" value="<?php echo isset($_POST['nickname']) ? $_POST['nickname'] : '' ?>"
                        maxLength="10" onkeyup="value=value.replace(/[^\w\u4E00-\u9FA5]/g, '')">
                </div>
                <div class="form-group">
                    <label for="account">帳號：</label>
                    <input type="text" id="account" name="account" maxLength="10" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')"
                        placeholder="請輸入帳號" value="<?php echo isset($_POST['account']) ? $_POST['account'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="password">密碼：</label>
                    <input type="password" id="password" name="password" placeholder="請輸入密碼" maxLength="20" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')">
                </div>
                <button class="submit">註冊</button>
                <h4><a href="login.php" class="click_join">已有會員點我登入</a></h4>
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