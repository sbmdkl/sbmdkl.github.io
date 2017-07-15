<?php

include("../php/connection.php");
?>


<?php

session_start();

if(isset($_POST['login'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' and password='$password' ";
    $result = mysqli_query($connection,$query);
    $row = mysqli_num_rows($result);
    $row_detail = mysqli_fetch_assoc($result);
    if($row){
        
        $_SESSION['firstname'] = $row_detail['firstname'];
        $_SESSION['lastname'] = $row_detail['lastname'];
        $_SESSION['email'] = $row_detail['email'];
        $_SESSION['rollid'] = $row_detail['rollid'];
        $_SESSION['profile'] = $row_detail['image'];
        $_SESSION['role'] = $row_detail['role'];
        $_SESSION['subject'] = $row_detail['subject'];
         $_SESSION['username'] = $username;
        
        
        header('Location:../home.php'); 
    }
    
    else {
        echo "username or password incorrect.";
    }
    
   /* while($row = mysqli_fetch_assoc($result)){
        $uname = $row['username'];
        $upass = $row['password'];
   
    echo $uname;
if($username == $uname & $password==$upass){
    
   header('Location:../../erc/home.php'); 
    
}
    
    else {
        
        echo "wrong";
    }


    }
    */

}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discussion</title>
    <link rel="stylesheet" href="css/style.css">
   
</head>
<body>
  <div id="container">
   <div id="nav">
     <ul>
         <li><a href="../index.php">Home</a></li>
         <li><a href="#">Library</a></li>
         <li><a href="#">Discussion</a></li>
         <li style="float:right; padding:0px;"><a href="../signup/signup.php">Sign up</a></li>
          </ul>  
   </div> 
   
   
   

<!--<div class="login_form">
    
    <form  action="" method="post">
        
        <br>
        <label for="username">Username</label><br>
        <input type="text" name="username" placeholder="Enter Username" required><br><br>
        <label for="password">Password</label><br>
 <input type="password" name="password" placeholder="Enter Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
    
    
</div>
-->



<div class="form">
<h1>Log In</h1>
<form action="" method="post" >
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" required />
<input name="login" type="submit" value="Login" />
</form>
<p>Not registered yet? <a href='../signup/signup.php'>Register Here</a></p>


</div>


</div>
</body>
</html>

   
