<?php
/*********************************************

	Copyright:	Cozmuler Pakistan
	File Name:	functions.php
	Package:	Pairness.com
	Author:		Rahber

*********************************************/



global $mysqli;


function startSession($timeout = 600){
	global $mysqli;
	session_name('czid');
	session_set_cookie_params(0);
	session_start();

	if (isset($_SESSION['timeout_idle']) && $_SESSION['timeout_idle'] < time()) {

		$dp = session_id();
		$mysqli->query("DELETE FROM session WHERE sessionid='$dp'");
        session_destroy();
        session_start();
        session_regenerate_id();
        $_SESSION = array();
		
    }else{
	$_SESSION['timeout_idle'] = time() + $timeout;
	}
    

}

function update_lastpage($page){
	global $mysqli;
	if($page!='logout.php'){
	$id = $_SESSION['id'];
	if($mysqli->query("UPDATE login set lastpage='$page' where uid ='$id'")){
		return true;
	}
	else {
		return false;
	}
	return false;
	}

}

function takemehome(){

redirect("home.php");

}

function update_session(){
	if(check_login()){
	global $mysqli;
		$sep = $_SESSION['true'];
		$id = $_SESSION['id'];
		$t = time();
		if($mysqli->query("UPDATE session set t='$t' where (sessionid='$sep' and uid ='$id')")){
			return true;
		}
		else {
			return false;
		}
	}else{  return false;  }
}

function randomalpha($length){ 
    $alphNums = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";        
    $newString = str_shuffle(str_repeat($alphNums, rand(1, $length))); 
    return substr($newString, rand(0,strlen($newString)-$length), $length); 
} 

function set_name($title){

	$pageContents = ob_get_contents (); // Get all the page's HTML into a string
	ob_end_clean (); // Wipe the buffer
	$title =  $title ." - ". get_config('sitename') ;
	echo str_replace ('{{sname}}', $title, $pageContents);
}

function remove_session(){
	global $mysqli;
	$ds = $_SESSION['true'];
	$mysqli->query("DELETE FROM session WHERE sessionid='$ds'");
	add_log($_SESSION['id'],"User successfully logged out!");
	
	session_unset();
	$_SESSION = array();
	
    session_destroy();
	startSession();
	session_regenerate_id();

}

function get_name($uid){
	$result = $mysqli->query("SELECT * FROM login where uid='$uid'");
	while($row = $result->fetch_object()){
		return $p = $row->username;
	}

}

function update_config($name,$data){
	global $mysqli;
	if($mysqli->query("UPDATE config set value='$data' where name='$name'")){
		return true;
	}
	else {
		return false;
	}
}

function get_config($vvalue){
	global $mysqli;
	$result = $mysqli->query("SELECT * FROM config where name='$vvalue'");
	while($row = $result->fetch_object()){
		return $p = $row->value;
	}
}

function update_view($id){
	global $mysqli;
	$result = $mysqli->query("Update images set views=views+1 where id='$id'");
}

function redirect($add,$delay=0){
	//echo "<script>window.setTimeout(function(){ window.location = '".$add."'; }, ".$delay.")</script>";
	header("Refresh:". $delay .";url=". $add ); 
}


function onpage($ppg){
	if($ppg==pgname())
		return true;
	else
		return false;
}

function pgname(){
	$currentFile = $_SERVER["PHP_SELF"];
	$parts = Explode('/', $currentFile);
	$parts = $parts[count($parts) - 1];
	$parts = Explode('.', $parts);
	$pageName = $parts[0];
	return $pageName;
}

function fullpagename(){
	$currentFile = $_SERVER["PHP_SELF"];
	$parts = Explode('/', $currentFile);
	$parts = $parts[count($parts) - 1];
	return $parts;

}

function set_var(&$result, $var, $type, $multibyte = false)
{
	settype($var, $type);
	$result = $var;

	if ($type == 'string')
	{
		$result = trim(htmlspecialchars(str_replace(array("\r\n", "\r", "\0"), array("\n", "\n", ''), $result), ENT_COMPAT, 'UTF-8'));

		if (!empty($result))
		{
			// Make sure multibyte characters are wellformed
			if ($multibyte)
			{
				if (!preg_match('/^./u', $result))
				{
					$result = '';
				}
			}
			else
			{
				// no multibyte, allow only ASCII (0-127)
				$result = preg_replace('/[\x80-\xFF]/', '?', $result);
			}
		}

		$result = (STRIP) ? stripslashes($result) : $result;
	}
}


function request_var($var_name, $default, $multibyte = false, $cookie = false) // Always use request var to avoid injection
{
	if (!$cookie && isset($_COOKIE[$var_name]))
	{
		if (!isset($_GET[$var_name]) && !isset($_POST[$var_name]))
		{
			return (is_array($default)) ? array() : $default;
		}
		$_REQUEST[$var_name] = isset($_POST[$var_name]) ? $_POST[$var_name] : $_GET[$var_name];
	}

	$super_global = ($cookie) ? '_COOKIE' : '_REQUEST';
	if (!isset($GLOBALS[$super_global][$var_name]) || is_array($GLOBALS[$super_global][$var_name]) != is_array($default))
	{
		return (is_array($default)) ? array() : $default;
	}

	$var = $GLOBALS[$super_global][$var_name];
	if (!is_array($default))
	{
		$type = gettype($default);
	}
	else
	{
		list($key_type, $type) = each($default);
		$type = gettype($type);
		$key_type = gettype($key_type);
		if ($type == 'array')
		{
			reset($default);
			$default = current($default);
			list($sub_key_type, $sub_type) = each($default);
			$sub_type = gettype($sub_type);
			$sub_type = ($sub_type == 'array') ? 'NULL' : $sub_type;
			$sub_key_type = gettype($sub_key_type);
		}
	}

	if (is_array($var))
	{
		$_var = $var;
		$var = array();

		foreach ($_var as $k => $v)
		{
			set_var($k, $k, $key_type);
			if ($type == 'array' && is_array($v))
			{
				foreach ($v as $_k => $_v)
				{
					if (is_array($_v))
					{
						$_v = null;
					}
					set_var($_k, $_k, $sub_key_type, $multibyte);
					set_var($var[$k][$_k], $_v, $sub_type, $multibyte);
				}
			}
			else
			{
				if ($type == 'array' || is_array($v))
				{
					$v = null;
				}
				set_var($var[$k], $v, $type, $multibyte);
			}
		}
	}
	else
	{
		set_var($var, $var, $type, $multibyte);
	}

	return $var;
}



function short($string, $limit, $break=".", $pad="..."){
	if(strlen($string) <= $limit) return $string;
	if(false !== ($breakpoint = strpos($string, $break, $limit))) {
		if($breakpoint < strlen($string) - 1) {
			$string = substr($string, 0, $breakpoint) . $pad;
		}
	}
	return $string;
}

function isfamily(){
	global $mysqli;
	$u= $_SESSION['id'];
	$queryy = $mysqli->query("select * from login where uid='$u'");
	while ($row = $queryy->fetch_object()){
		$vf = $row->isfamily;
	}
	if($vf==1){
		return true;
	}else{
	 return false;
	}
	
}

function is_vf($email){
	global $mysqli;
	$queryy = $mysqli->query("select * from login where (email='$email' || username='$email' )");
	while ($row = $queryy->fetch_object()){
	return $vf = $row->emailverification;
	}
}

function fstatus(){
  if(isfamily()){ 
return "You are logged in as a family member";
 }else{
return "You are logged in as a bride or groom";
 } 
}

function user_image(){

global $uploadpath;
$e = $_SESSION['email'];

global $mysqli;
	$queryy = $mysqli->query("select * from pairness_family where (familyemailaddress ='$e')");
	while ($row = $queryy->fetch_object()){
		 return  $uploadpath.$row ->familyprofileimage;
	}
	return $uploadpath. "default.png";

}

function do_login($email,$password,$remember,$return){
	session_regenerate_id();
	
	
	$return = remove_http($return);
	global $mysqli;
	$queryy = $mysqli->query("select * from login where ((email='$email' || username='$email' )and password='$password' and emailverification='1')");

		if( mysqli_num_rows($queryy)==1){
			while ($row = $queryy->fetch_object()){
				$ds = session_id();
				$_SESSION['id'] = $row ->uid;
				$_SESSION['email'] = $row ->email;
				$_SESSION['name'] = $row ->username;
				$_SESSION['privacylevel'] = $row ->privacylevel;
				$_SESSION['host'] = $_SERVER['HTTP_HOST'];
				$_SESSION['true'] = $ds;
				insert_ses($ds,$row ->uid);
				$arr = array('uid' => $row ->uid, 'sid' => $ds, 's' => 1,'r'=>$return);
				add_log($row ->uid,"User successfully logged in!");
				return json_encode($arr);
			}
		}
		else{
			if(is_vf($email)==1){
		
				$arr = array('s' => 0,'e'=>'Invalid Credentials');
				return json_encode($arr);
			}
			else{
				$arr = array('s' => 0,'e'=>'Inactive account or Account doesn\'t not exist');
				return json_encode($arr);
			}				
		}
}

function insert_ses($a,$b){
	global $mysqli;
	$time = time();
	$ip = $_SERVER['REMOTE_ADDR'];
	$ip2 = $_SERVER['HTTP_X_FORWARDED_FOR'];
	$q = "INSERT INTO session (uid,sessionid,t,ip,ip2) VALUES ('$b','$a','$time','$ip','$ip2');";
	$mysqli->query($q);
}

function check_login(){
	$ddd = session_id() ;global $mysqli;		
	if(isset($_SESSION['id'])){	
				
		$queryy = $mysqli->query("select * from session where (sessionid='$ddd')");
		$row_cnt = $queryy->num_rows;
	
		if($row_cnt==1){
			return true;
		}else{
			return false;
		}
	
	}
	else{
			
		return false;
	}
}

function remove_http($url) {
   $disallowed = array('http://', 'https://');
   foreach($disallowed as $d) {
      if(strpos($url, $d) === 0) {
         return str_replace($d, '', $url);
      }
   }
   return $url;
}

function getsubpage(){

$currentFile = $_SERVER["PHP_SELF"];
	$parts = Explode('/', $currentFile);
	$parts = $parts[count($parts) - 1];
	$parts = Explode('.', $parts);
	$pageName = $parts[0];
	return $pageName;


}

function auth_check(){
	$pg = pgname();
	if(!check_login() && $pg !='index'){
		redirect($sitepath.'index.php?return='.$pg);
	}
}

function verify_id($email,$cs){
	global $mysqli;


	$query = $mysqli->query("select * from login where email='$email' and sc='$cs'");
		if(mysqli_num_rows($query)==1){
			$d =time();
			$finfo = $query ->fetch_assoc();
			if($finfo['emailverification']==0){
				$quer = $mysqli->query("update login set verificationdate='$d',emailverification=1 where email='$email' and sc='$cs'");
				
				add_log($finfo['uid'],"User has successfully verified the email");
				
				$subject = "Your Email has been succsessfully verified";
				$body = "Yay this is the bodt of succesfuly verified email";
				send_email($email,$subject,$body);
				return "<div class='success'>Successfully Verified.Please click <a href='login.php'>here</a> to login!</div>";
		

			}else{
				return "<div class='warning'>The Account is already verified!</div>";
			}
		}
		else{
			return "<div class='error'>Invalid Key or Email!</div>";
		}
}

function add_log($uid,$action){
	global $mysqli;
	$time = time();
	$q = "INSERT INTO log (uid,action,logtime) VALUES ('$uid','$action','$time');";
	$mysqli->query($q);
}

function cron_session(){
	global $mysqli;
	$t = time();
	$queryy =  $mysqli->query("Select * from session");
		while ($row = $queryy->fetch_object()){
			$op = $row->sessionid;
			if((($t) - ($row->t)) > 600){
			$mysqli->query("DELETE FROM session WHERE sessionid='$op'");
			}
		}
}

function send_email($email,$subject,$body,$bccallow=0,$bccemail=''){
	global $contactemail;
    $to = $email; 
    $from = $contactemail; 

    $headers = "MIME-Version: 1.0rn"; 
    $headers .= "Content-type: text/html; charset=iso-8859-1rn"; 
    $headers  .= "From: $from\r\n"; 

   if($bccallow==1){
    $headers .= "Bcc: $bccemail"; 
	}
 
    // now lets send the email. 
    if(mail($to, $subject, $body, $headers)){
		return 1;	
	}else{
		return 0;
	}



}

function start_app(){
	global $mysqli,$membershippage,$uploadpath,$matchpage,$sitepath,$contactemail,$explorepage,$inboxpage,$homepage,$accountpage,$searchpage,$logoutpage,$photospage,$settingspage,$profilepage;
	$mysqli = new mysqli("localhost", "root", "root", "pairness");
	$contactemail = "rahber@cozmuler.com";
	$sitepath ="http://localhost/pairness.com/";
	
	$searchpage = "search.php";
	$accountpage = "account.php";
	$homepage = "home.php";
	$inboxpage ="inbox.php";
	$explorepage = "explore.php";
	$logoutpage = "logout.php";
	$photospage = "photos.php";
	$settingspage = "settings.php";
	$profilepage = "profile.php";
	$membershippage ="membership.php";
	$matchpage = "match.php";
	$uploadpath = $sitepath. "/upload_images/";
	
	error_reporting(0);
	startSession();
	update_session();
	cron_session();
	update_lastpage(fullpagename());
}

start_app();


?>