<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

// 判断是否已登录
session_start();
$admin = $_SESSION['zsctf_admin_login'];
$user = $_SESSION['zsctf_member_login'];

if (!($admin || $user)) {
    
    echo "<script>alert('您尚未登录，请先登录！');location.href='./login.php';</script>";
    
}

// ui
echo ('
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ZSCTF - 密码重置</title>
');

echo ('
	<link
      rel="stylesheet"
      href="../require/css/mdui.min.css"
      integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
      crossorigin="anonymous"
    />
');

require_once("../config/connect_sql.php");

$rnid = $_GET['rnid'];

// 对参数解密
$decode_id = base64_decode($rnid);

try {
    
    if(isset($_POST['submit'])) {
        
        // 获取修改后的密码并加密
        $password = $_POST['pwd'];
        $encode_password = password_hash($password, PASSWORD_DEFAULT);
        
        if (strlen($decode_id) == 11) { // 对管理员账户下手
        
            // 从数据库里读取数据
            $adminreset_sql = "UPDATE zsctf_admin SET pwd = ?";
            $adminreset_res = $pdo -> prepare($adminreset_sql);
            
            // 执行重置并返回结果
            if ($adminreset_res -> execute(array($encode_password))) {
                
                echo"<script>alert('所选管理员密码已重置！');history.go(-2);</script>";
                
            } else {
                
                echo "所选管理员密码重置失败，请联系管理员！";
                
            }
            
        } else { // 对普通成员账户下手
            
            // 从数据库里读取数据
            $memberreset_sql = "UPDATE zsctf_member SET password = ?";
            $memberreset_res = $pdo -> prepare($memberreset_sql);
            
            // 执行重置并返回结果
            if ($memberreset_res -> execute(array($encode_password))) {
                
                echo"<script>alert('密码重置成功！');history.go(-2);</script>";
                
            } else {
                
                echo "密码重置失败，请联系管理员！";
                
            }
        
        }
        
    }
    
} catch (PDOException $e) {
    
    die ("系统出错，请联系管理员！");
    
}

echo ('
    <script
      src="../require/js/mdui.min.js"
      integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
      crossorigin="anonymous"
    ></script>
');

// 检查密码
echo ("
    <script type=\"text/javascript\">
    function checkpwd()
    {
        if(subform.pwd.value==\"\")
        {
            alert(\"密码输入为空，将为默认 12345678\");
            subform.pwd.value = \"12345678\";
            return true;
        }
        else
        {
            return true;
        }
    }
    </script>
");

echo ("
    <div class=\"mdui-container doc-container\">
        
        <br><div class=\"mdui-typo\" style=\"font-size:28px;font-weight:500;text-align:center\">密码重置</div>
        <div class=\"mdui-typo\" style=\"font-size:12px;font-weight:300;text-align:center\">
        <a href=\"../index.php\"> &nbsp;&nbsp;返回首页&nbsp;&nbsp; </a>
        </div>
");

echo ("
    <form action=\"./reset.php\" method=\"post\" name=\"subform\" onsubmit=\"return checkpwd()\">
    	
    	<div class=\"mdui-textfield mdui-textfield-floating-label\">
            <label class=\"mdui-textfield-label\">新密码（不填则为默认 12345678 ）</label>
            <input class=\"mdui-textfield-input\" type=\"text\" name=\"pwd\" />
    	</div>
");

echo ("
    <br><br>
        	<center>
        	    <button class=\"mdui-color-pink-a200 mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent\" type=\"submit\" name=\"submit\">提交新密码</button>
        	</center>
        </form>
");

$pdo = null;

?>