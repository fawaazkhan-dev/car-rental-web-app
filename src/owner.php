<?php 
session_start();
 ?>
<html>
 <head>
   <title>owner</title>
   
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

<body >
  <?php
  require_once "db_connect.php";
   $activemenu = "Register"; 
   include('me.php');
  ?>

  <div style="margin-left:0%;padding:40px 0px;height:1000px;">
  

  
  <?php 
  // need to login
  if(!isset($_SESSION['Username'])){
    echo ' <a href=\'login.php\'class="alert alert-danger"> please login to be able to use this website </a>';

 }else{
          if(isset($_SESSION['success']) && $_SESSION['success'] !=''){
            echo '<h5 class="bg-info text-white"> '. $_SESSION['success']. ' <h5>';
            unset ($_SESSION['success']);
          }
          if(isset($_SESSION['status']) && $_SESSION['status'] !=''){
            echo '<h5 class="bg-info text-white"> '. $_SESSION['status'].' <h5>';
            unset ($_SESSION['status']);
          }
            

  

 ?>
 <div class="container ">
    <div class="table-responsive">
     
      <?php
       //set the Pdo error to exception
      $user= $_SESSION['Username'];
         
         $conn-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
         $sql="SELECT * from Car where username= '$user'";
         $result=$conn->query($sql);
       ?>
      <table class="table table-bordered border-primary" id="dataTable" width="100%" cellspacing ="0">
        <thread>
          <tr>
            <th>Make</th>
            <th>Model</th>
            <th>Mileage</th>
            <th>year</th>
            <th>Cost Per Day</th>
             <th>Image</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
      </thread>
           <tbody>
            <?php
              while($row=$result->fetch(PDO::FETCH_ASSOC))
              {
                ?>
                
                  <tr>
                
                 <td><?php echo $row['Make']; ?></td>
                 <td><?php echo $row['Model'];?></td>
                 <td><?php echo $row['Milege'];?></td>
                 <td><?php echo $row['Year']; ?></td>
                 <td><?php echo $row['CostPerDay']; ?></td>
                 <td><?php echo' <img src="upload/'.$row['image'].'" width="100px;" height ="100px;>'?>"
                 	
                 </td>
                 <td>
                   <form action="outputl.php" method="Post"/>
                    <input type="hidden" name="edit_reg" value="<?php echo $row['Reg_No']; ?>" /> 
                   <button type="submit" name="edit_btn"class="btn btn-primary">EDIT</button>
                   </form>
                 </td>
                 <td>
                  <form action="update.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['Reg_No']; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
                  
                </td>
                </tr>
                <?php
              }
             ?>
           </tbody>
          </table>
    
     
   
 </div>
</div>
<?php 
}
?>
     

  
  
  </div>
 
 </body>
</html>
