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
require_once("../require/token.php");

// 生成token
$token = tokenset(16);

try {
    
    // token到sql
    $token_sql = "UPDATE zsctf_token SET token = ?";
    $token_res = $pdo -> prepare($token_sql);
    $token_res -> execute(array($token));
    
    // 刷新token后跳转二维码页面
    echo "<script>alert('Succeed！即将跳转到二维码页面！');location.href='./qrcodeget.php';</script>";
    
} catch (PDOException $e) {
    
    die ("系统出错，请联系管理员！");
    
}

$pdo = null;

?>