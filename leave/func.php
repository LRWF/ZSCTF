<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

// 获取 id
session_start();
$user = $_SESSION['zsctf_member_login'];

// 通过 sql 查找姓名
require_once("../config/connect_sql.php");
$leave_name_sql = "SELECT name FROM zsctf_member WHERE id = ?";
$leave_name_res = $pdo -> prepare($leave_name_sql);
$leave_name_res -> execute(array($user));
$rst = $leave_name_res->fetch(PDO::FETCH_ASSOC);

// 检查是否已经提交过
require_once("../require/repeat.php");
$status = '请假';
$date = date("Y-m-d");
$check_repeat = repeatcheck($status, $user, $date);

// 接收 title 和 description
$title = isset($rst['name']) ? $rst['name'] : $user;
$desp = isset($_REQUEST['desp']) ? $_REQUEST['desp'] : 'Empty';

include "../config/wxwork_config.php";
include "./function.php";

$sendKey = isset($_REQUEST['sendKey']) ? $_REQUEST['sendKey'] : '';
$smsHash = isset($_REQUEST['hash']) ? $_REQUEST['hash'] : '';
$type = isset($_REQUEST['type']) ? false : true;
$encode = $_SERVER['REQUEST_METHOD'] == 'GET' ? false : true;

// push && save
$redis = new Redis();
$redis->connect($REDIS_IP, $REDIS_PORT);
if($REDIS_PASSWD != "") {
	$redis->auth($REDIS_PASSWD);
}      
$redis->select($REDIS_DB);
if(!strcmp($redis->ping(),"1")==0){
	errMessage($ERR_REDIS_CONN);
}

if($type) {
    
    // 如果 sql 内存在，则弹出提示
    if ($check_repeat != 0) {
        reMessage($ERR_MESSAGE);
    }
    
    if($SEND_KEY != "") {
		if(!strcmp($SEND_KEY,$sendKey)==0){
			errMessage($ERR_SEND_KEY);
		}
	}
	
	if($redis->exists($REDIS_CACHE_TOKEN)) {
		$accessToken = $redis->get($REDIS_CACHE_TOKEN);
	} else {
		$url = $GET_TOKEN_URL."?corpid=".$CORPID."&corpsecret=".$CORPSECRET;
		$res = httpRequest($url,null,true);
		if($res == null) {
			errMessage($ERR_TOKEN);
		}
		$tokenJson = json_decode($res,true);
		if($tokenJson["errcode"] != 0 || $tokenJson["errcode"] != "ok"){
			errMessage($ERR_TOKEN);
		}
		$accessToken = $tokenJson["access_token"];
		$redis->setex($REDIS_CACHE_TOKEN,$tokenJson["expires_in"],$tokenJson["access_token"]);
	}
	
	$pushUrl = $PUSH_MSG_URL.$accessToken;
	
	$data = array(
		    "touser"=>$TOUSER,
		    "toparty"=>$TOPARTY,
		    "totag"=>$TOTAG,
		    "msgtype"=>"textcard",
		    "agentid"=>$AGENTID,
		    "textcard"=>"",
		    "enable_id_trans"=>0,
		    "enable_duplicate_check"=>0,
	        "duplicate_check_interval"=>1800
	    );
	    
	$title = strip_tags($title);
	$desp = strip_tags($desp,"<p><b><br><span><div>");
	if($encode){
	    $title = urldecode($title);
	    $desp = urldecode($desp);
	}
	
	$sunDesp = strip_tags($desp);
	if(mb_strlen($sunDesp,'UTF8') >= $DESP_SIZE) {
	    $sunDesp = substr($sunDesp,$DESP_SIZE);
	}
	
	$hash = md5($title.$desp);
 	$collBackUrl = $CALL_BACK_URL.$hash;
	
    $textcard = array(
            "title"=>$title,
            "description"=>$sunDesp,
            "url"=>$collBackUrl,
            "btntxt"=>"查看详情"
        );	    
    
    $data["textcard"] = $textcard;
	$description = json_encode($data);
	$res = httpRequest($pushUrl,$description,true);
	if($res == null){
			errMessage($ERR_MESSAGE);
		}
	$tokenJson = json_decode($res,true);
	if($tokenJson["errcode"] != 0 || $tokenJson["errcode"] != "ok"){
		errMessage($tokenJson["errcode"]);
	}
	
	$sms = array(
	    'title' => $title,
	    'desp' => $desp
	);
	
	$redis->setex($REDIS_CACHE_SMS.$hash,$SMS_CACHE_TIME,json_encode($sms));
	
	// 请假信息存入 sql
    $leave_save_sql = "INSERT INTO zsctf_signed (status, date, name, id, note)
                        VALUES (?, ?, ?, ?, ?)";
    $leave_save_res = $pdo -> prepare($leave_save_sql);
    $leave_save_res -> execute(array($status, $date, $title, $user, $desp));
	
	suressMessage($tokenJson["errcode"]);
} else {
    if($redis->exists($REDIS_CACHE_SMS.$smsHash)) {
		$sms = json_decode($redis->get($REDIS_CACHE_SMS.$smsHash),true);
	}else{
	    $sms = array(
	    'title' => "消息已过期或不存在",
	    'desp' => "Push 消息只保留 6 小时<br>过期后可登录管理员后台查看详情<br><br>如果消息尚未过期<br>可能是消息 Hash 值出错<br>请联系管理员检查"
	);
	}
	
	$mod = file_get_contents("mod.php");
	$mod = str_replace("#[title]",$sms["title"],$mod);
	$mod = str_replace("#[desp]",$sms["desp"],$mod);
	echo $mod;
}
	
?>