<<html>
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
 <body >

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


   <?php
       require_once "db_connect.php";
   $activemenu = "Register"; 
   include('me.php');
    ?>
<div class="container styles">
     <div class="container-fluid">
	 <div class="card shadow mb-4">
  	 <div class="card-header py-3">
  	 <h6 class="m-0 font-weight-bold text-primary">Edit car details </h6>
     </div>
      <div class="card-body">

      <?php




      $reg="";
      
      if(isset($_POST['edit_btn'])){ 

	    $reg =$_POST['edit_reg'];
	
      require_once"db_connect.php";
         $conn-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$sql="SELECT * from car where Reg_No = '$reg'";
	 $result=$conn->query($sql);
	 
	 while ($row = $result->fetch())
	 
	 {
	 	 ?>
        
       <form action="update.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name ="edit_regisation" value="<?php echo $row['Reg_No']; ?>" >

      	<div class="class-group">
      		<label>make</label>
      		<input type="text" class="form-control" name ="edit_make" pattern="[A-Za-z]+( [a-zA-z]+)*$"
          value="<?php echo $row['Make']; ?>" >
      	</div>
      	<div class="class-group">
      		<label>model</label>
      		<input type="text" class="form-control" name ="edit_model" pattern="[A-Za-z]+( [a-zA-z]+)*$"
          value="<?php echo $row['Model']; ?>" >
      	</div>
        <div class="class-group">
            <label>Year</label>
            <input type="text" class="form-control" name ="edit_year"  pattern="[0-9]{4}$"
            value="<?php echo $row['Year']; ?>" >
        </div>
        <div class="class-group">
            <label>Milege</label>
            <input type="text" class="form-control" name ="edit_milege" pattern="[0-9]+$" value="<?php echo $row['Milege']; ?>" >
        </div>
      	<div class="class-group">
      		<label>Cost Per Day</label>
      		<input type="text" class="form-control" name ="edit_CostPerDay" pattern="[0-9]+$" value="<?php echo $row['CostPerDay']; ?>" >
      	</div>
        <div class="class-group">
            <label>Late Per Day</label>
            <input type="number" class="form-control" name ="edit_lateperday" pattern="[0-9]+$"value="<?php echo $row['LateFeePerDay']; ?>" >
        </div>
        <div class="class-group">
            <label>Location</label>
            <input type="text" class="form-control" name ="edit_location" pattern="[A-Za-z]+( [a-zA-z]+)*$"value="<?php echo $row['Location']; ?>" >
        </div>
        <div class="class-group">
            <label>category name</label>
            <input type="text" class="form-control" name ="edit_category" pattern="[A-Za-z]+$"value="<?php echo $row['Category_Name']; ?>" >
        </div>
        <div class="class-group">
            <label>image</label>
            <input type="file" class="form-control" name ="edit_image" value="<?php echo $row['image']; ?>" >
        </div>
       
      	
      		<a href="owner.php" class="btn btn-danger">CANCEL</a>
      		<button type="submit" name="updatebtn" class="btn btn-primary">UPDATE</button>
      	
      </form>
         <?php
  }
}
?>

      </div>
      </div>
  </div>
</div>
</body>

           
  
