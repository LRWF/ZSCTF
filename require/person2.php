<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

function person_admin_check($check_uid) {
    
    require("../config/connect_sql.php");
    
    // 从数据库里读取数据
    $person_admin_sql = "SELECT count( * ) FROM zsctf_admin WHERE uid = ?";
    $person_admin_res = $pdo -> prepare($person_admin_sql);
    $person_admin_res -> execute(array($check_uid));
    
    // 计算行数
    $count = $person_admin_res -> fetch();
    $row = $count[0];
    
    // 返回结果
    return $row;
    
    $pdo = null;
    
}

?>