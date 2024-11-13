<?php
// Start the session if it is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Determine the protocol (HTTP or HTTPS)
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https"; // If the connection is secure, set the link protocol to HTTPS
else
    $link = "http"; // Otherwise, use HTTP

$link .= "://"; // Append '://'
$link .= $_SERVER['HTTP_HOST']; // Append the host (domain) of the server (e.g., localhost or example.com)
$link .= $_SERVER['REQUEST_URI']; // Append the requested URI (the full URL path)


// Check if the session doesn't contain userdata (i.e., the user is not logged in) 
// and the current page is not login.php or register.php
if (!isset($_SESSION['userdata']) && !strpos($link, 'login.php') && !strpos($link, 'register.php')) {
    // If the user is not logged in and not on login or register pages, redirect to login page
    redirect('admin/login.php');
}

// Check if the user is logged in and trying to access login.php
if (isset($_SESSION['userdata']) && strpos($link, 'login.php')) {
    // If the user is logged in and trying to access login page, redirect to the admin home page
    redirect('admin/index.php');
}

// Define an array to map user roles to corresponding modules
$module = array('', 'admin', 'faculty', 'student');

// Check if the user is logged in and trying to access index.php or an admin page
// Ensure that the user has the correct login type to access the admin section
if (isset($_SESSION['userdata']) && (strpos($link, 'index.php') || strpos($link, 'admin/')) && $_SESSION['userdata']['login_type'] != 1) {
    // If the user is not an admin (login_type != 1), deny access and redirect to the correct page for their role
    echo "<script>alert('Access Denied!');location.replace('" . base_url . $module[$_SESSION['userdata']['login_type']] . "');</script>";
    exit; // Stop further execution
}
