<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

// 判断是否已登录
session_start();
$user = $_SESSION['zsctf_member_login'];

if (!$user) {
    
    echo "<script>alert('您尚未登录成员账户，请先登录！');location.href='../auth/login.php';</script>";
    
}

// ui
echo ('
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ZSCTF - 请假登记</title>
');

echo ('
	<link
      rel="stylesheet"
      href="../require/css/mdui.min.css"
      integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
      crossorigin="anonymous"
    />
');

echo ('
    <script
      src="../require/js/mdui.min.js"
      integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
      crossorigin="anonymous"
    ></script>
');

echo ('
    <div class="mdui-container doc-container">
    
        <br><div class="mdui-typo" style="font-size:28px;font-weight:500;text-align:center">请假登记</div>
');

echo ('
    <form action="./func.php" method="post" name="subform" onsubmit="return checkdate()">
    	
    	<div class="mdui-textfield mdui-textfield-floating-label">
          <label class="mdui-textfield-label">请假原因</label>
          <textarea class="mdui-textfield-input" maxlength="50" name="desp"></textarea>
        </div>
');

echo ('
    <br><br>
        	<center>
        	    <button class="mdui-color-pink-a200 mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" type="submit">提交</button>
        	</center>
        </form>
');

?>