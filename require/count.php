<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

function countget($cid) {
    
    require("../config/connect_sql.php");
    
    // 从数据库里读取数据
    $count_sql = "SELECT count( * ) FROM zsctf_signed WHERE status = '√' AND id = ?";
    $count_res = $pdo -> prepare($count_sql);
    $count_res -> execute(array($cid));
    
    // 计算行数
    $count = $count_res -> fetch();
    $row = $count[0];
    
    // 返回结果
    return $row;
    
    $pdo = null;
    
}

?>