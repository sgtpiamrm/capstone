<?php
// Check if the session has already started, and if not, start it (commented out in this case)
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

// Determine the protocol (http or https) based on the server's request
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https"; // Set protocol to https if the server is using SSL
else
    $link = "http"; // Otherwise, set protocol to http

// Build the full URL using the protocol, host, and current request URI
$link .= "://"; // Add the "://" separator
$link .= $_SERVER['HTTP_HOST']; // Add the host (domain name or IP)
$link .= $_SERVER['REQUEST_URI']; // Append the current request URI (the full URL)


// Check if the current URL is not login.php or registration.php and ensure the user is not logged in or is not an admin
if (!strpos($link, 'login.php') && !strpos($link, 'registration.php') && (!isset($_SESSION['userdata']) || (isset($_SESSION['userdata']['login_type']) && $_SESSION['userdata']['login_type'] != 2))) {
    // Redirect to the login page if the user is not logged in or is not an admin
    redirect('login.php');
}

// Check if the current URL is login.php and the user is already logged in as an admin
if (strpos($link, 'login.php') && isset($_SESSION['userdata']['login_type']) && $_SESSION['userdata']['login_type'] == 2) {
    // Redirect to the index page if the user is already logged in as admin
    redirect('index.php');
}
