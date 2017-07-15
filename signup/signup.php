<?php

include("../php/connection.php");
if(isset($_POST['signup'])) {
    
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
     $faculty = $_POST['faculty'];
    $rollid = $_POST['rollid'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    
    $target = "images/".basename($_FILES['image']['name']);
    $image = $_FILES['image']['name'];
    
    
    $query_check = "SELECT * FROM users WHERE username='$username'";
    $result_check = mysqli_query($connection,$query_check);
    
    if(mysqli_num_rows($result_check)==0){
     
        
        if($password1==$password2){
            
            if(strlen($password1)>7) {
        
     $query = "INSERT INTO users(firstname,lastname,username,email,password,faculty,rollid,image) VALUES ('$firstname','$lastname','$username','$email','$password1','$faculty','$rollid','$image')" ;
    
    $result = mysqli_query($connection,$query);
    if(!$result){
        echo " insert failed";
    }
                if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
               $msg = "image uploaded";
           }
    else {
        echo "Account Created. Please Login";
    }
                
            }
            
        else {
                echo "Password length must be greater than 8 character";
            }
                
            
            
        }
        
    else {
            echo "Password not Matched!!";
        }
        
        
        
    }
        
   else {
            echo "Username Already exists.";
        }
        
        
        
    }
     


?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discussion</title>
    <link rel="stylesheet" href="css/style.css" />
    
</head>
<body>
  <div id="container">
   <div id="nav">
     <ul>
         <li><a href="#">Home</a></li>
         <li><a href="#">Library</a></li>
         <li><a href="../login/login.php">Discussion</a></li>
         <li style="float:right; padding:0px;"><a href="../login/login.php"7>Login</a></li>
          </ul>  
   </div> 
   
   
<div class="form">
<h1>Create New Account</h1>
<form name="registration" action="" method="post" enctype="multipart/form-data">
<input type="text" name="firstname" placeholder="First Name" required />
<input type="text" name="lastname" placeholder="Last Name" required />
<input type="text" name="username" placeholder="Username" required />
<input type="email" name="email" placeholder="Email" required />
<!--<input type="text" name="faculty" placeholder="Faculty" required />-->
<select name="faculty" id="Faculty">
    
    <option value="Computer">BCT</option>
    <option value="BME">BME</option>
    <option value="BCE">BCE</option>
    <option value="BEX">BEX</option>
    <option value="BEL">BEL</option>
    <option value="B.ag">B.ag</option>
    <option value="B.arc">B.arc</option>
    
</select>
<input type="text" name="rollid" placeholder="Roll ID Eg:BCT/073/41" required />
<input type="password" name="password1" placeholder="Password" required />
<input type="password" name="password2" placeholder="Re-Enter Password" required />
<br>
<input type="file" name="image" id="file">
<input type="submit" name="signup" value="Sign Up" />
</form>
</div>
   
   
   

<!--<div class="signup_form">
    
    <form  action="" method="post">
        <h1>Create New Account</h1>
        <br>
        <label for="name">Full Name</label><br>
        <input type="text" name="name" placeholder="Enter full name" required><br>
        <label for="username">Username</label><br>
 <input type="text" name="username" placeholder="Enter Username" required><br>
       <label for="password">password</label><br>
 <input type="password" name="password" placeholder="Enter password" required><br>
        <button type="submit" name="signup">Sign up</button>
    </form>
    
    
</div>
-->







</div>
</body>
</html>






