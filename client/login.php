<!DOCTYPE html>
<html>
<head>
	<title>Login - Register</title>
	<script>
		var username, password, rememberMe;
		var xmlhtml, respond;
		function readData(){
			username = document.getElementById('username').value;
			password = document.getElementById('password').value;
			rememberMe = document.getElementById('rememberMe').checked;
			//console.log(username, password, rememberMe);
		}

		function requestServer(action){
			readData();
			xmlhtml = new XMLHttpRequest();
			var data = "username="+username+"&password="+password+"&rememberMe="+rememberMe+"&action="+action;
			//console.log(data);
			//check + set Session 
			xmlhtml.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200){
					document.getElementById('serverRespond').innerHTML = this.responseText;
					//location.replace("https://www.w3schools.com")
					if( this.responseText == "<strong>sessions_ok</strong>"){
						location.replace("index.php");
					}
				}
			}
			xmlhtml.open("POST", "../server/authentication.php", true);
			xmlhtml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhtml.send(data); 
			//if true, set Cookies
		}


	</script>
</head>
<body>
	<div>
		USERNAME: <input type="text" name="Name" id="username"><br>
		PASSWORD: <input type="password" name="Name" id="password"><br>
	</div>
	<div>
		<button type="button" value="username" onclick="requestServer('login')">Login</button> 
		<button type="button" value="password" onclick="requestServer('regis')">Register</button><br>
		<input type="checkbox" id="rememberMe">Remember me for a month<br>
	</div>
	<div>
		Server Respond:<br>
		<p id='serverRespond'>Server Respond Here</p>
	</div>
	<div>
		<p>VVV --Checking purpose only-- VVV</p>
		<button type="button" onclick="requestServer('check')">Check</button>
		<button type="button" onclick="requestServer('cookiesCheck')">Cookies Check</button>
		<button type="button" onclick="requestServer('sessionsCheck')">Sessions Check</button><br>
	</div>
</body>
</html>