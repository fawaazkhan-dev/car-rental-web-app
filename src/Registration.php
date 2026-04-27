
<html>
 <head>
   <title>Register</title>
   
<style>
   .styles{
   	 
   	 display: flex;
   	 flex-direction: column;
    align-items: center;

   }
   .error {color: #FF0000;}

</style>
  <link rel="stylesheet" href="css/mystyle.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

 </head>
 <body style="background-color:#D0D3D4 ;">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 


 
 <?php  

// define variables and set to empty values
 $genderErr = $licenseErr = $license= $email = $emailErr= $phone=$phoneErr="";
 $firstname =$lastname = $username= $userpassword= $cuserpassword =$gender =   "";
$firstnameErr = $lastnameErr = $usernameErr = $passwordErr= $cpasswordErr = $genderErr="";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    if (empty($_POST["txt_firstname"])) {//check if the field is empty
    $firstnameErr = "Name is required";

    } else {

    $firstname = test_input($_POST["txt_firstname"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) { 
       $firstnameErr = "Only letters and white space allowed"; 
    }//end if
    }//end else


    if (empty($_POST["txt_lastname"])) {//check if the field is empty
    $lastnameErr = "Name is required";

    } else {

    $lastname = test_input($_POST["txt_lastname"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) { //Use a regular expression to validate the name field
       $lastnameErr = "Only letters and white space allowed"; 

    }//end if

    }//end else

   if (empty($_POST["txt_license"])) {//check if the field is empty
    $licenseErr = "Name is required";

    } else {

      $license =($_POST["txt_license"]);
    if (!preg_match("/^[a-zA-Z0-9]+$/", $license)) { 
       $licenseErr = "incorrect license number format"; 

    }//end if

    }//end else

    if (empty($_POST["txt_phone"])) {
    $phoneErr = "Name is required";

    } else {

    $phone= ($_POST["txt_phone"]);
    if (!preg_match("/^[0-9]+$/",$phone)){ 
       $phoneErr = "A phone number should only contain numbers"; 
    }//end if
    }//end else*/
    if (empty($_POST["txt_email"])) {
    $emailErr = "Name is required";

    } else {

    $email= ($_POST["txt_email"]);
    if (!preg_match("/^[a-z0-9A-Z]+@[a-z0-9A-Z]+\.[a-z]{2,}$/",$email) ){ 
       $emailErr = "characters followed by an \@ sign, followed by more characters, and then a . "; 
    }//end if
    }//end else*/

    if (empty($_POST["txt_gender"])) {

    $genderErr = "Gender is required";

    } else {

    $gender = test_input($_POST["txt_gender"]);
   }

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


  if (empty($_POST["txt_cpassword"])) {
    $cpasswordErr = "Password is required";

    // Check for confirm password field
  } else if( ($_POST["txt_password"]) !=  ($_POST["txt_cpassword"])) {
    $cpasswordErr = "Passwords should match";
  }else{

    $cuserpassword = $_POST["txt_password"];

  }



    
  
  
  if($usernameErr == "" && $passwordErr == "" && $genderErr == "" && $licenseErr =="" &&
 $emailErr=="" && $phoneErr=="" && $cpasswordErr =="" && $firstnameErr =="" && $lastnameErr ==""
  && $genderErr=="")
  {
    
    $hashed_password = password_hash($userpassword,PASSWORD_DEFAULT);
    echo  "hashed pass" . $hashed_password ;
    require_once "db_connect.php";
    $sInsert = "INSERT INTO account  (Username, Password,AccountType) VALUES( '$username' , 
    '$hashed_password', 'customer') ";
    
    #echo $sQuery;
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $Result = $conn->exec($sInsert) ;
   
    if($Result )
    { 
      $Mg = "!Success";
      echo $Mg;
    }else{
       $Mg = "ERROR: Your credentials could not be saved!";
       echo $Mg;
      
    }

    $sInsrt = "INSERT INTO customer  (License_No, First_Name,Last_Name,Phone_number,Email,Sex, Username)
     VALUES( '$license' , '$firstname', '$lastname','$phone','$email','$gender' , '$username') ";
     
     $Reslt = $conn->exec($sInsrt) ;
   
    if($Reslt )
    { 
      $Msg = "!Success";
      echo $Msg;
    }else{
       $Msg = "error: Your credentials could not be saved!";
       echo $Msg;
      
    }
    
  }//end if
}
  
?>
<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }
?>
 <?php 
   $activemenu = "Register"; 
   include('menu.php');
  ?>

  
  
  
  
  

<div style="margin-left:0%;padding:1px 16px;height:1000px;">
  
  
  <div class="container ">
     <h1 class="text-center">Signup to our website</h1>
     <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
     	<div class=" styles">

        <div class="form-group col-md-6">
            <label for="firstname">Firstname<span class="error">* </span></label>
            <input type="text" class="form-control" id="firstname" name="txt_firstname" aria-describedby="emailHelp" pattern="[A-Z][a-z]+( [A-Z][a-z]+)*$" required>
            <span class="error"> <?php echo   $firstnameErr ;?></span>
            
        </div>
        <div class="form-group col-md-6">
            <label for="lastname">Lastname</label>
            <input type="text" class="form-control" id="lastname" name="txt_lastname" aria-describedby="emailHelp" pattern="[A-Z][a-z]+( [A-Z][a-z]+)*$" required>
            <span class="error">* <?php echo   $lastnameErr ;?></span>
            
        </div>
        <div class="form-group col-md-6">
            <label for="license">License Number</label>
            <input type="text" class="form-control" id="license" name="txt_license" aria-describedby="emailHelp" pattern="[A-Za-z0-9]+$" required>
            <span class="error">* <?php echo   $licenseErr ;?></span>

            
        </div>
       <div class="form-group col-md-6">
        
        Gender: <input type="radio" name="txt_gender" value="male" required/> Male
        <input type="radio" name="txt_gender" value="female"  /> Female
        <input type="radio" name="txt_gender" value="other"  /> Other 
        <span class="error">* <?php echo   $genderErr ;?></span>
      </div>

      <div class="form-group col-md-6">
      
           <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="txt_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
          <span class="error">* <?php echo   $emailErr ;?></span>
     </div>
     <div class="form-group col-md-6">
      
           <label for="phone">Phone Number</label>
          <input type="text" class="form-control" id="phone" name="txt_phone" required pattern="[0-9]+$" required>
          <span class="error">* <?php echo   $phoneErr ;?></span>
     </div>
    
    <div class="form-group col-md-6">
            <label for="Street">Street</label>
            <input type="text" class="form-control" id="Street" name="txt_street" aria-describedby="emailHelp" pattern="[A-Z][a-z]+( [A-Z][a-z]+)*$">
            
        </div>
        <div class="form-group col-md-6">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="txt_city" aria-describedby="emailHelp" pattern="[A-Z][a-z]+( [A-Z][a-z]+)*$">
            
        </div>
      <div class="form-group col-md-6">
            <label for="username">Enter a Username</label>
            <input type="text" class="form-control" id="username" name="txt_username" 
            pattern="[a-zA-Z]+$" required>
             <span class="error">* <?php echo $usernameErr;?></span>
        </div>
    

        <div class="form-group col-md-6">
            <label for="gender">Password</label>
            <input type="password" class="form-control" id="password" name="txt_password" required >
             <span class="error"><?php echo $passwordErr;?></span>
        </div>
        <div class="form-group col-md-6">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="txt_cpassword" required >
              <span class="error"><?php echo $cpasswordErr;?></span>
            
            <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>


        </div>

           <div class="form-check form-group col-md-6">
          <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required title="You must agree before submitting." >
          <label class="form-check-label" for="invalidCheck">
            Agree to terms and conditions
          </label>
         </div>
      
           <div class="form-group col-md-4 mb-3">
          <button type="submit" class=" form-control btn btn-primary" >SignUp</button>
          <br><br>

            
          <button type="reset" class=" form-control btn btn-primary" >reset</button>
          </div>
    
       </div> 
     </form>
   </div>

   
 
 </div>
</body>
</html>