<?php
// Start the session
//The session_start() function must be the very first thing in your document. Before any HTML tags.
session_start();

// define variables and set to empty string values

$usernameErr = $passwordErr = "";
$username = $userpassword =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["txt_username"])) {
    $usernameErr = "User Name is required";
  } else {
    $username = $_POST["txt_username"];
  }//end else
  if (empty($_POST["txt_password"])) {
    $passwordErr = "Password is required";
  } else {
    $userpassword = $_POST["txt_password"];
  }//end else
  
  if($usernameErr == "" && $passwordErr == "" )
  {
  	
    $hashed_password = password_hash($userpassword,PASSWORD_DEFAULT);
  	require_once "db_connect.php";
  	$sInsert = "INSERT INTO account  (Username, Password) VALUES( '$username' , '$hashed_password') ";
  	#echo $sQuery;
  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $Result = $conn->exec($sInsert) ;
   
    if($Result )
    {	
    	$Msg = "!Success";
	    echo $Msg;
    }else{
       $Msg = "ERROR: Your credentials could not be saved!";
       echo $Msg;
    	
    }
  }//end if
  
 }//end else 
  

?>
<html>
 <head>
   <title>Register</title>
   
<style>
  
  </style>
  <link rel="stylesheet" href="css/mystyle.css">
 </head>
 <body>
  <!-- Reference https://www.w3schools.com/css/css_navbar.asp-->
  
  <?php 
   $activemenu = "Register"; 
   include('menu.php');
  ?>
  <div style="margin-left:15%;padding:1px 16px;height:1000px;">
  <?php
  if(isset($_SESSION['Username']))
  { 
    echo "<h3 style=\"color:red\">You are already logged in</h3>";
    
  }//end if
  else
  {	  
  ?>
  
  <h3 style="color:red">Please register</h3>
  <p>
  <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>"  >
     <fieldset>
      <legend>Login Details:</legend>
	User Name : <br/>
	<input type="text" name="txt_username" maxlength="30" size="50"/>
	<span class="error">* <?php echo $usernameErr;?></span><br/><br/> 
	Password : <br/>
	<input type="password" name="txt_password" maxlength="30" size="50"/>
	<span class="error">* <?php echo $passwordErr;?></span><br/><br/> 
	<input type="submit"/> 
	</fieldset>
  </p>
  <?php
  }//end else
  
  ?>
  
  </div>
 </body>
</html>