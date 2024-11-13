<?php
// Start output buffering to capture and control output before sending to the browser
ob_start();

// Set the default timezone to Manila for the script to handle time and date functions
ini_set('date.timezone', 'Asia/Manila');
date_default_timezone_set('Asia/Manila');

// Start the session to maintain session variables across different pages
session_start();

// Include necessary files for initialization, database connection, and system settings
require_once('initialize.php');
require_once('classes/DBConnection.php');
require_once('classes/SystemSettings.php');

// Create a new DBConnection object and assign it to $db
$db = new DBConnection;

// Get the database connection using the connection method in the DBConnection class
$conn = $db->conn;

// Function to handle redirection to a specific URL
// This will output a JavaScript redirect in the HTML
function redirect($url = '')
{
    if (!empty($url))
        echo '<script>location.href="' . base_url . $url . '"</script>';
}

// Function to validate image URLs
// Checks if the image exists, and returns the image URL if it does or a default 'no image' URL if it doesn't
function validate_image($file)
{
    if (!empty($file)) {
        // Split the file URL by the '?' to handle query parameters separately
        $ex = explode('?', $file);
        $file = $ex[0];  // The file path is before the '?'
        $param = isset($ex[1]) ? '?' . $ex[1] : '';  // If there are parameters, retain them

        // Check if the file exists in the application directory
        if (is_file(base_app . $file)) {
            return base_url . $file . $param;  // Return the full URL of the file if it exists
        } else {
            // Return a default image URL if the file does not exist
            return base_url . 'dist/img/no-image-available.png';
        }
    } else {
        // Return the default image URL if the file parameter is empty
        return base_url . 'dist/img/no-image-available.png';
    }
}

// Function to detect if the user is on a mobile device
// This uses regular expressions to check the user agent string for common mobile devices
function isMobileDevice()
{
    // Array of regular expressions for detecting different mobile devices
    $aMobileUA = array(
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );

    // Loop through each device pattern and check if it matches the user agent string
    foreach ($aMobileUA as $sMobileKey => $sMobileOS) {
        if (preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])) {
            return true;  // Return true if a mobile device is detected
        }
    }

    // Return false if no mobile device is detected
    return false;
}

// End output buffering and send the output to the browser
ob_end_flush();
?>