
<?php
session_start();

if(isset($_POST['updatebtn'])){
  // access all the values 
	$reg=$_POST['edit_regisation'];
  $make=$_POST['edit_make'];
  $model=$_POST['edit_model'];
  $year=$_POST['edit_year'];
  $milege=$_POST['edit_milege'];
  $cost=$_POST['edit_CostPerDay'];
  $late=$_POST['edit_lateperday'];
  $location=$_POST['edit_location'];
   $category=$_POST['edit_category'];
   //need to use files
    $image=$_FILES["edit_image"]['name'];
    

  
	
	

   

        require_once"db_connect.php";
         $conn-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sq="SELECT * from car  WHERE Reg_No = '$reg'";
         $rsult=$conn->query($sq);
   
      while ($row = $rsult->fetch()){
       
        if($image == NULL){//no image was inserted
                  $imagedata=$row['image']; //take the old image
        }
        else
        {   //a new image was inserted
              if($img_path="upload/".$row['image']){ // take taht specific image 
                unlink($img_path);
                $imagedata=$image;
              }
        }
      }



       $conn-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
      $sql="UPDATE car SET  Make='$make',Model='$model',Year='$year', Milege='$milege' ,CostPerDay='$cost',LateFeePerDay='$late', Location='$location', Category_Name='$category', image ='$imagedata'  WHERE Reg_No = '$reg' ";
	$result=$conn->query($sql);

	if($result)
	{ //move_uploaded_file(file, dest)
		move_uploaded_file($_FILES["edit_image"]["tmp_name"], "upload/".$_FILES["edit_image"]["name"]);
		$_SESSION['success']=" updated successfully ";
		header('location: owner.php');
	}else{
	 
		$_SESSION['status']=" NOT update ";
		header('location: output.php');
    }

 }

// for the delete part
if(isset($_POST['delete_btn']))
{
    $reg = $_POST['delete_id'];
     require_once"db_connect.php";
         $conn-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $query = "DELETE FROM car WHERE Reg_No = '$reg' ";
    $result=$conn->query($query);
    if($result)
    {
        $_SESSION['success'] = "Your Data is Deleted  successfully";
      /*  $_SESSION['status_code'] = "success";*/
        header('Location: owner.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        /*$_SESSION['status_code'] = "error";*/
        header('Location: owner.php'); 
    }    
}


?>
