<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "thechamp16");
define("DB_DATABASE", "resumewebapp");
$db = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);
 $get=mysqli_query($db,"SELECT * FROM branch");
$option = '';
 while($row = mysqli_fetch_assoc($get))
{
  $option .= '<option value = "'.$row['name'].'">'.$row['name'].'</option>';
}
$get1=mysqli_query($db,"SELECT * FROM college");
$option1 = '';
 while($row = mysqli_fetch_assoc($get1))
{
  $option1 .= '<option  value = "'.$row['name'].'">'.$row['name'].'</option>';
}
?>