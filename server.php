<?php
session_start();
require_once 'config.php';

// Create database connection
try {
    $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    die("Connection failed. Please try again later.");
}

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

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
    if (!in_array(strtolower($gender), ['male', 'female'])) {
        $errors[] = "Invalid gender selection";
    }
    
    // Validate email
    $email = filter_input(INPUT_POST, 'mailid', FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $errors[] = "Invalid email address";
    }
    
    // Validate mobile number
    $mobno = filter_input(INPUT_POST, 'mobno', FILTER_SANITIZE_STRING);
    if (!preg_match("/^[0-9]{11}$/", $mobno)) {
        $errors[] = "Invalid mobile number (must be 11 digits)";
    }

    // Validate education details
    $ssc_year = filter_input(INPUT_POST, 'sscdate', FILTER_SANITIZE_STRING);
    if (!preg_match("/^[0-9]{4}$/", $ssc_year)) {
        $errors[] = "Invalid SSC year format";
    }

    $hsc_year = filter_input(INPUT_POST, 'hscdate', FILTER_SANITIZE_STRING);
    if (!preg_match("/^[0-9]{4}$/", $hsc_year)) {
        $errors[] = "Invalid HSC year format";
    }

    $gradenddate = filter_input(INPUT_POST, 'gradenddate', FILTER_SANITIZE_STRING);
    if (!preg_match("/^[0-9]{4}$/", $gradenddate)) {
        $errors[] = "Invalid graduation year format";
    }

    if (empty($errors)) {
        try {
            // Begin transaction
            $conn->beginTransaction();

            // Store resume data
            $stmt = $conn->prepare("INSERT INTO resumes (
                fullname, email, mobile, gender, 
                ssc_school, ssc_board, ssc_year, ssc_percent,
                hsc_college, hsc_board, hsc_year, hsc_percent,
                bsc_university, bsc_college, bsc_end_date, bsc_cgpa,
                objective, resume_data
            ) VALUES (
                :fullname, :email, :mobile, :gender,
                :ssc_school, :ssc_board, :ssc_year, :ssc_percent,
                :hsc_college, :hsc_board, :hsc_year, :hsc_percent,
                :bsc_university, :bsc_college, :bsc_end_date, :bsc_cgpa,
                :objective, :resume_data
            )");

            // Prepare resume data as JSON
            $resume_data = [
                'certifications' => [
                    sanitize_input($_POST['certification1']),
                    sanitize_input($_POST['certification2']),
                    sanitize_input($_POST['certification3']),
                    sanitize_input($_POST['certification4']),
                    sanitize_input($_POST['certification5'])
                ],
                'projects' => [
                    'be_project' => sanitize_input($_POST['beproj']),
                    'external_projects' => [
                        sanitize_input($_POST['extproj1']),
                        sanitize_input($_POST['extproj2'])
                    ],
                    'mini_projects' => [
                        sanitize_input($_POST['miniproj1']),
                        sanitize_input($_POST['miniproj2']),
                        sanitize_input($_POST['miniproj3'])
                    ]
                ],
                'responsibilities' => [
                    sanitize_input($_POST['responsibility1']),
                    sanitize_input($_POST['responsibility2'])
                ],
                'achievements' => [
                    sanitize_input($_POST['achievement1']),
                    sanitize_input($_POST['achievement2']),
                    sanitize_input($_POST['achievement3'])
                ],
                'skills' => sanitize_input($_POST['know']),
                'additional_info' => sanitize_input($_POST['additonalinfo']),
                'hobbies' => sanitize_input($_POST['hobbies']),
                'department' => sanitize_input($_POST['department'])
            ];

            $stmt->execute([
                ':fullname' => $fullname,
                ':email' => $email,
                ':mobile' => $mobno,
                ':gender' => $gender,
                ':ssc_school' => sanitize_input($_POST['ssc_school']),
                ':ssc_board' => sanitize_input($_POST['ssc_board']),
                ':ssc_year' => $ssc_year,
                ':ssc_percent' => floatval($_POST['sscpercent']),
                ':hsc_college' => sanitize_input($_POST['hsc_college']),
                ':hsc_board' => sanitize_input($_POST['hsc_board']),
                ':hsc_year' => $hsc_year,
                ':hsc_percent' => floatval($_POST['hscpercent']),
                ':bsc_university' => sanitize_input($_POST['university']),
                ':bsc_college' => sanitize_input($_POST['university']), // You might want to add a separate college field
                ':bsc_end_date' => $gradenddate,
                ':bsc_cgpa' => floatval($_POST['gradcgpa']),
                ':objective' => sanitize_input($_POST['objective']),
                ':resume_data' => json_encode($resume_data)
            ]);

            // Commit transaction
            $conn->commit();

            // Store data in session for preview
            $_SESSION['resume_id'] = $conn->lastInsertId();
            $_SESSION['preview_data'] = $_POST;

            // Redirect to resume.php
            header("Location: resume.php");
            exit();

        } catch(PDOException $e) {
            // Rollback transaction on error
            $conn->rollBack();
            error_log("Error: " . $e->getMessage());
            $errors[] = "An error occurred while saving your resume. Please try again.";
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: index.html");
        exit();
    }
}
?>