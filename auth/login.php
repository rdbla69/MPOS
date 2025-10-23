<?php
session_start();

// Set JSON header for AJAX requests
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? 'Guest';
    $password = $_POST['password'] ?? '';
    
    // Allow any login - no authentication required
    // Set session variables
    $_SESSION['admin_name'] = !empty($username) ? ucfirst($username) : 'Admin';
    $_SESSION['admin_username'] = !empty($username) ? $username : 'admin';
    $_SESSION['admin_role'] = 'admin';
    $_SESSION['login_time'] = time();
    
    // Always return success JSON response
    echo json_encode([
        'success' => true,
        'message' => 'Login successful!',
        'redirect' => '/pos-system/app/Views/pages/dashboard.php'
    ]);
    exit();
} else {
    // Not a POST request
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
    exit();
}
?>
