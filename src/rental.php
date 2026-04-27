<?php
session_start();


?>
<html>
 <head>
   <title>Rental</title>
<style>
.styles{
     
     display: flex;
     flex-direction: column;
    align-items: center;

   }
div h3 {
color:purple;
text-transform:uppercase;
}

.error {color: #FF0000;}

  </style>
 <link rel="stylesheet" href="mystyle.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 </head>
 <body>
        <?php 
         $activemenu = "rental"; 
         include('me.php');
        ?>
  <div style="margin-left:0%;padding:40px 0px;height:1000px;">
<?php  
// define variables and set to empty string values

$dateFromErr = $dateToErr = $year = $CostPerDay= $MakeOrCategory ="";
$dateTo = $dateFrom = "";
$dateFromString = $dateToString = "";
if(!isset($_SESSION['Username'])){
    echo ' <a href=\'login.php\'class="alert alert-danger"> please login to be able to use this website </a>';

 }else{

   if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["txt_date_from"])) {
    $dateFromErr = "Date From is required";
  } else {
    $dateFrom = new DateTime($_POST["txt_date_from"]);
  }
  
  if (empty($_POST["txt_date_to"])) {
    $dateToErr= "Date To is required";
  } else {
    $dateTo = new DateTime($_POST["txt_date_to"]);
  }
  
  //Validate that the dates are actual dates  
  
  
    //date from cannot be greater tahn grat to
  if($dateFrom > $dateTo)
  {
    $dateFromErr = "Date From cannot be greater that Date To";
  }  
  //datefrom and date to should be greater than tody(now).
  $date_now = new DateTime();
  if($dateFrom < $date_now && $dateTo<$date_now)
  {
    $dateFromErr = "Date From cannot be greater current date";
  }
//  if no error 
  if($dateFromErr == "" && $dateToErr == ""   )
  {
    require_once "db_connect.php";
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT h1.Reg_No, h1.Make, h1.Model, h1.Year , h1.CostPerDay , h1.Location,h1.image
            FROM car h1 
            WHERE ';
            //if enter a year
    if(!(empty($_POST['txt_year'])))
    {
       $year =($_POST['txt_year']);
       
      $sql = $sql . ' h1.Year >= :ref_year AND ';
    } 

    if(!(empty($_POST['txt_CostPerDay'])))
    {
       $CostPerDay =($_POST['txt_CostPerDay']);
      
      $sql = $sql . ' h1.CostPerDay <= :ref_CostPerDay AND ';
    }

    
   if(!(empty($_POST['txt_MakeOrCategory'])))
    {
       $MakeOrCategory =($_POST['txt_MakeOrCategory']);
       echo $MakeOrCategory;
      $sql = $sql . ' h1.Make IN (:ref_MakeOrCategory) AND ';
    
    }
    

  
    $sql = $sql . ' h1.Reg_No NOT IN
              (SELECT r2.Reg_No FROM bookdetails r2 where r2.PickUpDate >= :ref_date_from AND r2.ReturnDate <= :ref_date_to
              UNION
               SELECT r3.Reg_No FROM bookdetails r3 where :ref_date_from BETWEEN r3.PickUpDate AND r3.ReturnDate
              UNION
                SELECT r4.Reg_No FROM bookdetails r4 where :ref_date_to BETWEEN r4.PickUpDate AND r4.ReturnDate )';
    $stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $dateFromString = $dateFrom->format('Y-m-d');
    $dateToString = $dateTo->format('Y-m-d');
    $stmt->bindParam(":ref_MakeOrCategory", $MakeOrCategory);
    $stmt->bindParam(":ref_CostPerDay", $CostPerDay);
    $stmt->bindParam(":ref_year", $year);
    $stmt->bindParam(":ref_date_from", $dateFromString);
    $stmt->bindParam(":ref_date_to", $dateToString);
    
    $stmt->execute();
    

    $conn==null;    
   
  }//end if($dateFromErr == "" && $dateToErr == ""   )
}//end if ($_SERVER["REQUES(T_METHOD"] == "POST")

  
?>
  
   
  
  
  

  
   
   
   <div class="container ">
     <h1 class="text-center">Find your dream car</h1>
     <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
      <div class=" styles">

        <div class="form-group col-md-4">
            <label for="txt_date_from">Date From<span class="error">*<?php echo   $dateFromErr ;?> </span></label>
            <input type="date" class="form-control" id="txt_date_from" name="txt_date_from" value="<?php echo $dateFromString;?>"  >
            
            <br>
            
        </div>
        <div class="form-group col-md-4">
            <label for="txt_date_to">Date To :<span class="error">*<?php echo   $dateToErr;?> </span></label>
            <input type="date" class="form-control" id="txt_date_to" name="txt_date_to" value="<?php echo $dateToString;?>">
            
          </div>
          <br>
   
	    <h4 class="text-center">Filters :</h4>
      <div class="form-group col-md-4">
        <label for="txt_year"> Enter the year (year the car will start):</label>
      <input type="number" class="form-control" id="txt_year"value="<?php echo $year;?>"name="txt_year">
      </div>
      <div class="form-group col-md-4">
        <label for="txt_CostPerDay"> Enter maximum number of cost per day :</label>
      <input type="number" class="form-control" id="txt_CostPerDay"name="txt_CostPerDay" value="<?php echo 
      $CostPerDay;?>">
      </div>

      <div class="form-group col-md-4">
        <label for="txt_MakeOrCategory"> Search by make or categoty name :</label>
      <input type="text" class="form-control" id="txt_MakeOrCategory" value="<?php echo $MakeOrCategory;?>"
      name="txt_MakeOrCategory">
      </div>
      <div class="form-group col-md-4 mb-3">
          <button type="submit" class=" form-control btn btn-primary" >search</button>
        </div>
      
      
    </div>
   </form>
 </div>

   
  
<?php
//If we arrived on the form after submit and there were no errors
if (($_SERVER["REQUEST_METHOD"] == "POST" ) && $dateFromErr==""  && $dateToErr=="")
{
  //Let us display the properties that are available in cards 
?>  
  
    <div class="container py-5">
      <div class="col-md-12">
      <h3 class="text-center alert alert-light"> Property Details Available between <?php echo "$dateFromString and $dateToString" ?></h3>
    </div>
      <div class="row mt-4">
     
      <?php
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        { 
          ?>
          <div class="col-md-3 mt-3">
          <div class="card">
            <img src="upload/<?php echo $row['image']; ?>" width="200px" height="200px"class="card-img-top" alt="images">
          <div class="card-body">
          
          <h4 class="card-title"><?php echo $row['Make'];?></h4>
          year :<p class="card-text"><?php  echo $row['Year']?> </p>
          location:<p class="card-text"><?php  echo $row['Location']?> </p>
          cost per day:<p class="card-text"><?php  echo  $row['CostPerDay']?> </p>
           <!--view details  in process-->
          <button  class="btn btn-primary"> view details</button>

            <br>
          <form action="book.php" method="get">
                      <input type="hidden" name="txt_date_from" value="<?php echo $dateFromString;?> " />
                      <input type="hidden" name="txt_date_to" value=" <?php echo $dateToString ;?> '" />
                      <input type="hidden" name="txt_house_id" value="<?php echo $row['Reg_No'];?>" />
                      <input type="submit" class="btn btn-dark" value="Book Now!">
          </form>
        
        </div>
      </div>
    </div>
          <?php
        }//end while
      ?> 
      </div>
      </div> 
    </tbody>
  </table>
<?php
}//end if
}
?>

  </div>

 </body>
</html>
