<?php


//connect to database
$user = 'root';
$pass = '';
$db = 'my_db';

//$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

if(isset($_POST["submit"])){
	$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");
	mysqli_select_db($db,"my_db");
	$count=0;
	$res=mysqli_query($db,"select * from registration where username ='$_POST[username]'");
	$count=mysqli_num_rows($res);
	if($count>0){
      ?>
      <script type=" text/javascript">
      	alert("this username already exist please choose another");
      </script>
       <?php
	}

	else{
       mysqli_query($db,"insert into registration values('','$_POST[username]','$_POST[email]','$_POST[password]')");
	?>
      <script type=" text/javascript">
      	alert("record inserted successfully");
      </script>
       <?php
	}
	
}






?>




<!DOCTYPE html>
<html>
<head> 

	   <title>Register</title>
	   <link rel='stylesheet' type="text/css" href="css/registration_style.css"
</head>

<body>
 <div class="header">
 <h1>Register an account</h1>
 </div>

 <form method="post" action="">
  <table>
   <tr>
      <td>Username:</td>
      <td><input type="text" name="username" title= "please enter proper username that only includes letters and numbers" required pattern="^[A-Za-z0-9]+" class="textInput"></td>
   </tr>
   
    <tr>
      <td>Email:</td>
      <td><input type="email" name="email" class="textInput"></td>
   </tr>
 
    <tr>
      <td>Password:</td>
      <td><input type="password" name="password" title= "please enter proper username that only includes letters and numbers" required pattern="^[A-Za-z0-9]+" class="textInput"></td>
   </tr>

    <tr>
      <td>Password again:</td>
      <td><input type="password" name="password2" class="textInput"></td>
   </tr>

   <tr>
      <td></td>
      <td><input type="submit" name="submit" value="Register"></td>
   </tr>


   </table>


 </form>
</body>
	   

</html>