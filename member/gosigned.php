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

echo "<script>alert('请打开手机浏览器、QQ、微信、支付宝等具有扫码访问网址功能的工具扫描管理员提供的二维码签到！');location.href='./index.php';</script>";

?>