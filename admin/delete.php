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

$rmid = $_GET['rmid'];

// 对参数解密
$decode_id = base64_decode($rmid);

try {
    
    if (strlen($decode_id) == 11) { // 对管理员账户下手
    
        // 从数据库里读取数据
        $admindelete_sql = "DELETE FROM zsctf_admin WHERE uid = ?";
        $admindelete_res = $pdo -> prepare($admindelete_sql);
        
        // 执行删除并返回结果
        if ($admindelete_res -> execute(array($decode_id))) {
            
            echo"<script>alert('已删除该管理员！');history.go(-1);</script>";
            
        } else {
            
            echo "删除失败，请联系管理员！";
            
        }
        
    } else { // 对普通成员账户下手
        
        // 从数据库里读取数据
        $memberdelete_sql = "DELETE FROM zsctf_member WHERE id = ?";
        $memberdelete_res = $pdo -> prepare($memberdelete_sql);
        
        // 执行删除并返回结果
        if ($memberdelete_res -> execute(array($decode_id))) {
            
            echo"<script>alert('已删除该成员！');history.go(-1);</script>";
            
        } else {
            
            echo "删除失败，请联系管理员！";
            
        }
        
    }
    
} catch (PDOException $e) {
    
    die ("系统出错，请联系管理员！");
    
}

$pdo = null;

?>