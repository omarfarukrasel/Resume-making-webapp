<?php
if(isset($_POST['submit'])){
    $fullname=$_POST['fullname'];
    $gender=$_POST['gender'];
    $email=$_POST['mailid'];
    $mobno=$_POST['mobno'];
    header("Location: resume.php");
}
?>