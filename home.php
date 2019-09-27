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
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style>
body{
	background-image:url('back.jpg');
	background-size:cover;
	background-repeat:no-repeat;
}

</style>
</head>
<body>
<center>
<div class="container-fluid">
 
  <h1>Myeksas database</h1><b id="logout"><a href="lo.php">Log Out?</a></b><br>
<p>Click the button to display the array values after the split.</p><br>
enter:<input type='text' id='tt'>
      <input type='button' id='b1' value='convert' class="btn btn-primary">
	  <br><br>
  <div class="container-fluid">
    <!-- Control the column width, and how they should appear on different devices -->
    <div class="row">
      <div class="col-sm">
		  	<form id='form1' method='GET' action="upload.php?">
<input type='hidden' id='ss' name='email' >
<textarea placeholder='emails will appear here after conversion' id='ta' rows='10' cols='30'></textarea>
<br>
<button class="btn btn-outline-secondary" id='copy'>Copy to clipboard</button>
&nbsp;<input type='submit' value='submit to db' class="btn btn-primary"/> 
<input type='hidden' value='1' name='v'>
</form>
	<br>

	  </div>
	  
	  
      <div class="col-sm">

	
	  <?php
	include 'config.php';
$sql = "SELECT email FROM email";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	
echo"<textarea id='ta2' placeholder='emails will appear here after conversion' id='ta'rows='10' cols='30'>";
    while($row = mysqli_fetch_assoc($result)) {
        echo $row["email"].",";
    }
echo"</textarea>";



} else {
    echo "0 results in database";
}

mysqli_close($conn);
	
?>
<br>
<button class="btn btn-success" id='copy2'>Copy to clipboard</button>
	
	  </div>
    </div>
    <br>
    

   <!-- Footer -->
        <footer class="page-footer font-small blue" style='background-color:white'>

          <!-- Copyright -->
          <div class="footer-copyright text-center py-3">© 2019 Copyright:
           made by <a href="https://rupeshcodes.online"> Rupesh bhogle</a>
          </div>
          <!-- Copyright -->

        </footer>
        <!-- Footer -->
  </div>
</div>

</center>


<script>

$('#b1').click(function(){
	var str=$('#tt').val();

	if(str!='')
	{
		var res=str.split(" ");
		$('#ss').val(res);
		$('#ta').val(res);
    }
	else{
	alert('please enter text first');
	}
	
});

$('#copy').click(function(){
	document.getElementById('ta').select();
	document.execCommand("copy");
	alert("Copied the text");


});

$('#copy2').click(function(){
	document.getElementById('ta2').select();
	document.execCommand("copy");
	alert("Copied the text");


});


$('#form1').submit(function(){
	
	if($('#ss').val()=='')
	{ alert("can't submit no emails converted");return false;}
	 else
	 {return true; }
});

</script>
<br><br>

</body>
</html>

