<!DOCTYPE html>
<html>
<head>
	<title>SENSITIVE</title>
	<script>
		function requestServer(action){
			xmlhtml = new XMLHttpRequest();
			var data = "action="+action;
			xmlhtml.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200){
					if( this.responseText != "<strong>sessions_ok</strong>"){
						location.replace("login.php");
					} 
				}
			}
			xmlhtml.open("POST", "../server/authentication.php", true);
			xmlhtml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhtml.send(data); 
		}

		requestServer("totalCheck");
	</script>
</head>
<body>
	<p>Sensitive Page</p>
	<button type="button" onclick="requestServer('logout')">Log Out</button>
	<!--Show sensitive Data-->
</body>
</html>