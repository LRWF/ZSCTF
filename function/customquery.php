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

// 接收数据
$date_start = $_POST['date_start'];
$date_end = $_POST['date_end'];

// 防止手误或者捣乱
if ($date_start > $date_end) {
    
    $date_temp = $date_start;
    $date_start = $date_end;
    $date_end = $date_temp;
    
}

// ui
echo ('
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ZSCTF - 自定义日期段查询</title>
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
    
    // 从数据库里读取数据，列出成员名单
    $memberlist_sql = "SELECT name, id FROM zsctf_member";
    $memberlist_res = $pdo -> prepare($memberlist_sql);
    $memberlist_res -> execute();
    
    // ui
    echo ('
        <script
          src="../require/js/mdui.min.js"
          integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
          crossorigin="anonymous"
        ></script>
    ');

    echo ('
        <br><div class="mdui-typo" style="font-size:28px;font-weight:500;text-align:center">自定义日期段查询</div>
        <div class="mdui-typo" style="font-size:12px;font-weight:300;text-align:center">
        <a href="../admin/index.php"> &nbsp;&nbsp;返回首页&nbsp;&nbsp; </a>
        <a href="../admin/dailylist.php"> &nbsp;&nbsp;查看今日&nbsp;&nbsp; </a>
        <a href="../admin/signedlist.php"> &nbsp;&nbsp;查看详细&nbsp;&nbsp; </a>
        </div><br>
    ');

    echo ('
        <div class="mdui-table-fluid"><table class="mdui-table mdui-table-hoverable">
            <thead>
                <tr>
                    <th>姓名</th>
                    <th>学号</th>
                    <th class="mdui-table-col-numeric">签到次数</th>
                </tr>
            </thead>
    ');
    
    // 加载统计
    require_once("../require/custcount.php");
    
    // 列出数据
    while ($rst = $memberlist_res->fetch(PDO::FETCH_ASSOC)) {
        
        // 计算签到次数
        $count = getcustcount($rst['id'], $date_start, $date_end);
        
        echo "<td>{$rst['name']}</td>".
             "<td>{$rst['id']}</td>".
             "<td>{$count}</td>".
             "</tr>";
             
    }
    
} catch (PDOException $e) {
    
    die ("系统出错，请联系管理员！");
    
}

$pdo = null;

?>