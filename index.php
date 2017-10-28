<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/index.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>PRIMEnote | The best app to make notes.</title>
</head>

<body>   
<header>

 <img src="img/logo.png" width="150px" class="logoposition"><div class="logo">| PRIMEnote.</div>
 <div class="content">
  <p class="qoute">The best way to take note<br>your to do list.</p>
  <p class="qoute1">Millions of people rely on PRIMEnote to get things done.</p>
  <button type="button" class="signupbtn " data-toggle="modal" data-target="#myModal">Click here to Sign Up</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close-btn" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Sign Up to our PRIMENOTE.</h3>
          <h5 class="modal-title1">And get Instant access to our Resources!</h5>
        </div>
        <div class="modal-body">
        <form action='#' method='post'>
          <div class="modal-txt">
          <input type='text' class="signupusertxtbox" name='username' placeholder="&#9993; Username" required><br>
          <input type='text' class="signupfirsttxtbox" name='fname' placeholder="&#9432; FirstName" required><br>
          <input type='text' class="signupmiddletxtbox" name='minit' placeholder="&#9432; MiddleName" required><br>
          <input type='text' class="signuplasttxtbox" name='lname' placeholder="&#9432; LastName" required><br>
          <input type='password' class="signuppasstxtbox" name='password' placeholder="&#9919; Password" required><br>
   
        <input type='submit' class="modalsignupbtn" name='SignUp' value='Create Account &#9112;'> or |
        <input type='submit' class="modalsignupbtn1" name='SignUp' value='Sign Up with facebook'>
        </form>
        </div>
        </div>
        <div class="modal-footer">
          <p>By clicking Create Account, you agree to our Terms and that you have read our Data Policy, including our Cookie Use.</p>
        </div>
      </div> 
    </div> 
</div>
 
  <div class="content1">
  <img src="img/loginformicon.png" class="loginicon" width="40px" height="40px"><div class="logintitle1">Login form</div>
  <p class="logintitle">Login to your notes and start with your to do list.</p>
  <form action='#' method='post'>
  <div class="usertxtboxicon">&#128231;<input type="text" name="user" class="usertxtbox" placeholder="| Email"></div>
  <br>
  <div class="passtxtboxicon">&#128272;<input type="password" name="pass" class="passtxtbox" placeholder="| Password"></div>
  <br>
  <input type="submit" name='Submit' class="login-btn" value="Login">
  </form>
  </div>
 </div>
</header>

<?php
include 'connectDB.php';
if (isset($_POST["Submit"])) {
   $username=$_POST['user'];
   $password=$_POST['pass'];
  $query = "SELECT * FROM `Account` WHERE username='$username' and password='".$password."' ";
  $result = mysqli_query($con,$query);
  $rows =   mysqli_num_rows($result);
   if($rows==1){    
   session_start();
   
   $row1 = mysqli_fetch_assoc($result);
   $_SESSION['id']=$row1['Account_id'];
   $_SESSION['username'] = $username;
   $_SESSION['login'] = true;
   header("Location:main/Todolist.php");
    }else{
   echo "<div class='loginvalidation'>&#9432; Invalid Username or Password</div>";
   }
}

if (isset($_POST["SignUp"])) {
   $username=$_POST['username'];
   $password=$_POST['password'];
   $fname=$_POST['fname'];
   $lname=$_POST['lname'];
   $minit=$_POST['minit'];
mysqli_query($con,"INSERT INTO `account`(`Username`, `Password`, `Fname`, `Minit`, `Lname`) VALUES ('$username','$password','$fname','$lname','$minit')");
}
?>
</body>


</html>
