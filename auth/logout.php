<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

session_start();
unset($_SESSION['zsctf_member_login']);
unset($_SESSION['zsctf_admin_login']);
session_destroy();
exit ("<script>alert('您已安全退出登录！');location.href='..';</script>");

?>