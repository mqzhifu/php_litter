<?php

function autoload($class){


    if( strpos($class,M_CLASS) !== false){

        $l = strpos($class,M_CLASS);
        $class = substr($class, 0,$l);
        $class = lcfirst($class);
        include_once $class .M_EXT;
    }elseif( strpos($class,C_CLASS) !== false){

        $l = strpos($class,C_CLASS);
        $class = substr($class, 0,$l);
        $class = lcfirst($class);
        include_once $class .C_EXT;
    }elseif( strpos($class,LIB_CLASS) !== false){
        $l = strpos($class,LIB_CLASS);
        $class = substr($class, 0,$l);
        $class = lcfirst($class);
        include_once $class .LIB_EXT;
    }
}

function shutdown_function()
{

    $e = error_get_last();
    if($e){
        $type = getErrInfo($e['type']);
        $str = "[type]:".$type.",[msg]:".$e['message'].",[file]:".$e['file'].",[line]".$e['line'];
        LogLib::systemWriteFileHash("fatal",$str);
    }
}

function getErrInfo($errno){
    $type = $errno;
    switch ($errno){
        case E_ERROR:
            $type = 'E_ERROR';break;
        case E_WARNING:
            $type = 'E_WARNING';break;
        case E_PARSE:
            $type = 'E_PARSE';break;
        case E_NOTICE:
            $type = 'E_NOTICE';break;
        case E_CORE_ERROR:
            $type = 'E_CORE_ERROR';break;
        case E_CORE_WARNING:
            $type = 'E_CORE_WARNING';break;
        case E_COMPILE_ERROR:
            $type = 'E_COMPILE_ERROR';break;
        case E_COMPILE_WARNING:
            $type = 'E_COMPILE_WARNING';break;
        case E_USER_ERROR:
            $type = 'E_USER_ERROR';break;
        case E_USER_WARNING:
            $type = 'E_USER_WARNING';break;
        case E_USER_NOTICE:
            $type = 'E_USER_WARNING';break;
        case E_STRICT:
            $type = 'E_STRICT';break;
        case E_RECOVERABLE_ERROR:
            $type = 'E_RECOVERABLE_ERROR';break;
        case E_DEPRECATED:
            $type = 'E_DEPRECATED';break;
        case E_USER_DEPRECATED:
            $type = 'E_USER_DEPRECATED';break;
    }

    return $type;
}

function jump($url){
    header("Location:".$url);
    exit;
}

function getSqlLog(){
		global $db_sql_cnt;
		$rs = "";
		foreach($db_sql_cnt as $k=>$v){
			$rs .= $v."<Br/>";
		}
		return $rs;
}
function microtime_float(){
	list($usec, $sec) = explode(" ", microtime());
	return ((float)$usec + (float)$sec);
}

//?????????AJAX??????
function isAjax() {
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) ) {
		if('xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH']))
			return true;
	}
	if(!empty($_POST['ajax']) || !empty($_GET['ajax']))
		return true;
	return false;
}
//function getServiceMax(){
//    return 15;
//}

////??????REDIS??????
//function msg_redis_exist(){
//    return "msg_redis_exist";
//}
////????????????????????????????????????
//function usr_msg_part_unread($uid){
//    return "usr_msg_part_unread_".$uid;
//}
////??????????????????????????????
//function usr_msg_group_unread($uid){
//    return "usr_msg_group_unread_".$uid;
//}
////??????????????????REDIS~KEY
//function sys_group_msg_key(){
//    return "sys_group_msg_";
//}
////????????????KEY
//function usr_group_msg_key($uid){
//    return "usr_group_msg_".$uid;
//}
////???????????????
//function usr_msg_unread_key($uid){
//    return "usr_msg_unread_".$uid;
//}
////??????????????????KEY
//function usr_msg_part_key($uid){
//    return "usr_msg_part_".$uid;
//}

//function getAdminUnameByid($id){
//	if(!$id)
//		return "??????1";
//	$uinfo = adminUserModel::db()->getById($id);
//	if(!$uinfo)
//		return "??????2";
//
//	$uname = "??????3";
//	if( isset($uinfo['nickname']) && $uinfo['nickname'])
//		$uname = $uinfo['nickname'];
//
//	return $uname;
//}

function getAvatarByOid($oid){
	if(!$oid)
		return "/www/images/nouser.png";
	$uinfo = wxUserModel::db()->getRow(" openid = '".$oid."'");
	if(!$uinfo)
		return "/www/images/nouser.png";


	$uname = "/www/images/nouser.png";
	if( isset($uinfo['headimgurl']) && $uinfo['headimgurl'])
		$uname = $uinfo['headimgurl'];

	return $uname;
}

function getAdminAvatarid($id){
	if(!$id)
		return "/www/images/nouser.png";
	$uinfo = adminUserModel::db()->getById($id);
	if(!$uinfo)
		return "/www/images/nouser.png";


	$uname = "/www/images/nouser.png";
	if( isset($uinfo['avatar']) && $uinfo['avatar'])
		$uname = $uinfo['avatar'];

	return $uname;
}


function getUnameByOid($oid){
	if(!$oid)
		return "";
	$uinfo = wxUserModel::db()->getRow(" openid = '".$oid."'");
	if(!$uinfo)
		return "";


	$uname = "";
	if( isset($uinfo['nickname']) && $uinfo['nickname'])
		$uname = $uinfo['nickname'];

	return $uname;
}

function echo_json($data,$code = 200){
	$rs = array('data'=>$data,'code'=>$code);
	echo json_encode($rs,true);
	exit;
}

function admin_db_log_writer($msg,$admin_uid,$cate,$addtime = 0){
	if(!$msg || !$admin_uid || !$cate )
		return 0;

	if(!$addtime)
		$addtime = time();

	$ip = get_client_ip();
	$data = array('memo'=>$msg,'uid'=>$admin_uid,'add_time'=>$addtime,'IP'=>$ip,'cate'=>$cate);
	return AdminLogModel::db()->add($data);
}


//??????????????????-????????????
//function stop( $error ){
//	ExceptionFrameLib::halt($error );
//}
// PHP_SELF:??????????????????????????????????????????:b.com/test/test.php?k=v??????PHP_SELF?????????/test/test.php???
// SCRIPT_NAME???????????????????????????????????????:B.com/test/test.php?k=v??????SCRIPT_NAME?????????/test/test.php???
// SCRIPT_FILENAME??????????????????????????????????????????:B.com/test/test.php?k=v?????? ???/var/www/test/test.php????????????????????????CLI????????????????????????../test/test.php??????../test/test.php???
// PATH_INFO???????????????????????????????????????????????????????????????????????????????????????????????????query string??????:b.com/test/test.php/a/b?k=v??????PATH_INFO?????????/a/bREQUEST_URI?????????HTTP??????????????????URI?????????????????????http://example.com/test/test.php?k=v??????REQUEST_URI???/test/test.php?k=v
// PHP_SELF???SCRIPT_NAME?????????b.com/test/test.php/a/b?k=v??????PHP_SELF???/test/test.php/a/b???SCRIPT_NAME???/test/test.php???????????????PHP_SELF???SCRIPT_NAME??????PATH_INFO????????????
//????????????????????????????????????WIN????????????????????????admin.php,???????????????????????????????????????ADMIN.PHP,?????????????????????????????????$_SERVER['SCRIPT_FILENAME']???????????????????????????admin.php
function _get_script_url() {
	$rs = "";
	$scriptName = basename($_SERVER['SCRIPT_FILENAME']);
	if(basename($_SERVER['SCRIPT_NAME']) === $scriptName) {
		$rs = $_SERVER['SCRIPT_NAME'];
	}else if(basename($_SERVER['PHP_SELF']) === $scriptName) {
		$rs = $_SERVER['PHP_SELF'];
	} else if(($pos = strpos($_SERVER['PHP_SELF'],'/'.$scriptName)) !== false) {
		$rs = substr($_SERVER['SCRIPT_NAME'],0,$pos).'/'.$scriptName;
	}else{
		stop('???????????????');
	}
	return $rs;
}
//seo robot ??????
function checkrobot($useragent = '') {
	static $kw_spiders = array('bot', 'crawl', 'spider' ,'slurp', 'sohu-search', 'lycos', 'robozilla');
	static $kw_browsers = array('msie', 'netscape', 'opera', 'konqueror', 'mozilla');

	$useragent = strtolower(empty($useragent) ? $_SERVER['HTTP_USER_AGENT'] : $useragent);
	if(strpos($useragent, 'http://') === false && dstrpos($useragent, $kw_browsers)) return false;
	if(dstrpos($useragent, $kw_spiders)) return true;
	return false;
}

function eo($title,$data = null,$n = 1,$charset = 1){
    $content = $title;
    if($data){
        $content .= json_encode($data);
    }

    if($n){
        if(PHP_OS == 'WINNT'){
            $content .= "\r\n";
        }else{
            $content .= "\n";
        }
    }

    if($charset){
        if(PHP_OS == 'WINNT'){
            //?????????PHP7?????????????????????
            exec('chcp 936');
            $content = iconv("UTF8",'GBK',$charset);
        }
    }

    echo date("Y-m-d H:i:s")."|".$content;
}

function out_pc($code = 200,$msg = ''){
    if(!$msg){
        $msg = $GLOBALS['code'][$code];
    }
    return out($code,$msg,'pc');
}
function out_ajax($code = 500,$msg = null){
    header('Content-Type:application/json; charset=utf-8');
    if(!$msg){
        $msg = $GLOBALS['code'][$code];
        var_dump($msg);
    }
    return out($code,$msg,'ajax',1);
}
//??????
function out($code = 999,$msg = '',$type = 'ajax',$uid = 0,$isLog = 0){
    if($type == 'pc'){
        return array('msg'=>$msg,'code'=>$code);
    }else{
        if($isLog){
            if(!$uid){
                $uid = LOGIN_UID;
            }
            $exec_time = $GLOBALS['start_time'] - microtime(TRUE);
            $data = array(
                'uid'=>$uid,
                'return_info'=>$code."##".$msg,
                'exec_time'=>$exec_time
            );
            AccesslogModel::db()->upById(ACCESS_ID,$data);
        }

		echo json_encode(array('code'=>$code,"msg"=>$msg));
		exit;
    }
}

function getEmailHref($email){
    $a_email = array(
        'sina'=>'mail.sina.com.cn',
        '163'=>'mail.163.com',
        'qq'=>'mail.qq.com',
        '126'=>'mail.126.com',
        'hotmail'=>'login.live.com',
        'gmail'=>'mail.google.com',
        'yahoo'=>'mail.aliyun.com',
        'aliyun'=>'mail.aliyun.com'
    );

    preg_match_all('/@(.*?)\./',$email,$a_href);
    if( isset($a_href[1][0])){
        if(  isset(  $a_email[$a_href[1][0]] ) ){
            return $a_email[$a_href[1][0]];
        }
    }

    return "#";
}

// ?????????????????? ??????????????????????????????
function get_instance_of($name, $method='', $args=array()) {
	static $_instance = array();
// 	$identify = empty($args) ? $name . $method : $name . $method . to_guid_string($args);
	if ( ! isset($_instance[$name]) ) {
		if (class_exists($name)) {
			$o = new $name();
			$_instance[$name] = $o;
// 			if (method_exists($o, $method)) {
// 				if (!empty($args)) {
// 					$_instance[$name] = call_user_func_array(array(&$o, $method), $args);
// 				} else {
// 					$_instance[$name] = $o->$method();
// 				}
// 			}else{
// 				$_instance[$name] = $o;
// 			}
// 		}else{
// 			stop("new class:". $name);
		}else{
            ExceptionFrameLib::throwErr("class not exists:". $name);
        }
	}
	return $_instance[$name];
}
// ???????????????
function C($name=null, $value=null) {
	static $_config = array();
	// ????????????????????????
	if (empty($name))   return $_config;
	// ?????????????????????????????????
	if (is_string($name)) {
		if (!strpos($name, '.')) {
			$name = strtolower($name);
			if (is_null($value))
				return isset($_config[$name]) ? $_config[$name] : null;
			$_config[$name] = $value;
			return;
		}
		// ?????????????????????????????????
		$name = explode('.', $name);
		$name[0]   =  strtolower($name[0]);
		if (is_null($value))
			return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : null;
		$_config[$name[0]][$name[1]] = $value;
		return;
	}
	// ????????????
	if (is_array($name)){
		return $_config = array_merge($_config, array_change_key_case($name));
	}
	return null; // ??????????????????
}
function ajax_stop($msg){
	$js = array('err'=>1,'msg'=>$msg,'data'=>'');
	echo json_encode($js);
	exit;
}
// ???????????????IP??????
function get_client_ip() {
	static $ip = NULL;
	if ($ip !== NULL) return $ip;
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$pos =  array_search('unknown',$arr);
		if(false !== $pos) unset($arr[$pos]);
		$ip   =  trim($arr[0]);
	}elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}elseif (isset($_SERVER['REMOTE_ADDR'])) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	// IP??????????????????
	$ip = (false !== ip2long($ip)) ? $ip : '0.0.0.0';
	return $ip;
}

//GET POST REQUEST
function _g($name, $type = '' , $is_null = 0) {
	if (isset($_POST[$name]))   $ret = $_POST[$name];
	elseif (isset($_GET[$name]))   $ret = $_GET[$name];
	elseif (isset($_REQUEST[$name]))   $ret = $_REQUEST[$name];
	else {
		$ret = false;
		if($is_null)
			stop($name.':??????????????????-???');
		
	}
	
	if(!$ret)
		if($is_null)
			stop($name.':??????????????????-???');
		
	if(!is_array($ret)){
 		$ret = trim($ret);         		//??????????????????
// 		$ret = nl2br($ret);         	//?????????????????????<br />
// 		$ret = strip_tags($ret);      	//??????????????????HTML??????
// 		$ret = htmlspecialchars($ret); 	//??????????????????????????????HTML??????
 		$ret = addslashes($ret);      	//??????????????????
	}
	
	
	if ($ret && $type != '') {
		if(!in_array($type,array_flip(FilterLib::$validate)))
			stop('type kery??????'.$type,'G_PARA');
			
		if(!FilterLib::regex($ret,$type))
			stop('??????????????????'.$type,'G_PARA');
	}
	return $ret;
}
//??????HTTP??????
function send_http_status($code) {
	static $_status = array(
	// Success 2xx
			200 => 'OK',
			// Redirection 3xx
			301 => 'Moved Permanently',
			302 => 'Moved Temporarily ',  // 1.1
			// Client Error 4xx
			400 => 'Bad Request',
			403 => 'Forbidden',
			404 => 'Not Found',
			// Server Error 5xx
			500 => 'Internal Server Error',
			503 => 'Service Unavailable',
	);
	if(isset($_status[$code])) {
		header('HTTP/1.1 '.$code.' '.$_status[$code]);
		// ??????FastCGI???????????????
		header('Status:'.$code.' '.$_status[$code]);
	}
}
//??????SMARTY??????
function getKernelSmarty($path = ''){
	$Template = get_instance_of('TemplateLib');
	$Template->setPath(KERNEL_DIR."/view/");
	$Template->setCompilePath( KERNEL_DIR."/view_c/");
	
	return $Template;
}

function getAppSmarty($path = ''){
	$Template = get_instance_of('TemplateLib');
	$Template->setPath(APP_DIR."/view/");
	$Template->setCompilePath( APP_DIR."/view_c/");
	return $Template;
}


function setSmartyPath($path){
	$SmartyClass = get_instance_of('Smarty');
	$SmartyClass->setTemplateDir($path);
}

//?????????????????????
function getDb($dbName){
	static $dbLink = array();
	if(!isset($dbLink[$dbName])){
		$f = 0;
		foreach($GLOBALS['db_config'] as $k=>$v){
			if($k == $dbName){
				$f = 1;
				$config = $v;
			}
		}
		if(!$f){
			stop('DB_config error','no');
		}
		// 		include 'Model.class.php';
		$db = new DbLib($config);
		$dbLink[$dbName] =  $db;
	}
	return $dbLink[$dbName];
}
//???????????????
// function Singleton ($className){
// 	static $_instens = array();
// 	if(!isset($_instens[$className])){
// 		$_instens[$className] = new $className;
// 	}
// 	return $_instens[$className];
// }
// ??????PHP???????????????????????????????????????
function to_guid_string($mix) {
	if (is_object($mix) && function_exists('spl_object_hash')) {
		return spl_object_hash($mix);
	} elseif (is_resource($mix)) {
		$mix = get_resource_type($mix) . strval($mix);
	} else {
		$mix = serialize($mix);
	}
	return md5($mix);
}
// ???????????????????????????
function N($key, $step=0) {
	static $_num = array();
	if (!isset($_num[$key])) {
		$_num[$key] = 0;
	}
	if (empty($step))
		return $_num[$key];
	else
		$_num[$key] = $_num[$key] + (int) $step;
}
// ?????????????????????????????????
function G($start,$end='',$dec=4) {
	static $_info = array();
	if(is_float($end)) { // ????????????
		$_info[$start]  =  $end;
	}elseif(!empty($end)){ // ????????????
		if(!isset($_info[$end])) $_info[$end]   =  microtime(TRUE);
		return number_format(($_info[$end]-$_info[$start]),$dec);
	}else{ // ????????????
		$_info[$start]  =  microtime(TRUE);
	}
}
// ??????????????????
function showtime() {
	global $db_sql_cnt;
	$process_time = microtime(TRUE) - $GLOBALS['start_time'] ;
	$showTime   =   'Process: '.$process_time.'s ';
	// ???????????????????????????
	$showTime .= ' | DB_select :'.N('db_query').' ,DB_write '.N('db_write');
	// ??????????????????
	$showTime .= ' | UseMem:'. number_format((memory_get_usage() - $GLOBALS['start_use_mems'])/1024).' kb';
	$showTime .= ' | LoadFile:'.count(get_included_files());
	$fun  =  get_defined_functions();
	$showTime .= ' | CallFun:'.count($fun['user']).','.count($fun['internal']);
	return $showTime;
}
//???????????????????????????????????????
function check_const(){
	if(!defined('PROJECT_PATH'))exit('??????????????????PROJECT_PATH');
	if(!defined('KERNEL_PATH'))exit('??????????????????:KERNEL_PATH');
	if(!defined('APP_NAME'))exit('??????????????????APP_NAME');
	if(!defined('APP_PATH'))exit('??????????????????APP_PATH');
	if(!defined('USER_TYPE'))exit('??????????????????USER_TYPE');
	if(!defined('DOMAIN'))exit('??????????????????DOMAIN');
	if(!defined('DOMAIN_KERNEL'))exit('??????????????????DOMAIN_KERNEL');
	if(!defined('ERROR_TPL'))exit('??????????????????ERROR_TPL');
	if(!defined('DEF_DB_CONN'))exit('??????????????????DEF_DB_CONN');
}



function get_mac($os_type) {
	switch (strtolower ( $os_type )) {
		case "linux" :
			forLinux ();
		case "darwin" : // ????????????
			forLinux ();
			break;
		case "solaris" :
			break;
		case "unix" :
			break;
		case "aix" :
			break;
		default :
			$this->forWindows ();
			break;
	}
	
	$temp_array = array ();
	foreach ( $this->return_array as $value ) {
		
		if (preg_match ( "/[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f]/i", $value, $temp_array )) {
			$this->mac_addr = $temp_array [0];
			break;
		}
	}
	unset ( $temp_array );
	return $this->mac_addr;
}

function forWindows() {
	exec ( "ipconfig /all", $this->return_array );
	if ($this->return_array)
		return $this->return_array;
	else {
		$ipconfig = $_SERVER ["WINDIR"] . "\system32\ipconfig.exe";
		if (is_file ( $ipconfig ))
			@exec ( $ipconfig . " /all", $this->return_array );
		else
			@exec ( $_SERVER ["WINDIR"] . "\system\ipconfig.exe /all", $this->return_array );
		return $this->return_array;
	}
}
function forLinux() {
	//Ether?????????ARP???????????????????????????MAC???
	exec ( "/sbin/ifconfig", $this->return_array, $r );
	return $this->return_array;
}

function getConst($arr,$key){
	static  $global = array();
	if(!$global){
		$global = include 'global.inc.php';
	}
	
	if($key){
		$rs = $global[$arr][$key];
	}else{
		$rs = $global[$arr];
	}
	
	return $rs;
}

function getDbConst($key){
	static  $globalDb = array();
	if(!$globalDb){
		$db = getDb(DEF_DB_CONN);
		$sql = "select * from const";
		$globalDb = $db->getAllBySQL($sql);
	}
	
	return $globalDb[$key];
}


//?????????????????????????????????
function isMobile() {
	// ?????????HTTP_X_WAP_PROFILE????????????????????????
	if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
		return true;
	}
	//??????via????????????wap????????????????????????,?????????????????????????????????
	if (isset ($_SERVER['HTTP_VIA'])) {
		//????????????flase,?????????true
		return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
	}
	//????????????????????????????????????????????????,?????????????????????
	if (isset ($_SERVER['HTTP_USER_AGENT'])) {
		$clientkeywords = array (
				'nokia',
				'sony',
				'ericsson',
				'mot',
				'samsung',
				'htc',
				'sgh',
				'lg',
				'sharp',
				'sie-',
				'philips',
				'panasonic',
				'alcatel',
				'lenovo',
				'iphone',
				'ipod',
				'blackberry',
				'meizu',
				'android',
				'netfront',
				'symbian',
				'ucweb',
				'windowsce',
				'palm',
				'operamini',
				'operamobi',
				'openwave',
				'nexusone',
				'cldc',
				'midp',
				'wap',
				'mobile'
		);
		// ???HTTP_USER_AGENT????????????????????????????????????
		if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
			return true;
		}
	}
	//?????????????????????????????????????????????????????????
	if (isset ($_SERVER['HTTP_ACCEPT'])) {
		// ???????????????wml???????????????html????????????????????????
		// ????????????wml???html??????wml???html????????????????????????
		if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
			return true;
		}
	}
	return false;
}

function get_user_browser() {
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (stripos($browser, 'Firefox') !== false) {
        $curbrowser = 'Firefox';
    } elseif (stripos($browser, 'Chrome') !== false) {
        $curbrowser = 'Chrome';
    } elseif (stripos($browser, 'Safari') !== false) {
        $curbrowser = 'Safari';
    } elseif (strpos($browser, "NetCaptor")) {
        $curbrowser = "NetCaptor";
    } elseif (strpos($browser, "Netscape")) {
        $curbrowser = "Netscape";
    } elseif (strpos($browser, "Lynx")) {
        $curbrowser = "Lynx";
    } elseif (strpos($browser, "Opera")) {
        $curbrowser = "Opera";
    } elseif (strpos($browser, "Konqueror")) {
        $curbrowser = "Konqueror";
    } elseif (strpos($browser, "MSIE 9.0")) {
        $curbrowser = "IE9";
    } elseif (strpos($browser, "MSIE 8.0")) {
        $curbrowser = "IE8";
    } elseif (strpos($browser, "MSIE 7.0")) {
        $curbrowser = "IE7";
    } elseif (strpos($browser, "MSIE 6.0")) {
        $curbrowser = "IE6";
    } elseif (strpos($browser, "MSIE")) {
        $curbrowser = "IE";
    } else {
        $curbrowser = 'Other';
    }
    return $curbrowser;
}

function is_weixin(){
    if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
        return true;
    }
    return false;
}


function dump($var, $echo=true, $label=null, $strict=true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else
        return $output;
}



function get_path_by_id($photoid){
    $photoid_key = "uthing$#267$#889h6";
    if(!$photoid) return;

    $baseNum = 10000; //???xx?????????????????????????????????
    $subbaseNum = 100;

    $folder1 = intval($photoid/$baseNum);
    $folder2 = intval( ($photoid-$folder1*$baseNum)/$subbaseNum );

    $str = str_encode($photoid, $photoid_key);
    $str = str_replace(array("/", "+"), array("_", "-"), $str);

    $securefolder = $str;
    $path = "{$folder1}/{$folder2}/{$securefolder}";

    return $path;
}

function get_app_download_info($andriod_download_url,$log_download_url){
	$os_info = get_useragent_OS();
	$rs = array('os_info'=>$os_info);
	$rs['browser_info'] = get_useragent_browser();

	if(is_weixin()){
		$rs['is_wx'] = "true";
	}else{
		$rs['is_wx'] = "false";
	}


	$js = '
    function download_app(){
        var hr = encodeURI("'.$log_download_url.'");
        var content = "topnews_download-";

        var OS = "'.$rs['os_info']['os'].'";
        var is_weixin = '.$rs['is_wx'].';
        if(is_weixin){
            content += "wenxin";
            if("ios" == OS){
                content += "wenxin-ios";
                push_server(hr,content);
                var url = "http://a.app.qq.com/o/simple.jsp?pkgname=com.uthing";
                location.href= url;
            }else{
                content += "wenxin-android";
                push_server(hr,content);
                location.href="http://a.app.qq.com/o/simple.jsp?pkgname=com.uthing";
            }
        }else{
            if("ios" == OS){
                content += "ios";
                push_server(hr,content);
                location.href="itms-apps://itunes.apple.com/cn/app/id952955630";
            }else{
                content += "android";
                push_server(hr,content);
                location.href="'.$andriod_download_url.'";
            }
        }


    }

    function push_server(hr,content){
        content = encodeURI(content);
        var url = '.PRODUCT_URL.' "/?action=topcnt&hr="+hr+"&content="+content;
//        alert(url);
        $.ajax({
            url: url,
            dataType: "json",
            success: function(){}
        });
    }';

	$rs['js'] = $js;
	return $rs;

}


