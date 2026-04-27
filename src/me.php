<div class="navbar1">
  <a href="home.php" <?php 
	  //In the codes below, we escape the inner double quotes, since they are to be included in the string"
	  if ($activemenu=="ho")	
		echo "class=\"active\"";
	  ?>>Home</a>
  <!--<div class="subnav1">
    <button class="subnavbtn1">About <i class="fa fa-caret-down"></i></button>
    <div class="subnav1-content">
      <a href="#company">Company</a>
      <a href="#team">Team</a>
      <a href="#careers">Careers</a>
    </div>
  </div>
  <div class="subnav1">
    <button class="subnavbtn1">Services <i class="fa fa-caret-down"></i></button>
    <div class="subnav1-content">
      <a href="#bring">Bring</a>
      <a href="#deliver">Deliver</a>
      <a href="#package">Package</a>
      <a href="#express">Express</a>
    </div>
  </div>-->
  <a href="rental.php"<?php 
	  //In the codes below, we escape the inner double quotes, since they are to be included in the string"
	  if ($activemenu=="rent")	
		echo "class=\"active\"";
	  ?>>rent a car </a>
  <div class="subnav1">
    <button class="subnavbtn1" <?php 
    //In the codes below, we escape the inner double quotes, since they are to be included in the string"
    if ($activemenu=="owner")  
    echo "class=\"active\"";
    ?>>owner <i class="fa fa-caret-down"></i></button>
    <div class="subnav1-content">
      <a href="insertcar.php">Insert car</a>
      <a href="owner.php">Edit or Delete car</a>
      
    </div>
  </div>
  <div class="subnav1">
    <button class="subnavbtn1">login/logout <i class="fa fa-caret-down"></i></button>
    <div class="subnav1-content">
      <a href="login.php">Log in</a>
      <a href="logout.php">Log out</a>
     
    </div>
  </div>

  <a href="#contact">Contact</a>
<div class="search">
<input type="text" name="txt_search" placeholder="search">
</div>
</div>