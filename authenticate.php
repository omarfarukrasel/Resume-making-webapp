<?php
session_start();
require_once 'config.php';

// Initialize error array
$errors = [];
$option = '';
$option1 = '';

try {
    // Create connection using mysqli
    $db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    
    // Check connection
    if ($db->connect_error) {
        throw new Exception("Connection failed: " . $db->connect_error);
    }

    // Prepare and execute branch query
    $branchQuery = "SELECT id, name FROM branch ORDER BY name";
    $branchStmt = $db->prepare($branchQuery);
    
    if (!$branchStmt) {
        throw new Exception("Branch query preparation failed: " . $db->error);
    }
    
    if (!$branchStmt->execute()) {
        throw new Exception("Branch query execution failed: " . $branchStmt->error);
    }
    
    $branchResult = $branchStmt->get_result();
    while ($row = $branchResult->fetch_assoc()) {
        $option .= sprintf(
            '<option value="%s">%s</option>', 
            htmlspecialchars($row['name']), 
            htmlspecialchars($row['name'])
        );
    }
    $branchStmt->close();

    // Prepare and execute college query
    $collegeQuery = "SELECT id, name FROM college ORDER BY name";
    $collegeStmt = $db->prepare($collegeQuery);
    
    if (!$collegeStmt) {
        throw new Exception("College query preparation failed: " . $db->error);
    }
    
    if (!$collegeStmt->execute()) {
        throw new Exception("College query execution failed: " . $collegeStmt->error);
    }
    
    $collegeResult = $collegeStmt->get_result();
    while ($row = $collegeResult->fetch_assoc()) {
        $option1 .= sprintf(
            '<option value="%s">%s</option>', 
            htmlspecialchars($row['name']), 
            htmlspecialchars($row['name'])
        );
    }
    $collegeStmt->close();

} catch (Exception $e) {
    $errors[] = "System error: " . $e->getMessage();
    error_log($e->getMessage());
    // Set a generic error message for users
    $_SESSION['error'] = "An error occurred while processing your request. Please try again later.";
} finally {
    if (isset($db)) {
        $db->close();
    }
}
?>