<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

$dbMode = 'mysql'; // 数据库类型
$dbHost = 'localhost'; // 数据库链接
$dbName = '你的数据库名字'; // 数据库名称
$dbUser = '你的数据库用户名'; // 用户名
$dbPass = '你的数据库用户密码'; // 密码

$dsn = $dbMode . ":host=" . $dbHost . ";dbname=" . $dbName;

try {
    
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    $pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
} catch (PDOException $e) {
    
    die ("数据库连接出错，请联系管理员！");
    
}

?>