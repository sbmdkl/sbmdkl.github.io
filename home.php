

<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location:login/login.php");
exit(); }
?>


<?php

include ("php/connection.php");

if(isset($_POST['submit'])) {
    $select = $_POST['select'];
    $data = $_POST['data'];
    $user = $_SESSION["firstname"]." ".$_SESSION["lastname"];

  if(!empty($data)){
    $query = "INSERT INTO discussion(data,category,user) VALUES ('$data','$select','$user')";
    
    $result = mysqli_query($connection,$query);
    if(!$result) {
        echo "error";
    }
    
    
  }
    else {
        echo "Field cannot be empty";
    }
    
}

    
    
    
        
?>




<?php 


include ("php/connection.php");

 if(isset($_POST['commentsubmit'])){
                  
                    $comment_user = $_SESSION['firstname']." ".$_SESSION['lastname'];
                    $post_num_id = $_POST['post_id'];
                    $comment = $_POST['comment'];
                  
                  $query_comment = "INSERT INTO comments(post_id,comment,user) VALUES ('$post_num_id','$comment','$comment_user')";
                  
                  $result_comment = mysqli_query($connection,$query_comment);
                  if(!$result_comment){
                      echo "Comment upload error";
                  }
                  
                  
                  
                  
                  
                  
              }


?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discussion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/section.css">
    
    
    <script type="text/javascript">
    
        
    
    </script>
    
</head>
<body>
  <div id="container">
   <div id="nav">
     <ul>
         <li><a href="#">Home</a></li>
         <li><a href="#">Library</a></li>
         <li><a href="#">Discussion</a></li>
         <li style="float:right; padding:0px;"><a href="logout.php">Logout</a></li>
     </ul>  
   </div> 
   
   
   
   <!--  start of selection dropdown-->
   
   <div class="section">
       
       
      
    
      <div class="dis">
         
         
         
           
      <form action="" method="post">
      <br>
      <div id="sectionbutton">
      <select name="select" id="select">
         <?php
          
          $select_category = "SELECT * FROM categories";
          $result_category = mysqli_query($connection,$select_category);
          
          while($row_category = mysqli_fetch_assoc($result_category)){
              $cat_id = $row_category['cat_id'];
              $cat_title = $row_category['cat_title'];
              
                
              echo "<option value='$cat_title'>$cat_title</option>";
              
          }
                 ?>
          
          </select>
     </div>
     
        <!--  End of selection dropdown-->
      
      
      
      <!--start of textarea-->
      
      <textarea name="data" id="textarea" placeholder="Ask a Question.."></textarea>
      
      <br>
      <div id="submitbutton">
      <button class="button" name="submit" value="Submit">Submit</button>
      </div>
      </form>
      
      
        
   <!--End of textarea-->
       <!--start of Recent Discussion -->
      
      <hr>
      <h1>Recent Discussion <hr> </h1>
      <br>
         
          
          <?php
          
          
          /* start of role of user student or teacher */
          
          if($_SESSION['role']=='student') {
              
              /* Recent Discussion for student */
          
        include ("php/connection.php");
          
          $query1 = "SELECT * FROM discussion ORDER BY id DESC";
            $result1 = mysqli_query($connection,$query1);
          
          
          while($row = mysqli_fetch_assoc($result1)) {
              
              $_SESSION['post_id'] = $row['id'];
              $category1 = $row['category'];
              $data1 = $row['data'];
              $postedby = $row['user'];
            ?>
             <div class="context">
              <div id="topic">
              
                  <p>  Posted by: <?php echo $postedby ?><div id="topicright">Topic:  <?php echo $category1; ?></div></p>
                 
              </div>
              <div id="question">
               <?php
              
               echo " <p> $data1 </p>";
              echo "</div>";
              
              // Reply section 
            
            
              
        
              echo "<div id='reply'><div id='replybutton'><button>Reply</button></div></div>";
              
              
              
              
              $post_id = $_SESSION['post_id'];
              
              $query_display_comment = "SELECT * FROM comments WHERE post_id='$post_id'";
              $result_display_comment = mysqli_query($connection,$query_display_comment);
              if(!$result_display_comment) {
                  echo "Reading comment failed";
              } 
              
              while($row_comment = mysqli_fetch_assoc($result_display_comment)){
                  
                  $row_user_display = $row_comment['user'];
                  $row_comment_display = $row_comment['comment'];
                  
                 
                  echo $row_user_display."<br>".$row_comment_display."<br>";
                  
                
                  
              }
              
              
              $post_id = $_SESSION['post_id'];
              
              
              echo "<div> <form action='' method='post'><input type='hidden' name='post_id' value='$post_id' > <textarea name='comment' placeholder='Comment here' required></textarea>
              
              <button name='commentsubmit'>Submit</button>
              
              
              
              
              </form></div>";
              
            }
              
          }
          
          
          /* start of Recent Discussion for teacher */
          
          else {
              
              
              include ("php/connection.php"); 
          $subject = $_SESSION['subject'];
          $query1 = "SELECT * FROM discussion WHERE category='$subject' ORDER BY id DESC ";
            $result1 = mysqli_query($connection,$query1);
          
          
          while($row = mysqli_fetch_assoc($result1)) {
              $category1 = $row['category'];
              $data1 = $row['data'];
              $postedby = $row['user'];
            ?>
             <div class="context">
              <div id="topic">
                  <p>Topic:  <?php echo $category1; ?> Posted by: <?php echo $postedby ?></p>
                  <br>
              </div><br>
              <div id="question">
               <?php
              
               echo " <p> $data1 </p>";
              echo "</div>";
              echo "<br>";
            }
              
              
          }
            
           /* End of Recent Discussion for teacher */
          
          
          ?>
             
              <br>
             </div>
              
          <br>
         </div>
   </div>
   
    </div>
      </div>
    </div>
   <!--End of Recent Discussion -->
   
   
   
   
   
   <div class="side-bar">
      
      
      
      
      
    <!--  start of profile board-->
      
      
      <div class="card">
      <h1>Profile</h1>
       <?php $imagename = $_SESSION['profile']; ?>
  <img src="images/<?php echo $imagename?>" alt="John" style="width:90%; height:200px;border-radius:50%;">
  <div class="container">
 
    <h1><?php echo $_SESSION['firstname'];?> <?php echo $_SESSION['lastname'];?></h1>
    <p class="title"><?php echo $_SESSION['rollid'];?></p>
    <p><?php echo $_SESSION['email'];?></p>
   <a href="#"><i class="fa fa-facebook"></i></a> 
     <a href="#"><i class="fa fa-twitter"></i></a> 
    <a href="#"><i class="fa fa-linkedin"></i></a> 
    
    <p><button>Edit Profile</button></p>
  </div>
</div>
     
      <!--  End of profile board-->
     
     
     <!--start of upload profile image form-->
     
     
     <!--
       <form action=""method="post" enctype="multipart/form-data">
         <input type="file" name="image"> 
         <input type="submit" name="upload" value="upload"> 
       </form>
     
       
         -->
          <!--End of upload profile image form--> 
       
       
       
       
        <?php
       
       
       /*start of upload profile php code */
       
       
      /*


       
       include ("php/connection.php");
       $msg="";
       if(isset($_POST['upload'])) {
    
    $target = "images/".basename($_FILES['image']['name']);
    $image = $_FILES['image']['name'];
    
       $query_image = "INSERT INTO users(image) VALUES ('$image')";
           $result_image = mysqli_query($connection,$query_image);
           if(!$result_image){
               echo "image upload failed";
           }
           if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
               $msg = "image uploaded";
           }
           else {
               echo "upload failed";
           }
       }
       
       
       ?>
            
            <?php
       $username = $_SESSION["username"];
    
       include ("php/connection.php");
       $display_image = "SELECT * FROM users WHERE usename='$username'";
       $display_result = mysqli_query($connection,$display_image);
       while($display_row = mysqli_fetch_assoc($display_result)){
           
           $display_row_image = $display_row['image'];
       
          echo "<img src='$display_row_image'"; 
       }
       
       
        */
       
        /*End of upload profile php code */
       
       ?>
        
       
        
          
   </div>
 
   
</body>
</html>