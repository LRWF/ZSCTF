<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

?>

<!doctype html>
<html>

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <title>ZSCTF - 登录</title>
    
    <link
      rel="stylesheet"
      href="../require/css/mdui.min.css"
      integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
      crossorigin="anonymous"
    />
    
</head>

<body>
    
<div class="mdui-container doc-container">
    <br>
    <div class="mdui-typo" style="font-size:28px;font-weight:500;text-align:center">用户登录</div>
    <form action="./pend.php" method="post">
        <div class="mdui-textfield mdui-textfield-floating-label">
          <label class="mdui-textfield-label">学号（管理员用手机号登录）</label>
          <input class="mdui-textfield-input" type="text" name="user"/>
        </div>
    <div class="mdui-textfield mdui-textfield-floating-label">
      <label class="mdui-textfield-label">密码</label>
      <input class="mdui-textfield-input" type="password" name="password"/>
    </div>
    <br><br>
    <center><button class="mdui-color-pink-a200 mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" type="submit">确认登录</button></center>
    </form>
    
    <div class="clear"></div>
    
</div>
    <script
      src="../require/js/mdui.min.js"
      integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
      crossorigin="anonymous"
    ></script>

</body>

</html>