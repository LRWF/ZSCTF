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

echo ('
    <script
      src="../require/js/mdui.min.js"
      integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
      crossorigin="anonymous"
    ></script>
');

// 检查日期
echo ('
    <script type="text/javascript">
    function checkdate()
    {
        str1 = subform.date_start.value;
        str2 = subform.date_end.value;
        
        mstr1 = str1.match(/^(\d{2,4})(-|\/)(\d{1,2})\2(\d{1,2})$/);
        mstr2 = str2.match(/^(\d{2,4})(-|\/)(\d{1,2})\2(\d{1,2})$/);
        
        if (mstr1 != null || mstr2 != null)
        {
            if (mstr1[3] <= 12 && mstr1[4] <= 31 && mstr2[3] <= 12 && mstr2[4] <= 31)
            {
                return true;
            }
            else
            {
                alert("日期段输入不合法，请检查后重试！");
                return false;
            }
        }
        else
        {
            alert("日期段输入不完整或者格式有误，请检查后重试！");
            return false;
        }
    }
    </script>
');

echo ('
    <br><div class="mdui-typo" style="font-size:28px;font-weight:500;text-align:center">自定义日期段查询</div>
    <div class="mdui-typo" style="font-size:12px;font-weight:300;text-align:center">
    <a href="./index.php"> &nbsp;&nbsp;返回首页&nbsp;&nbsp; </a>
    <a href="./dailylist.php"> &nbsp;&nbsp;查看今日&nbsp;&nbsp; </a>
    <a href="./signedlist.php"> &nbsp;&nbsp;查看详细&nbsp;&nbsp; </a>
    </div><br>
');

echo ("
    <form action=\"../function/customquery.php\" method=\"post\" name=\"subform\" onsubmit=\"return checkdate()\">
    	
    	<div class=\"mdui-textfield mdui-textfield-floating-label\">
            <label class=\"mdui-textfield-label\">Start（格式：2021-01-01）</label>
            <input class=\"mdui-textfield-input\" type=\"text\" name=\"date_start\" />
    	</div>
    	
    	<div class=\"mdui-textfield mdui-textfield-floating-label\">
            <label class=\"mdui-textfield-label\">End（格式：2021-01-01）</label>
            <input class=\"mdui-textfield-input\" type=\"text\" name=\"date_end\" />
    	</div>
");

echo ("
    <br><br>
        	<center>
        	    <button class=\"mdui-color-pink-a200 mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent\" type=\"submit\" name=\"submit\">查询</button>
        	</center>
        </form>
");

?>