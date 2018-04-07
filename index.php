<?php
include("db.php");
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>SaveStak</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
	<style type="text/css">
	#centerPage{
		float: center;
		text-align: center;
		font-family: Gruppo, Ariel, sans-serif;
		font-weight: bold;
		font-variant: normal;
		line-height: 27px;
		padding-top: 20px;
		letter-spacing: 5px;
		margin-bottom: 20px;
		margin-right: 70px;
		margin-left: 0px;
		size: 60px;
	}
	#webTitle{
		margin-bottom: 30px;
		color: #4169E1;
	}
	#manage{
		position: relative;
         right: 1.5%;
        color: #808080;
	}
		form{
         position: absolute;
         top: 30%;
         left: 38%;
		}
		#images{
			position: relative;
			right: 2.5%;
		}
	</style>
</head>
<body>
	<div id="centerPage">
		<h1 id="webTitle">S A V E  S T A K S</h1>
		<p id="manage">Manage your money.</p>
	<div id="images">
		<img src="coins.png">
		<img src="dollars.png">
	</div>
	</div>

	<form class="form-inline" action="index.php" method="POST">
  <div class="form-group mx-sm-3 mb-2">
    <label for="username" class="sr-only">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
  </div>
  <button type="submit" class="btn btn-primary mb-2" id="button">Login</button> <br>
</form>

<p id="status"></p>
<script type="text/javascript">
	var url = "http://api.reimaginebanking.com/accounts?type=Checking&key=00e5eaabe90e2e82f3379860987ed3d3"; //get all account
	var xhr;
	var user = document.getElementById("username").value;
	var users = [];
  if(window.XMLHttpRequest){
    xhr = new XMLHttpRequest();

  }
  else{
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhr.open('GET', url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function()
  {
  	if(xhr.status == 200 && xhr.readyState == 4){
  		 var arr = xhr.responseText;
  		 arr = JSON.parse(arr);
  		 var length = Object.keys(arr).length;
  		 for(var i = 0; i < length; i++){
  		 	var nickname = arr[i]['nickname'];
  		 	users.push(nickname);
  		 	if(user == nickname){
  		 		var account_url = "http://api.reimaginebanking.com/accounts/" + arr[i]['_id'] + "?key=00e5eaabe90e2e82f3379860987ed3d3"; //the account to login to
  		 		//make _id global
  		 		//window.location = account_url;
  		 	}

  		 }
  	}
  }
  xhr.send();
  $("button").click(function(e){
 if(users.indexOf(document.getElementById("username").value) == -1){

  		 	console.log("Invalid username");

  		 }
  		 else{
  		 	console.clear();
  		 	console.log("correct username");
  		 	 	var xhr2;
  if(window.XMLHttpRequest){
    xhr2 = new XMLHttpRequest();

  }
  else{
    xhr2 = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhr2.open('POST', "info.php", true);
  xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr2.onreadystatechange = function(){
  	if(xhr2.status == 200 && xhr2.readyState == 4){
  		
  	}
  }
  xhr2.send("u=" + document.getElementById("username").value);

  		 }
  		 window.location = "home.php";
  		 e.preventDefault();
  })
$(document).keypress(function(e){
	if(e.keyCode == 13){
 if(users.indexOf(document.getElementById("username").value) == -1){
  		 	console.log("Invalid username");
  		 }
  		 else{
  		 	console.clear();
  		 	console.log("correct username");
  		 	console.clear();
  		 	console.log("correct username");
  		 	 	var xhr2;
  if(window.XMLHttpRequest){
    xhr2 = new XMLHttpRequest();

  }
  else{
    xhr2 = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhr2.open('POST', "info.php", true);
  xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr2.onreadystatechange = function(){
  	if(xhr2.status == 200 && xhr2.readyState == 4){
  		
  	}
  }
  xhr2.send("u=" + document.getElementById("username").value);
  		}
  		window.location = "home.php";
  		 e.preventDefault();
	}
})
</script>
</body>
</html>