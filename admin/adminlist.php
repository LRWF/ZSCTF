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
	<title>ZSCTF - 管理员列表</title>
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
    $adminlist_sql = "SELECT uid FROM zsctf_admin";
    $adminlist_res = $pdo -> prepare($adminlist_sql);
    $adminlist_res -> execute();
    
    // ui
    echo ('
        <script
          src="../require/js/mdui.min.js"
          integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
          crossorigin="anonymous"
        ></script>
    ');

    echo ('
        <br><div class="mdui-typo" style="font-size:28px;font-weight:500;text-align:center">管理员列表</div>
        <div class="mdui-typo" style="font-size:12px;font-weight:300;text-align:center">
        <a href="./index.php"> &nbsp;&nbsp;返回首页&nbsp;&nbsp; </a>
        <a href="./regist.php"> &nbsp;&nbsp;新增管理&nbsp;&nbsp; </a>
        </div><br>
    ');

    echo ('
        <div class="mdui-table-fluid"><table class="mdui-table mdui-table-hoverable">
            <thead>
                <tr>
                    <th>手机号</th>
                    <th class="mdui-table-col-numeric">更多操作</th>
                </tr>
            </thead>
    ');
    
    // 列出数据
    while ($rst = $adminlist_res->fetch(PDO::FETCH_ASSOC)) {
        
        // 对参数加密
        $encode_id = base64_encode($rst['uid']);
        
        echo "<td>{$rst['uid']}</td>".
             "<td><a onclick=\"return confirm('重置密码？')\" href='../auth/reset.php?rnid={$encode_id}'>重置密码</a>
                <a onclick=\"return confirm('确定删除？')\" href='./delete.php?rmid={$encode_id}'>删除</a></td>".
             "</tr>";
             
    }
    
} catch (PDOException $e) {
    
    die ("系统出错，请联系管理员！");
    
}

$pdo = null;

?>