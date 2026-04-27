<?php
// Start the session
//The session_start() function must be the very first thing in your document. Before any HTML tags.
session_start();

// define variables and set to empty string values

$usernameErr = $passwordErr = "";
$username =$userpassword =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["txt_username"])) {
    $usernameErr = "User Name is required";
  } else {
    $username = $_POST["txt_username"];
  }//end else
  
  if (empty($_POST["txt_password"])) {
    $passwordErr = "Password is required";
  } else {
    $userpassword= $_POST["txt_password"];
   
  }//end else
  
  if($usernameErr == "" && $passwordErr == "" )
  {
    
  	require_once "db_connect.php";
  	$sQuery = "SELECT * FROM account WHERE Username = '$username'  ";
  	
  	#echo $sQuery;
  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $Result = $conn->query($sQuery) ;
    $userResults = $Result->fetch(PDO::FETCH_ASSOC);
    if($userResults['Username'] )//the user exists
    {	
    	$hashed_password = $userResults['Password'];
    	if(password_verify($userpassword,$hashed_password))
    	{
    		$_SESSION['Username'] = $username;
    		
       
    		header('Location: home.php');
    	}
    	else
    	{
    		$Msg = "Password ERROR: Your credentials seem to be wrong. Try again or make sure you are a registered user!";
       		echo $Msg;
    	}
    	
    }else{
       $Msg = "User name ERROR: Your credentials seem to be wrong. Try again or make sure you are a registered user!";
       echo $Msg;
    	
    }
  }//end if
  
 }//end else 
  

?>
<html>
 <head>
   <title>Login</title>
   
<style>
  .styles{
     
     display: flex;
     flex-direction: column;
    align-items: center;

   }
  </style>
  <link rel="stylesheet" href="mystyle.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 </head>
 <body>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <?php 
   $activemenu = "login"; 
   include('me.php');
  ?>
  <div style="margin-left:0%;padding:1px 16px;height:1000px;">
  <?php
  if(isset($_SESSION['Username']))
  { 
    echo "<h3 style=\"color:red\">You are already logged in</h3>";
    
  }//end if
  else
  {	  
  ?>
  
  
  
          
         
<div class="container ">
     <h2 class="text-center">Please log in</h2>
     <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
      <div class=" styles">

        <div class="form-group col-md-6">
            <label for="username">Firstname<span class="error">* </span></label>
            <input type="text" class="form-control" id="password" name="txt_username" required >
        </div>

        <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="txt_password" required  >
        </div>
        <div class="form-group col-md-6 mb-3">
          <br><br>
          <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      <div class="text-center">
    <p>Not a member? <a href="#!">Register</a></p>
    
  </div>
</div>
</form>
  </div>
  <?php
  }//end else
  
  ?>
  
  </div>
 </body>
</html>