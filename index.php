<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

echo ('
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ZSCTF</title>
');

echo ('
	<link
      rel="stylesheet"
      href="./require/css/mdui.min.css"
      integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
      crossorigin="anonymous"
    />
');

echo ('
    <script
      src="./require/js/mdui.min.js"
      integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
      crossorigin="anonymous"
    ></script>
');

echo ('
    <br>
    <div class="mdui-typo" style="font-size:28px;font-weight:500;text-align:center">Welcome</div>
    <div class="mdui-typo" style="font-size:14px;font-weight:500;text-align:center">'.date("Y-m-d").'</div>
    <div class="mdui-typo" style="font-size:12px;font-weight:200;text-align:center">禁止对本平台进行包括但不限于未经授权的扫描、渗透、攻击等操作！<br>否则将按照相关法律法规处理！</div>
    <br>
    <div class="mdui-divider"></div><br><br>
    <center>
    <a href="./member/index.php">
    <div class="mdui-chip">
      <span class="mdui-chip-icon"><i class="mdui-icon material-icons">face</i></span>
      <span class="mdui-chip-title">我是普通成员</span>
    </div>
    </a>
    <br><br><br>
    <a href="./admin/index.php">
    <div class="mdui-chip">
      <span class="mdui-chip-icon"><i class="mdui-icon material-icons">account_circle</i></span>
      <span class="mdui-chip-title">我是管理员</span>
    </div>
    </a>
    <br><br><br>
    <a href="mailto:Lechnolocy@foxmail.com">
    <div class="mdui-chip">
      <span class="mdui-chip-icon"><i class="mdui-icon material-icons">mail</i></span>
      <span class="mdui-chip-title">找开发者</span>
    </div>
    </a>
    <br>
    </center>
');

?>