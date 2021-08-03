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

require_once("../config/connect_sql.php");

try {
    
    // 从数据库里读取token
    $qrcode_sql = "SELECT token FROM zsctf_token";
    $qrcode_res = $pdo -> prepare($qrcode_sql);
    $qrcode_res -> execute();
    $rst = $qrcode_res->fetch(PDO::FETCH_ASSOC);
    
    // 加密 token
    $encode_token = base64_encode($rst['token']);
    
    // 生成二维码
    require_once("../require/qrcode.php");
    Header("Content-type: image/png");
    ImagePng(QRcode::png("http://sign.zsctf.lechnolocy.cn/member/signed.php?token=".$encode_token, false, 'H', 20));
    
} catch (PDOException $e) {
    
    die ("系统出错，请联系管理员！");
    
}

$pdo = null;

?>