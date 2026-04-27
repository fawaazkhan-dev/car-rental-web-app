<?php
 session_start(); ?>
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
  <link rel="stylesheet" href="mystyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

 </head>
 <body style="background-color:#D0D3D4 ;">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 


 
 <?php  
 $activemenu="ho";
include('me.php');



if(!isset($_SESSION['Username'])){
  echo "<h1>PLease login to insert a car</h1>";
}else{
// define variables and set to empty values
$display=true;
 
$regnumber=$make=$year=$model=$mileage=$cost=$late=$location=$category="";
$regnumberErr=$makeErr=$modelErr=$yearErr=$mileageErr=$costErr=$lateErr=$locationErr=$categoryErr="";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 


   if (empty($_POST["txt_registrationnumber"])) {//check if the field is empty
    $regnumberErr = "registration is required";

    } else {

      $regnumber = test_input($_POST["txt_registrationnumber"]);
      if (!preg_match("/^[a-zA-Z0-9]+$/",$regnumber)) { 
         $registrationnameErr = "Only letters and number space allowed"; 
      }//end if
    }//end else


    if (empty($_POST["txt_make"])) {//check if the field is empty
    $makeErr = "Make  is required";

    } else {

    $make = test_input($_POST["txt_make"]);
    if (!preg_match("/^[A-Za-z]+( [a-zA-z]+)*$/",$make)) { //Use a regular expression to validate the name field
       $make = "Only letters and white space allowed"; 

    }//end if
  }
    if (empty($_POST["txt_model"])) {//check if the field is empty
    $modelErr = "Make  is required";

    } else {

    $model= test_input($_POST["txt_model"]);
    if (!preg_match("/^[A-Za-z]+( [a-zA-z]+)*$/",$model)) { //Use a regular expression to validate the name field
       $modelErr = "Only letters and white space allowed"; 

    }

  }//end else
 if (empty($_POST["txt_year"])) {//check if the field is empty
    $yearErr = "year is required";

    } else {

      $year =test_input($_POST["txt_year"]);
    if (!filter_var($year, FILTER_VALIDATE_INT)) { 
       $yearErr = "year should be numeric "; 

    }//end if

    }//end else

   
    if (empty($_POST["txt_mileage"])) {//check if the field is empty
    $mileageErr = "milaege is required ";

    } else {

      $mileage =test_input($_POST["txt_mileage"]);
        if (!filter_var($year, FILTER_VALIDATE_INT)) { 
           $mileageErr = "year should be numeric "; 

        }
  }
    
    if (empty($_POST["txt_Costperyear"])) {//check if the field is empty
    $costErr = "cost per year  is required";

    } else {

      $cost =test_input($_POST["txt_Costperyear"]);
    if (!filter_var($cost, FILTER_VALIDATE_INT)) { 
       $costErr = "cost per year should be numeric "; 

    }
  }
 
  if (empty($_POST["txt_LateFeePerDay"])) {//check if the field is empty
    $lateErr = "late per year  is required";

    } else {

      $late =test_input($_POST["txt_LateFeePerDay"]);
    if (!filter_var($late, FILTER_VALIDATE_INT)) { 
       $lateErr = "late per year should be numeric "; 

    }
  }

if (empty($_POST["txt_location"])) {//check if the field is empty
    $locationErr = "late per year  is required";

    } else {

      $location =test_input($_POST["txt_location"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$location)) { 
       $locationErr = "only letter are allowed  "; 

    }
  }
  
  if (empty($_POST["txt_category"])) {//check if the field is empty
    $categoryErr = "late per year  is required";

    } else {

      $category =test_input($_POST["txt_category"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$category)) { 
       $categoryErr = "only letter are allowed  "; 

    }
  }
  // no valications for uploading an image.
   



    
  /*if no error*/
  
  if($regnumberErr=="" && $makeErr=="" && $modelErr=="" && $yearErr=="" && $mileageErr="" && $costErr="" && $lateErr=="" && $locationErr=="" && $categoryErr=="")
  {
   
    
   

    
    require_once "db_connect.php";
    

   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sInsert = " INSERT INTO car (Reg_No, Make, Model, Year, Milege, CostPerDay,LateFeePerDay, Location, Category_Name, image,Username)  
    VALUES( '$regnumber' , '$make', '$model','$year', '$mileage' , '$cost', '$late', '$location','$category', '$image', '$user') ";
    
  
    
   
    
    $Result = $conn->exec($sInsert) ;
   
    if($Result )
    { 
       //if data sucessful inserted, the input form shold not be display
      $display=false;
      //move_uploaded_file(file, dest), we are moving the inserted images in the upload folder
      move_uploaded_file($_FILES["txt_image"]["tmp_name"], "upload/".$_FILES["txt_image"]["name"]);
      $Mg = "!Success";
      echo $Mg;
    }else{
       $Mg = "ERROR: Your credentials could not be saved!";
       echo $Mg;
      
    }

   /*}*/
}
  
?>
<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }




// if display true(error) it will display the form
  if($display){ 
    
?>
 
  
  
  
  
  

<div style="margin-left:0%;padding:1px 16px;height:1000px;">
  
  
  <div class="container">
     <h1 class="text-center">Insert details of a car</h1>

     <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" enctype="multipart/form-data">
     	<div class=" styles">

        <div class="form-group col-md-6">
            <label for="registrationnumber">Registration number<span class="error">* </span></label>
            <input type="text" class="form-control" id="registrationnumber" name="txt_registrationnumber" pattern="[A-Za-z0-9]+$" required>
           
            
        </div>
        <div class="form-group col-md-6">
            <label for="make">Make</label>
            <input type="text" class="form-control" id="make" name="txt_make" pattern="[A-Za-z]+( [a-zA-z]+)*$" $required>
          
            
        </div>
        <div class="form-group col-md-6">
            <label for="model">Model</label>
            <input type="text" class="form-control" id="model" name="txt_model" pattern="[A-Za-z]+( [a-zA-z]+)*$"  >   
        </div>
      

      <div class="form-group col-md-6">
      
           <label for="year">Year</label>
          <input type="number" class="form-control" id="year" name="txt_year" pattern="[0-9]{4}$" required>
          
     </div>
     <div class="form-group col-md-6">
      
           <label for="mileage">mileage</label>
          <input type="number" class="form-control" id="mileage" name="txt_mileage" 
           pattern="[0-9]+$"  required>
          
     </div>
    
    <div class="form-group col-md-6">
            <label for="Costperyear">Cost Fee Per Day</label>
            <input type="text" class="form-control" id="Street" pattern="[0-9]+$" name="txt_Costperyear"required >
            
        </div>
        <div class="form-group col-md-6">
            <label for="LateFeePerDay">Late Fee per Day </label>
            <input type="text" class="form-control" id="LateFeePerDay" pattern="[0-9]+$" name="txt_LateFeePerDay"required >
        </div>
        <div class="form-group col-md-6">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" pattern="[A-Za-z]+( [a-zA-z]+)*$" name="txt_location"required >
        </div>
        <div class="form-group col-md-6">
            <label for="location">category</label>
            <input type="text" class="form-control" id="location" pattern="[A-Za-z]+$" name="txt_category" required>
        </div>
        <div class="form-group col-md-6">
            upload images
            <input type="file" class="form-control"  name="txt_image" aria-describedby="emailHelp" >
            
        </div>
      

           <div class="form-group col-md-4 ">
          <button type="submit" class=" form-control btn btn-primary" >submit</button>
          <br><br>

            
          <button type="reset" class=" form-control btn btn-primary" >reset</button>
          </div>
    
       </div> 
     </form>
   </div>
   <?php
 }else{
  //if successful display that
  
   echo"<h2>your input Was sucessfully <h2>";
  echo "registration Number :".$reg ;
  echo"<br>";
  echo "model  :". $model ;
  echo"<br>";
    echo "make :". $make ;
    echo"<br>";
     echo "year  :". $year ;
     echo"<br>";
      echo "mileage:". $mileage ;
      echo"<br>";
       echo "cost per day  :". $cost ;
       echo"<br>";
      echo "late per day  :". $late ;
      echo"<br>";
      echo "location  :". $location ;
      echo"<br>";
      echo "category  :". $cost ;
        

    }

  
 }
 ?>

   
 
 </div>
</body>
</html>