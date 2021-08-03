<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

// 判断是否已登录
session_start();
$user = $_SESSION['zsctf_admin_login'];

if (!$user) {
    
    echo "<script>alert('您尚未登录管理员账户，请先登录！');location.href='../auth/login.php';</script>";
    
}

// ui
echo ('
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ZSCTF - 管理台</title>
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

$today = date("Ymd");

echo ('
    <br>
    <div class="mdui-typo" style="font-size:28px;font-weight:500;text-align:center">管理员工作台</div>
    <div class="mdui-typo" style="font-size:14px;font-weight:300;text-align:center">'.$user.'</div>
    <br>
    <div class="mdui-divider"></div><br><br>
    <div class="mdui-typo" style="font-size:20px;font-weight:300;text-align:center">
        <a href="./dailylist.php"> > 今日【'.$today.'】签到 < </a><br>
        <a href="./checklist.php"> > 自定义日期段查询签到统计 < </a><br>
        <a href="./signedlist.php"> > 所有签到信息 < </a><br>
        <br>
        <a href="./regist.php"> > 快速注册 < </a><br>
        <a href="./memberlist.php"> > 成员管理 && 累计签到 < </a><br>
        <a href="./adminlist.php"> > 管理员管理 < </a><br>
        <br>
        <a href="../function/qrcodeget.php"> > 获取签到二维码 < </a><br>
        <a href="../function/tokenset.php"> > 刷新token并获取签到二维码 < </a><br>
        <br>
        <a href="../member/index.php"> > 进入普通成员空间 < </a><br>
        <br>
        <a href="../auth/logout.php"> > 安全注销登录 < </a>
    </div><br>
');

?>