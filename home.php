<?php
session_start();
require_once("db.php");
require_once("functions.php");
$username = $_SESSION['username'];
if(!hasAccount($username, $connect)){
	insertUser($username, $connect);
}
//create goal form
if(isset($_POST['goal'])){
  $value =  $_POST['goal'];
  setGoal($username, $value, $connect);
}

if(isset($_POST['startDate'])){
  $value = $_POST['startDate'];
  setStartDate($username, $value, $connect);
}

if(isset($_POST['endDate'])){
  $value =  $_POST['endDate'];
  setEndDate($username, $value, $connect);
}

if(isset($_POST['paymentDate'])){
  $value =  $_POST['paymentDate'];
  echo $value;
  setPurchaseDate($username, $value, $connect);
}

if(isset($_POST['biWeekSalary'])){
  $value =  $_POST['biWeekSalary'];
  setSalary($username, $value, $connect);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- 	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script> -->
  <script data-main="lib/capital_one" src="lib/require-jquery.js"></script>

  <link rel="stylesheet" type = "text/css" href="SaveStaks.css">
</head>
<body>
  <p> Welcome, <span id='nickname'><?php echo $_SESSION['username'];?></span></p>
  <div id="accountData">
    <h4 id="firstNameLastName"></h4>
    <h4 id="username"></h4>
    <h4 id="balance"></h4>
    <h4 id="biWeeklySalary"></h4>
    <h4 id="dailySalaryAverage"></h4>
  </div>

  <div id="centerPage">
    <h1 id="webTitle">S A V E     S T A K S</h1>
    <h4 id= "currentSavings">CURRENT SAVINGS</h4>
    <p>
      <?php
     if(hasStartDate($username, $connect)){
      $sdate = date("n/j/Y", strtotime(getStartDate($username, $connect)));
        echo " <br> Start Date: {$sdate}"; 
     }

     if(hasPurchaseDate($username, $connect)){
      $sdate = date("n/j/Y", strtotime(getPurchaseDate($username, $connect)));
        echo " <br> Last Purchase Date: {$sdate}"; 
     }

     if(hasEndDate($username, $connect)){
      $sdate = date("n/j/Y", strtotime(getEndDate($username, $connect)));
        echo " <br> End Date: {$sdate}"; 
     }

       

      ?>
      
    </p>
    <h4 id= "currentSavingsNumber"></h4>
    <div id="goalData">
      <h4 id="savingsGoal"></h4>
      <h4 id="dailySavingsGoal"></h4>
      <h4 id="currentDailySavingsAvg"></h4>
      <h4 id="dailySpendingLimit"></h4>
      <h4 id="currentDailySpendingAvg"></h4>
    </div>
  </div>

  <form id="createGoalForm" action="home.php" method="post">
    <?php
    $printCreateGoal = false;
    if(!hasGoal($username, $connect)){
     $printCreateGoal = true;
     $printGoal = "<h3>Create Goal</h3>";
     $printGoal .= "<label for='goal'>Goal Amount to Save: </label>";
     $printGoal .= "<input name='goal' id='goal' type='text' placeholder='$' /><br>";
     $goal = 0;
     $printGoal .= "<span id='{$goal}' class='getGoal'></span>";
   }
   else{
    $goal = getGoal($username, $connect);
     $printGoal = "<span id='{$goal}' class='getGoal'></span>";
       // $printGoal .= getGoal($username, $connect). "<br>";;
   }
   echo $printGoal;



    //get start date
   if(!hasStartDate($username, $connect)){
    $printCreateGoal = true;
    $printStartDate = "<label for='startDate'>Start Date: </label>";
    $printStartDate .= "<input name='startDate' id='startDate' type='text' placeholder='yyyy-mm-dd' /><br>";
    $start = "";
    $printStartDate .= "<span id='{$start}' class='getStartDate'></span>";
    
  }
  else{
    $start = getStartDate($username, $connect);
      $printStartDate = "<span id='{$start}' class='getStartDate'></span>";
      //$printStartDate .= getStartDate($username, $connect). "<br>";
  }
  echo $printStartDate;

    //get end date
  if(!hasEndDate($username, $connect)){
    $printCreateGoal = true;
    $printEndDate = "<label for='endDate'>End Date: </label>";
    $printEndDate .= "<input name='endDate' id='endDate' type='text' placeholder='yyyy-mm-dd' /><br>";
    $end = "";
    $printEndDate .= "<span id='{$end}' class='getEndDate'></span>";

    //$printEndDate .= "<span id='{$end}' class='getEndDate'></span>";


  }
  else{
    $end = getEndDate($username, $connect);
    $printEndDate = "<span id='{$end}' class='getEndDate'></span>";
    //$printEndDate .= getEndDate($username, $connect)."<br>";;
  }
  echo $printEndDate;

    //get salary
  if(!hasSalary($username, $connect)){
    $printCreateGoal = true;
    $printSalary = "<label for='biWeekSalary'>Bi-Weekly Salary: </label>";
    $printSalary .= "<input name='biWeekSalary' id='biWeekSalary' type='text' placeholder='$' /><br>";
    $s = 0;
     $printSalary .= "<span id='{$s}' class='getSalary'></span>";

  }
  else{
    $s = getSalary($username, $connect);
     $printSalary = "<span id='{$s}' class='getSalary'></span>";
  }
  echo $printSalary;

  if($printCreateGoal){
    echo "<button id='createGoalButton'>Create Goal</button>";

  }

  ?>
</form>

<form id="paymentForm">
  <h3>Make Purchase</h3>
  <label for="price">Cost of Item: </label>
  <input name="price" id="price" type="text" placeholder="$" /><br>

  <label for="paymentDate">Date of Purchase:</label>
  <input id="paymentDate" name="paymentDate" type="text" placeholder="yyyy-mm-dd" /><br>

  <label for="merchant">Merchant</label>
  <select id="merchants" name="merchants">
    <option>Terra Rosa</option>
    <option>Walmart</option>
    <option>Sam's Club</option>
    <option>Aurora Inn</option>
    <option>Ithaca Bakery</option>
  </select><br>

  <button id="purchaseButton">Make Purchase</button>
</form>

<script type="text/javascript">
 var apiKey = '00e5eaabe90e2e82f3379860987ed3d3';
 var user = document.getElementById('nickname').textContent;
 var user_id = null
 var interval;

  var balance = 0;
    var merchantId = "5ab6a8eef0cec56abfa403d7";
    var purchaseAmount = 0;
    var purchaseDate = "";

    var salary = parseFloat(document.getElementsByClassName("getSalary")[0].id); //document.getElementById("salary").value - php
    var dailySalary = salary/14;
    var savingsGoal = parseFloat(document.getElementsByClassName("getGoal")[0].id);
    var currentSavings = 0;
    var currentDailySavings = 0;

    var startDate = document.getElementsByClassName("getStartDate")[0].id
    var currentDate = purchaseDate;
    var goalDate = document.getElementsByClassName("getEndDate")[0].id


 Date.daysBetween = function( date1, date2 ) {   //Get 1 day in milliseconds   
      dateOne = new Date(date1);
      dateTwo = new Date(date2);
      var one_day=1000*60*60*24;    // Convert both dates to milliseconds
      var date1_ms = dateOne.getTime();   
      var date2_ms = dateTwo.getTime();    // Calculate the difference in milliseconds  
      var difference_ms = date2_ms - date1_ms;        // Convert back to days and return   
      return Math.round(difference_ms/one_day);
    }

    var totalDays = Date.daysBetween(startDate, goalDate);
    var dailySavingsGoal = savingsGoal/totalDays;
      if(startDate == "" || goalDate == ""){
      dailySavingsGoal = 0;
    }
    var dailyPurchases = [];
    var totalPurchaseAmount = 0;

  $(function(){

      require(['purchase'], function (purchase) {

        var pur = purchase.initWithKey(apiKey);
        getPurchase(apiKey, pur);
        getTotalSavings();
        printData();
      
      });
    

    })

  $("#purchaseButton").click(function() {
    
    purchaseAmount = $("#price").val();
    purchaseDate = $("#paymentDate").val();
    

      require(['purchase'], function (purchase) {

        var pur = purchase.initWithKey(apiKey);

        if (purchaseDate != null)
        {

           postPurchase(apiKey, pur);
        }
      });

      return true;
    })


 $(function(){

 //GET THE 
var url = "http://api.reimaginebanking.com/accounts?type=Checking&key=00e5eaabe90e2e82f3379860987ed3d3"; //get all account
var xhr;
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
   console.log(arr);
   var length = Object.keys(arr).length;
   for(var i = 0; i < length; i++){
    var nickname = arr[i]['nickname'];
    users.push(nickname);
    if(user == nickname){
     user_id = arr[i]['_id'];
  		 		var account_url = "http://api.reimaginebanking.com/accounts/" + arr[i]['_id'] + "?key=00e5eaabe90e2e82f3379860987ed3d3"; //the account to login to
  		 		//make _id global
  		 		//window.location = account_url;
  		 	}

  		 }
     }

   }
   xhr.send();
   interval = setInterval(getResult, 100);
   function getResult(){
    if(user_id != null){
      interval = clearInterval(interval);
      console.log(user_id);
      var url = "http://api.reimaginebanking.com/accounts/" + user_id + "?key=00e5eaabe90e2e82f3379860987ed3d3";
      console.log(user_id);
      var curl = "http://api.reimaginebanking.com/accounts/" + user_id + "/customer?key=00e5eaabe90e2e82f3379860987ed3d3";
      var xhr;
      if(window.XMLHttpRequest)
      {
        xhr = new XMLHttpRequest();

      }
      else
      {
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
        var data = ['nickname', 'type', 'accountnumber', 'rewards', 'balance']
        for(var i = 0; i < length; i++){
         if(data.indexOf(Object.keys(arr)[i]) != -1){
        // console.log(Object.keys(arr)[i] + " " + arr[Object.keys(arr)[i]]); //gets the keys
         //document.getElementById(Object.keys(arr)[i]).textContent += " " + arr[Object.keys(arr)[i]];

         if(Object.keys(arr)[i] == "nickname"){
          var username = arr[Object.keys(arr)[i]];
          document.getElementById("username").innerHTML = "Username: " + username;
        }
        if(Object.keys(arr)[i] == "balance"){
          var balance = arr[Object.keys(arr)[i]];
          document.getElementById("balance").innerHTML = "Balance: $" + balance.toFixed(2);

        }

        

      }

    }
     //get first and last name of user



   }
 }
 xhr.send();


    function getPurchase(key, pur) {
      var allPurchases = pur.getAll(user_id);
      for (x = 0; x < allPurchases.length; x++)
      {
        var purchaseAmount1 = allPurchases[x].amount;
        var purchaseDate1 = allPurchases[x].purchase_date;
        var dateDiff = Date.daysBetween(startDate, purchaseDate1);
        if (dateDiff <= totalDays && dateDiff >= 0)
        {
          if (dailyPurchases[dateDiff] != null)
          {
            dailyPurchases[dateDiff] = dailyPurchases[dateDiff] + purchaseAmount1;
            totalPurchaseAmount+= purchaseAmount1;
          }
          else
          {
           dailyPurchases[dateDiff] = purchaseAmount1;
           totalPurchaseAmount+= purchaseAmount1;
         }
       }
     }
     console.log(dailyPurchases);
   }

   function getTotalSavings() {
    var currentDays = dailyPurchases.length;
    var currentIncome = dailySalary*currentDays;
    currentSavings = currentIncome - totalPurchaseAmount;
    currentDailySavings = currentSavings/currentDays;

    console.log(currentDailySavings);
    console.log(dailySavingsGoal);
  }


//get first and last name
var xhr2;

if(window.XMLHttpRequest){
  xhr2 = new XMLHttpRequest();

}
else{
  xhr2 = new ActiveXObject("Microsoft.XMLHTTP");
}
xhr2.open('GET', curl, true);
xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr2.onreadystatechange = function()
{
 if(xhr2.status == 200 && xhr2.readyState == 4){
  var arr = xhr2.responseText;
  arr = JSON.parse(arr);
  var length = Object.keys(arr).length;
  var fullName = arr['first_name'] + " "+ arr['last_name'];

  document.getElementById("firstNameLastName").innerHTML = fullName;

}
}
xhr2.send();


}
    } //getResult() ends

  });

    function postPurchase(key, pur) {
   
      var newPurchaseDetails = "{\"merchant_id\": \"" + merchantId + "\", \"medium\": \"balance\", \"purchase_date\": \"" + purchaseDate + "\", \"amount\":" + purchaseAmount + ", \"status\": \"pending\", \"description\": \"food\" }";
      
      var responseCode = pur.createPurchase(user_id, newPurchaseDetails);
  

      console.log("[Purchase - Create Purchase] Response Code: " + responseCode);
      $('#postPurchase').html("Create Purchase: Response Code <b>" + responseCode + "</b>");
    }

    function getPurchase(key, pur) {
      var allPurchases = pur.getAll(user_id);
      for (x = 0; x < allPurchases.length; x++)
      {
        var purchaseAmount1 = allPurchases[x].amount;
        var purchaseDate1 = allPurchases[x].purchase_date;
        var dateDiff = Date.daysBetween(startDate, purchaseDate1);
        if (dateDiff <= totalDays && dateDiff >= 0)
        {
          if (dailyPurchases[dateDiff] != null)
          {
            dailyPurchases[dateDiff] = dailyPurchases[dateDiff] + purchaseAmount1;
            totalPurchaseAmount+= purchaseAmount1;
          }
          else
          {
           dailyPurchases[dateDiff] = purchaseAmount1;
           totalPurchaseAmount+= purchaseAmount1;
         }
       }
     }
     console.log(dailyPurchases);
   }
   function getTotalSavings() {
    var currentDays = dailyPurchases.length;
    var currentIncome = dailySalary*currentDays;
    currentSavings = currentIncome - totalPurchaseAmount;
    currentDailySavings = currentSavings/currentDays;
    if(currentDays == 0){
        currentDailySavings = 0;
    }
    //var endDate = "";
    if(startDate == "" || goalDate == ""){
         currentDailySavings = 0;
    }
    console.log(currentDailySavings);
    console.log(dailySavingsGoal);
  }
   function printData() {
    if (currentSavings > savingsGoal)
    {
      document.getElementById("currentSavings").style.fontSize = "20px";
      document.getElementById("currentSavings").style.color = "#4169E1"
      document.getElementById("currentSavings").innerHTML = "GOAL MET!";
      document.getElementById("currentSavingsNumber").innerHTML = "$" + currentSavings.toFixed(2);
      document.getElementById("currentSavingsNumber").style.border = "4px solid #4169E1";
    }
    else if (currentDailySavings >= dailySavingsGoal)
    {
      document.getElementById("currentSavingsNumber").style.border = "4px solid green";
      document.getElementById("currentSavingsNumber").innerHTML = "$" + currentSavings.toFixed(2);
    }
    else if (currentDailySavings >= dailySavingsGoal/2)
    {
      document.getElementById("currentSavingsNumber").style.border = "4px solid yellow";
      document.getElementById("currentSavingsNumber").innerHTML = "$" + currentSavings.toFixed(2);
    }
    else
    {
      document.getElementById("currentSavingsNumber").style.border = "4px solid red";
      document.getElementById("currentSavingsNumber").innerHTML = "$" + currentSavings.toFixed(2);
    }
    document.getElementById("savingsGoal").innerHTML = "Savings Goal: $" + savingsGoal.toFixed(2);
    document.getElementById("dailySavingsGoal").innerHTML = "Daily Savings Goal: $" + dailySavingsGoal.toFixed(2);
    document.getElementById("currentDailySavingsAvg").innerHTML = "Current Daily Savings Average: $" + currentDailySavings.toFixed(2);
    document.getElementById("dailySpendingLimit").innerHTML = "Daily Spending Limit: $" + (dailySalary - dailySavingsGoal).toFixed(2);
    document.getElementById("currentDailySpendingAvg").innerHTML = "Current Daily Spending Average: $" + (dailySalary - currentDailySavings).toFixed(2);

    document.getElementById("balance").innerHTML = "Balance: $" + balance.toFixed(2);
    document.getElementById("biWeeklySalary").innerHTML = "Bi-Weekly Salary: $" + salary.toFixed(2);
    document.getElementById("dailySalaryAverage").innerHTML = "Daily Salary Average: $" + dailySalary.toFixed(2);

  }



</script>
</body>
</html>