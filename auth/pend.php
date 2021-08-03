<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

require_once '../config/connect_sql.php';

// 初始化session
session_start();
$_SESSION["zsctf_member_login"] = null;
$_SESSION["zsctf_admin_login"] = null;

// 处理login表单传过来的数据
$user = isset($_POST['user']) ? trim($_POST['user']) : '';
$password = isset($_POST['password']) ? ($_POST['password']) : '';

// 查询数据库的账户信息
$member_sql = "select password from zsctf_member where id = ?";
$admin_sql = "select pwd from zsctf_admin where uid = ?";

// 预处理
$member_res = $pdo -> prepare($member_sql);
$admin_res = $pdo -> prepare($admin_sql);

try {
    
    if(!empty($_POST)) {
        
        if (strlen($user) == 11) { // 判断是否为管理员
        
            $admin_res -> execute(array($user)); // 传递表单的值
            $rst = $admin_res->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($password, $rst['pwd'])) { // 校验密码
            
                $_SESSION['zsctf_admin_login'] = $user;
                $_SESSION['zsctf_member_login'] = $user; // 管理员同时登录普通用户
                echo "<script>alert('管理员您好，您已登录成功！');location.href='../admin/index.php';</script>";
                
            } else {
                
                echo "<script>alert('登录失败！');location.href='./login.php';</script>";
                
            }
            
        } else { // 普通成员登录
            
            $member_res -> execute(array($user)); // 传递表单的值
            $rst = $member_res->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($password, $rst['password'])) { // 校验密码
            
                $_SESSION['zsctf_member_login'] = $user;
                echo "<script>alert('CTFer您好，您已登录成功！');location.href='../member/index.php';</script>";
                
            } else {
                
                echo "<script>alert('登录失败！');location.href='./login.php';</script>";
                
            }
            
        }
        
    }
    
} catch (PDOException $e) {
    
    die ("系统出错，请联系管理员！");
    
}

$pdo = null;

?>