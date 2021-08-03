<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

// 获取 token
$token = $_GET['token'];

if (!$token) {
    
    echo "<script>alert('缺少关键参数，请重新扫码访问！');location.href='../index.php';</script>";
    
}

// sql 读取 token
require_once("../config/connect_sql.php");

$token_sql = "SELECT token FROM zsctf_token";
$token_res = $pdo -> prepare($token_sql);
$token_res -> execute();
$rst = $token_res->fetch(PDO::FETCH_ASSOC);

// 对参数解密
$decode_token = base64_decode($token);

// token 比对
if (strcmp($decode_token, $rst['token']) != 0) {
    
    echo "<script>alert('非法访问，请重新扫码访问！');location.href='../index.php';</script>";
    
}

// 检查时间
$get_time = date('H:m:s');

if ($get_time <= '01:30:00' || $get_time >= '23:30:00') {
    
    echo "<script>alert('非签到时间，请在签到时间内扫码签到！');location.href='../index.php';</script>";
    
}

// ui
echo ('
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ZSCTF - 签到</title>
');

echo ('
	<link
      rel="stylesheet"
      href="../require/css/mdui.min.css"
      integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
      crossorigin="anonymous"
    />
');

// 接收数据
$name = $_POST['name'];
$id = $_POST['id'];
$status = '√';
$date = date("Y-m-d");
$note = '-';

try {
    
    if(isset($_POST['submit'])) {
        
        // 判断是否为 zsctf 成员
        require_once("../require/person.php");
        $check_person = personcheck($name, $id);
        
        if ($check_person == 0) {
            
            echo "<script>alert('您不是 ZSCTF 成员！如果您是新成员，请联系管理员！');location.href='../index.php';</script>";
            
        } else {
        
            // 查询 sql 内是否存在数据
            require_once("../require/repeat.php");
            $check_repeat = repeatcheck($status, $id, $date);
            
            if ($check_repeat != 0) {
                
                echo "<script>alert('您今天已成功签到，请不要重复签到！');location.href='../index.php';</script>";
                
            } else {
            
                // 签到写入 sql
                $signed_save_sql = "INSERT INTO zsctf_signed (status, date, name, id, note)
                                VALUES (?, ?, ?, ?, ?)";
                $signed_save_res = $pdo -> prepare($signed_save_sql);
                $signed_save_res -> execute(array($status, $date, $name, $id, $note));
                
                echo "<script>alert('签到成功！');location.href='../index.php';</script>";
                
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
        if(subform.name.value==\"\")
        {
            alert(\"姓名输入为空，请输入姓名！\");
            return false;
        }
        else if(subform.name.value.length>=5 || subform.name.value.length<=1)
        {
            alert(\"姓名长度不合法，请检查后重试！\");
            return false;
        }
        else
        {
            return true;
        }
    }
");

// 检查学号
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
    </script>
");

echo ("
    <div class=\"mdui-container doc-container\">
        
        <br><div class=\"mdui-typo\" style=\"font-size:28px;font-weight:500;text-align:center\">签到</div>
");

echo ("
    <form action=\"./signed.php?token=").htmlspecialchars($token).("\" method=\"post\" name=\"subform\" onsubmit=\"return checkname() && checkid()\">
        <div class=\"mdui-textfield mdui-textfield-floating-label\">
            <label class=\"mdui-textfield-label\">姓名</label>
            <input class=\"mdui-textfield-input\" type=\"text\" name=\"name\" />
    	</div>
    	
    	<div class=\"mdui-textfield mdui-textfield-floating-label\">
            <label class=\"mdui-textfield-label\">学号</label>
            <input class=\"mdui-textfield-input\" type=\"text\" name=\"id\" />
    	</div>
");

echo ("
    <br><br>
        	<center>
        	    <button class=\"mdui-color-pink-a200 mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent\" type=\"submit\" name=\"submit\">签到</button>
        	</center>
        </form>
");

$pdo = null;

?>