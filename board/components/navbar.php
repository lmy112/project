<nav class="navbar navbar-expand-lg navbar-dark" id="top">
  <a href="index.php">
    <h1 class="logo"><i class="far fa-comments"></i>SHARE YOUR STORY</h1>
  </a>
  <div class="btn ml-auto d-flex align-items-center">
    <!-- 判斷是否登入 -->
    <?php if (!$is_login): ?>
    <a href="join.php" class="join"><button class="btn">註冊</button></a>
    <a href="login.php" class="login"><button class="btn">登入</button></a>
    <?php else: ?>
    <h6 id="check_cer" class="hidden">
      <?php echo $account ?>
    </h6>
    <h4 class="showNickname">Hi~
      <?php echo $nickname ?>
    </h4>
    <a href="logout.php" class="btn logout pl-2"><button>登出</button></a>
    <?php endif?>
  </div>
</nav>