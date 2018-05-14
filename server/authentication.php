<?php 
session_start();

$server = 'localhost';
$username = 'root';
$password = 'dav';
$dbname = 'loginCookiesSession';
$conn = new mysqli($server, $username, $password, $dbname);

$username = $_POST['username'];
$password = $_POST['password'];
$rememberMe = $_POST['rememberMe'];
$action = $_POST['action'];
$id = 2000000000;

function setCookies(){
	//echo "setCookies Running<br>";
	global $rememberMe, $username, $password, $conn, $id;
	if($rememberMe=='false') return 0;
	$cookie_value = hash('ripemd160',$username.$password.rand(0,2000000000));
	setcookie("localhostsite", $cookie_value, time() + (86400 * 30), "/");
	$sql = 'UPDATE users 
		SET cookies = "'.$cookie_value.'" 
		WHERE id = '.$id;
	$conn->query($sql);
	//echo "Set Cookies: ".$cookie_value."<br>";
	//echo "Cookies is given<br>"
}

function setSessions(){ //set sessions and accept username-password/cookies
	global $conn, $id;
	$authen = hash('ripemd160',rand(0,2000000000));
	$_SESSION['authen'] = $authen;
	$sql = 'UPDATE users 
		SET season1 = "'.$authen.'" 
		WHERE id = '.$id;
	$conn->query($sql);
	//echo "Set Sessions: ".$authen."<br>";
}

function cookiesCheck(){
	// Checking + Set $id
	global $conn, $id;
	$sql = 'SELECT id FROM users WHERE cookies = "'.$_COOKIE["localhostsite"].'"';
	$result = $conn->query($sql);
	if( $result->num_rows!=1 ) return "cookies_invalid";
	while($row = $result->fetch_assoc()){
		$id = $row['id'];
	}
	//echo $sql."<br>".$id."<br>";
	//Finish checking
	setSessions();
	return "sessions_ok";
}

function sessionsCheck(){
	global $conn, $id;
	$sql = 'SELECT id FROM users WHERE season1 = "'.$_SESSION["authen"].'"';
	$result = $conn->query($sql);
	if( $result->num_rows!=1 ) return "sessions_invalid";
	while($row = $result->fetch_assoc()){
		$id = $row['id'];
	}
	//echo $sql."<br>".$id."<br>";
	//Finish checking
	setSessions();
	return "sessions_ok";
}

function login(){
	// Checking + Set $id
	global $username, $password, $conn, $id;
	$sql = 'SELECT id FROM users WHERE username="'.$username.'" AND password="'.hash('ripemd160',$password).'"';
	$result = $conn->query($sql);
	if( $result->num_rows!=1 ) return "login_invalid";
	while($row = $result->fetch_assoc()){
		$id = $row['id'];
	}
	// Finish checking
	setCookies(); //ok
	setSessions();
	return "sessions_ok";
}

function checkExistAcc(){
	global $username, $conn;
	$sql = 'SELECT id FROM users WHERE username = "'.$username.'"';
	$result = $conn->query($sql);
	if($result->num_rows == 0) return 1;
	return 0;
}

function regis(){
	global $username, $password, $conn;
	if( checkExistAcc()==0 ) return 'Account existed! Choose another one';
	else if (strlen($password)==0 or strlen($username)==0) return "Username and Password have to be given";
	$sql = 'INSERT INTO users(username, password, sensData)
		VALUES ("'.$username.'", "'.hash('ripemd160',$password).'", "'.$password.'")';
	$conn->query($sql);
	return "Registered. Please login.";
}

function check(){
	$result = 'SESSIONS: '.$_SESSION["authen"]."<br>COOKIES: ".$_COOKIE["localhostsite"]."<br>";
	return $result;
}

function logout(){
	setcookie("localhostsite", $cookie_value, time() -3600, "/");
	session_unset(); 
	session_destroy(); 
}

function totalCheck(){
	if(sessionsCheck()=="sessions_ok") return "sessions_ok";
	if(cookiesCheck()=="sessions_ok") return "sessions_ok";
	return "sessions_invalid";
}

if($action=='regis'){
	echo "<strong>".regis()."</strong>";
} else if($action=='login'){
	echo "<strong>".login()."</strong>";
} else if($action=='check'){
	echo "<strong>".check()."</strong>";
} else if($action=='cookiesCheck'){
	echo "<strong>".cookiesCheck()."</strong>";
} else if($action=="sessionsCheck"){
	echo "<strong>".sessionsCheck()."</strong>";
} else if($action=="logout"){
	logout();
} else if($action=="totalCheck"){
	echo "<strong>".totalCheck()."</strong>";
}
?>