<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

function personcheck($check_name, $check_id) {
    
    require("../config/connect_sql.php");
    
    // 从数据库里读取数据
    $person_sql = "SELECT count( * ) FROM zsctf_member WHERE name = ? AND id = ?";
    $person_res = $pdo -> prepare($person_sql);
    $person_res -> execute(array($check_name, $check_id));
    
    // 计算行数
    $count = $person_res -> fetch();
    $row = $count[0];
    
    // 返回结果
    return $row;
    
    $pdo = null;
    
}

?>