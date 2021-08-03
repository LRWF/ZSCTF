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
	<title>ZSCTF - 成员中心</title>
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

// 统计签到次数
require_once("../require/count.php");
$rowcount = countget($user);

// 对 id 进行加密
$encode_id = base64_encode($user);

echo ('
    <br>
    <div class="mdui-typo" style="font-size:28px;font-weight:500;text-align:center">Hello，'.$user.'</div>
    <div class="mdui-typo" style="font-size:14px;font-weight:300;text-align:center">您已成功签到 '.$rowcount.' 次</div>
    <br>
    <div class="mdui-divider"></div><br><br>
    <div class="mdui-typo" style="font-size:20px;font-weight:300;text-align:center">
        <a href="./gosigned.php"> > 签到 < </a><br>
        <br>
        <a href="../leave/index.php"> > 请假登记 < </a><br>
        <br>
        <a href="../auth/reset.php?rnid='.$encode_id.'"> > 修改密码 < </a><br>
        <br>
        <a href="../auth/logout.php"> > 安全注销登录 < </a>
    </div><br>
');

?>