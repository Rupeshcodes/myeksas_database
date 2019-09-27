<?php
require 'config.php';
session_start();// Starting Session

if(isset($_SESSION['login_pass']))
{
$uc=$_SESSION['login_pass'];

$ses_sql= mysqli_query($conn,"select password from user where password='".$uc."'" );

$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['password'];
if(!isset($login_session)){
mysqli_close($conn); // Closing Connection
session_destroy();
header('Location: index.php'); // Redirecting To Home Page
}
}
else{
    session_destroy();
header('Location: index.php'); // Redirecting To Home Page
}

	
?>
<!DOCTYPE html>
<html>
<head>
    	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<style>
input[type=submit] {

    background: red; color: white; font-size: 1em;
	height:30px;width:30px;
}

</style>
</head>
<body background='back.jpg'>

<center>
<h1>Myeksas database</h1>
<?php
include 'config.php';
$e = $_REQUEST['email'];
if($e!=1){	
	
$sql = "insert into email (email) values('".$e."')";
if($e!=''){
if (mysqli_query($conn, $sql)) {
    echo "<div class='alert alert-success' role='alert'>Entry succesfull in database</div><br><br>total emails:<br>";
} else {
    echo "<div class='alert alert-danger' role='alert'>Error creating table:" . mysqli_error($conn)."</div><br><br>";
	
}
}
}

$sql = "SELECT email FROM email";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	
echo"<textarea id='ta' placeholder='emails will appear here after conversion' id='ta'rows='10' cols='30'>";
    while($row = mysqli_fetch_assoc($result)) {
        echo $row["email"].",";
    }
echo"</textarea>";



} else {
    echo "0 results";
}


	
?><br>
<button class='btn btn-primary' onclick='document.getElementById("ta").select();document.execCommand("copy");alert("Copied the text: " + document.getElementById("ta").value);'>Copy to clipboard</button>
<button class='btn btn-primary' onclick='window.location.href="index.php"'>back</button>
<b class="logout"><a href="lo.php">Log Out?</a></b>

<br><br>
<table border='yes' style='table-layout: fixed;left-margin:2%;right-margin:2%;' class='table table-striped'>
<?php 


$sql = "SELECT * FROM email";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	
$f=1;
 while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td width=10%>".$row["id"]."</td><td style='overflow: hidden; width:50%; text-align: left; valign: top; whitespace: wrap;  word-break: break-all;'>".$row["email"]."</td><td width=10%><form method='POST' action='upload.php?email=".$f."&v=".$row["id"]."'><input type='submit' value='x' class='rounded-circle'></form></td></tr>";
    
	
	}



} else {
    echo "0 results";
}


if($_REQUEST['v']!='1'){
$sql = "DELETE FROM email WHERE id=".$_REQUEST['v'].";";

if (mysqli_query($conn, $sql)) {
    echo "<div role='alert' class='alert alert-success'>Record deleted successfully</div>";
	echo "<script>setInterval(function(){ window.location.href='upload.php?v=1&email=1' }, 2000);</script>";
} else {
    echo "<div role='alert' class='alert alert-danger'>Error deleting record: " . mysqli_error($conn)."</div>";
}
}

?>
</table>
</center>
</body>
</html>