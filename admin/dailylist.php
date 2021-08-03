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
	<title>ZSCTF - 今日签到</title>
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
    
    // 从数据库里读取数据
    $dailylist_sql = "SELECT * FROM zsctf_signed WHERE date = curdate()";
    $dailylist_res = $pdo -> prepare($dailylist_sql);
    $dailylist_res -> execute();
    
    // ui
    echo ('
        <script
          src="../require/js/mdui.min.js"
          integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
          crossorigin="anonymous"
        ></script>
    ');

    echo ('
        <br><div class="mdui-typo" style="font-size:28px;font-weight:500;text-align:center">今日签到</div>
        <div class="mdui-typo" style="font-size:12px;font-weight:300;text-align:center">
        <a href="./index.php"> &nbsp;&nbsp;返回首页&nbsp;&nbsp; </a>
        <a href="./checklist.php"> &nbsp;&nbsp;自定义日期段&nbsp;&nbsp; </a>
        <a href="./signedlist.php"> &nbsp;&nbsp;查看详细&nbsp;&nbsp; </a>
        </div><br>
    ');

    echo ('
        <div class="mdui-table-fluid"><table class="mdui-table mdui-table-hoverable">
            <thead>
                <tr>
                    <th>状态</th>
                    <th>日期</th>
                    <th>姓名</th>
                    <th>学号</th>
                    <th>备注</th>
                </tr>
            </thead>
    ');
    
    // 列出数据
    while ($rst = $dailylist_res->fetch(PDO::FETCH_ASSOC)) {
        
        echo "<td>{$rst['status']}</td>".
             "<td>{$rst['date']}</td>".
             "<td>{$rst['name']}</td>".
             "<td>{$rst['id']}</td>".
             "<td>{$rst['note']}</td>".
             "</tr>";
             
    }
    
} catch (PDOException $e) {
    
    die ("系统出错，请联系管理员！");
    
}

$pdo = null;

?>