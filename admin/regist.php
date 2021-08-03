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
	<title>ZSCTF - 快速注册</title>
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

try {
    
    if(isset($_POST['submit'])) {
        
        $id = $_POST["id"];
        
        if (strlen($id) == 11) { // 注册管理员
        
            // 查询是否已经注册过
            require_once("../require/person2.php");
            
            $check_person_admin = person_admin_check($id);
            
            if ($check_person_admin == 0) {
            
                // 密码相关
                $pwd = $_POST['pwd'];
                $encode_pwd = password_hash($pwd, PASSWORD_DEFAULT);
                
                // sql 处理
                $regist_admin_sql = "INSERT INTO zsctf_admin(uid, pwd) VALUES (?, ?)";
                $regist_admin_res = $pdo -> prepare($regist_admin_sql);
                $regist_admin_res -> execute(array($id, $encode_pwd));
                
                echo "<script>alert('管理员注册成功！');</script>";
                
            } else {
                
                echo "<script>alert('该管理员已经注册过，请不要重复注册！');</script>";
                
            }
            
        } else { // 注册成员
            
            // 名字
            $name = $_POST['name'];
            
            // 查询是否已经注册过
            require_once("../require/person.php");
            
            $check_person = personcheck($name, $id);
            
            if ($check_person == 0) {
            
                // 密码相关
                $pwd = $_POST['pwd'];
                $encode_pwd = password_hash($pwd, PASSWORD_DEFAULT);
                
                // sql 处理
                $regist_member_sql = "INSERT INTO zsctf_member(name, id, password) VALUES (?, ?, ?)";
                $regist_member_res = $pdo -> prepare($regist_member_sql);
                $regist_member_res -> execute(array($name, $id, $encode_pwd));
                
                echo "<script>alert('成员注册成功！');</script>";
            
            } else {
                
                echo "<script>alert('该成员已经注册过，请不要重复注册！');</script>";
                
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

// 检查名字
echo ("
	<script type=\"text/javascript\">
	function checkname()
    {
        if (subform.id.value.length!=11)
        {
            if(subform.name.value==\"\")
            {
                alert(\"姓名输入为空，请输入姓名！\");
                return false;
            }
            if(subform.name.value.length>=5 || subform.name.value.length<=1)
            {
                alert(\"姓名长度不合法，请检查后重试！\");
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            if(subform.name.value!=\"\")
            {
                alert(\"目前尚未开发管理员实名化，名字填写提交后也会忽略。\");
                return true;
            }
            else
            {
                return true;
            }
        }
    }
");

// 检查学号或者手机号
echo ("
    function checkid()
    {
        if(subform.id.value==\"\")
        {
            alert(\"学号输入为空，请输入学号！\");
            return false;
        }
        else
        {
            return true;
        }
    }
");

// 检查密码
echo ("
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
        
        <br><div class=\"mdui-typo\" style=\"font-size:28px;font-weight:500;text-align:center\">快速注册</div>
        <div class=\"mdui-typo\" style=\"font-size:12px;font-weight:300;text-align:center\">
        <a href=\"./index.php\"> &nbsp;&nbsp;返回首页&nbsp;&nbsp; </a>
        <a href=\"./adminlist.php\"> &nbsp;&nbsp;查看管理员&nbsp;&nbsp; </a>
        <a href=\"./memberlist.php\"> &nbsp;&nbsp;查看成员&nbsp;&nbsp; </a>
        </div>
");

echo ("
    <form action=\"./regist.php\" method=\"post\" name=\"subform\" onsubmit=\"return checkname() && checkid() && checkpwd()\">
        <div class=\"mdui-textfield mdui-textfield-floating-label\">
            <label class=\"mdui-textfield-label\">姓名（管理员账户可不填）</label>
            <input class=\"mdui-textfield-input\" type=\"text\" name=\"name\" />
    	</div>
    	
    	<div class=\"mdui-textfield mdui-textfield-floating-label\">
            <label class=\"mdui-textfield-label\">学号（管理员账户填手机号）</label>
            <input class=\"mdui-textfield-input\" type=\"text\" name=\"id\" />
    	</div>
    	
    	<div class=\"mdui-textfield mdui-textfield-floating-label\">
            <label class=\"mdui-textfield-label\">密码（不填则为默认 12345678 ）</label>
            <input class=\"mdui-textfield-input\" type=\"text\" name=\"pwd\" />
    	</div>
");

echo ("
    <br><br>
        	<center>
        	    <button class=\"mdui-color-pink-a200 mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent\" type=\"submit\" name=\"submit\">提交注册</button>
        	</center>
        </form>
");

$pdo = null;

?>