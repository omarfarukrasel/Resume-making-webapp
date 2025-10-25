<?php
session_start();
require_once 'config.php';

if(isset($_POST['submit'])) {
    // Input validation
    $errors = [];
    
    // Validate full name
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
    if (empty($fullname)) {
        $errors[] = "Full name is required";
    }
    
    // Validate gender
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    if (!in_array($gender, ['male', 'female', 'other'])) {
        $errors[] = "Invalid gender selection";
    }
    
    // Validate email
    $email = filter_input(INPUT_POST, 'mailid', FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $errors[] = "Invalid email address";
    }
    
    // Validate mobile number
    $mobno = filter_input(INPUT_POST, 'mobno', FILTER_SANITIZE_STRING);
    if (!preg_match("/^[0-9]{10}$/", $mobno)) {
        $errors[] = "Invalid mobile number";
    }
    
    if (empty($errors)) {
        $_SESSION['fullname'] = $fullname;
        $_SESSION['gender'] = $gender;
        $_SESSION['email'] = $email;
        $_SESSION['mobno'] = $mobno;
        
        header("Location: resume.php");
        exit();
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: index.html");
        exit();
    }
}
?>