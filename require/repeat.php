<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

function repeatcheck($check_status, $check_id, $check_date) {
    
    require("../config/connect_sql.php");
    
    // 从数据库里读取数据
    $repeat_sql = "SELECT count( * ) FROM zsctf_signed WHERE status = ? AND id = ? AND date = ?";
    $repeat_res = $pdo -> prepare($repeat_sql);
    $repeat_res -> execute(array($check_status, $check_id, $check_date));
    
    // 计算行数
    $count = $repeat_res -> fetch();
    $row = $count[0];
    
    // 返回结果
    return $row;
    
    $pdo = null;
    
}

?>