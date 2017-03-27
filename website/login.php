<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <form name="form1" action="" method="post">
  <table>

  <tr>
  <td>Enter Username</td>
  <td><input type="text" name="username1" required pattern="^[A-Za-z0_-9]+"></td>
  </tr>

  <tr>
  <td>Enter Password</td>
  <td><input type="password" name="password1" required pattern="^[A-Za-z0_-9]+"></td>
  </tr>
<td colspan="2" align="center"><input type="submit" name="submit1" value="login"></td>
  </table>
</form>

<?php
$user = 'id1198406_root';
$pass = '';
$db = 'id1198406_my_db';
if(isset ($_POST["submit1"])){
  $db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");
  mysqli_select_db($db,"my_db");
  $count=0;
  $res=mysqli_query($db,"select * from registration where username ='$_POST[username1]' && password='$_POST[password1]'");
  $count=mysqli_num_rows($res); 
  if($count>0){
    ?>
      <script type="text/javascript">
        
      window.location="homepage.html";
      </script>
    <?php
   
  }
  else{
    ?>
      <script type="text/javascript">
        alert("incorrect username or password");
      </script>
    <?php
  }
}

?>

</body>
</html>


