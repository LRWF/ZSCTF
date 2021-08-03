<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

function getcustcount($cid, $start, $end) {
    
    require("../config/connect_sql.php");
    
    // 从数据库里读取数据
    $custcount_sql = "SELECT count( * ) FROM zsctf_signed WHERE status = '√' AND id = ? AND date BETWEEN ? AND ?";
    $custcount_res = $pdo -> prepare($custcount_sql);
    $custcount_res -> execute(array($cid, $start, $end));
    
    // 计算行数
    $count = $custcount_res -> fetch();
    $row = $count[0];
    
    // 返回结果
    return $row;
    
    $pdo = null;
    
}

?>