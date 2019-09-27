<?php

include 'config.php';
//step 4:creeate query
$username =$_GET['username'];
$password=$_GET['password'];
echo "welcome: $username  <br>";

$query="select * from user where username='$username' and password='$password';";
//step 5:execute query
$result=  mysql_query($query,$connection)
        or die("error in query:".$query." ". mysql_error());
//step 6:disp[lay result
if(mysql_num_rows($result)==1)
{ 

echo "<br>your are valid user";

}
else
{
    echo "not valid";
   
}
//step 7 close connection
mysql_free_result($result);
mysql_close($connection);

?>
