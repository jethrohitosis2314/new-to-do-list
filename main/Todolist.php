<!DOCTYPE html>
<html>
<head>
  <title>PRIMEnote | The best way to take notes.</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/todolist.css">
</head>
<body>
<?php
session_start();
if(!$_SESSION['login']){
    header("location:../index.php");
    die;
 }else{
//    echo $_SESSION['username'];
//    echo $_SESSION['id'];
$user=$_SESSION['id'];

?>
<div class="container">
<div class="logo"><img src="../img/logo.png" class="loginicon" width="90px"><h5> | PRIMEnote</h5>
<form action='#' method='post'> 
<input type='submit' name='logout' class="logoutbtn" value='Logout &#11177;'>
</form>
</div>
<h4 class="userlabel"><img src="../img/userlabelicon.png" width="20px" height="20px"> | Welcome User</h4>
<div class="container1">
<div class="todolistlabel"><img src="../img/todolisticon.png" width="40px" height="40px"> TO DO LIST</div>
<!-- Trigger the modal with a button -->
<button type="button" class="newtaskbtn" id="myBtn">&#43; Add New Task</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><img src="../img/taskicon.png" width="40px" height="40px"> Add New Task</h4>
      </div>
      <div class="modal-body">
      <form action="#" method="post">
      Task Name<br>&#128221; | <input type='text' name='TN' required><br><br>
      Task Description<br>&#128195; | <textarea name='Descrip' required></textarea><br><br>
      Start Date<br>&#128197; | <input type='date' name='SD' required><br>
      Due Date<br>&#128197; | <input type='date' name='DD' required>
      </div>
      <div class="modal-footer">
      <input type='Submit' name='Submit' value='Submit' class="btn btn-default">
      </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="Edit" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><img src="../img/taskicon.png" width="40px" height="40px"> Edit Task</h4>
      </div>
      <div class="modal-body">
      <form action="#" method="post">
      <input type='text' name='eID' id='id' required hidden><br>
      Task Name<br>&#128221; | <input type='text' name='eTN' id='tn' required><br><br>
      Task Description<br>&#128195; | <textarea name='eDescrip' id='td' required></textarea><br><br>
      Start Date<br>&#128197; | <input type='date' name='eSD' id='sd' required><br>
      Due Date<br>&#128197; | <input type='date' name='eDD' id='dd' required>
      </div>
      <div class="modal-footer">
      <input type='Submit' name='Edit' value='Submit' class="btn btn-default">
      </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>



  <?php 
include '../connectDB.php';
if (isset($_POST["Submit"])) {
    $tn=$_POST["TN"];
    $descrip=$_POST["Descrip"];
    $sd=$_POST["SD"];
    $dd=$_POST["DD"];
    mysqli_query($con,"INSERT INTO `task`(`Task_Name`, `Task_description`, `Start_Date`, `Due_date`,`User`) VALUES ('$tn','$descrip','$sd','$dd','$user')");
}
if (isset($_POST["Edit"])) {
    $id=$_POST["eID"];
    $tn=$_POST["eTN"];
    $descrip=$_POST["eDescrip"];
    $sd=$_POST["eSD"];
    $dd=$_POST["eDD"];
    mysqli_query($con,"UPDATE `task` SET `Task_Name`='$tn',`Task_description`='$descrip',`Start_Date`='$sd',`Due_date`='$dd' WHERE `ID`='$id'");
}

if (isset($_POST["logout"])) {
  unset($_SESSION['id']);
  unset($_SESSION['login']);
  session_destroy();
  header("Location:../index.php");
  exit;
}
  ?>

</div>
<div  id='mytable'>
<table id="todolisttable">
  <tr>
    <th scope="col">Task No.</th>
    <th scope="col">Task Name</th>
    <th scope="col">Description</th> 
    <th scope="col">Start Date</th>
    <th scope="col">Due Date</th>
    <th scope="col">Actions</th>
  </tr>
<?php
$result = $con->query('select * from task where user='.$user.'');
while($row = $result->fetch_array())
{
echo '<tr>';
echo '<td>'.$row['ID'].'</td>';
echo '<td>'.$row['Task_Name'].'</td>';
echo '<td>'.$row['Task_description'].'</td>';
echo '<td>'.$row['Start_Date'].'</td>';
echo '<td>'.$row['Due_date'].'</td>';
echo '<td><input type="button" name="Update" class="edit-btn" value="&#9998;" data-id='.$row["ID"].'> | <input type="button" name="Delete"  class="delete-btn" value="&#10006;" data-id='.$row["ID"].'></td>';
echo '</tr>';

}
?>
</table>
</div>
</div>
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
    $("input[name='Update']").click(function(){
        $("#Edit").modal();
        var id=$(this).data('id');

        var $row=$(this).closest("tr"),
        $tds=$row.find("td:nth-child(1)");
        
        var $row1=$(this).closest("tr"),
        $tds1=$row1.find("td:nth-child(2)");

        var $row2=$(this).closest("tr"),
        $tds2=$row2.find("td:nth-child(3)");

        var $row3=$(this).closest("tr"),
        $tds3=$row3.find("td:nth-child(4)");

        var $row4=$(this).closest("tr"),
        $tds4=$row4.find("td:nth-child(5)");

        $('#id').val($tds.text());
        $('#tn').val($tds1.text());
        $('#td').val($tds2.text());
        $('#sd').val($tds3.text());
        $('#dd').val($tds4.text());
        

    });
    $("input[name='Delete']").click(function(){
        var id=$(this).data('id');
        $.ajax({
            type:'GET',
            url:'delete.php',
            data:'id='+id,
            success:function(){
            }
        });
        window.location.href = 'todolist.php';
    });
});
</script>
<?php
}
?>
</body>
</html>