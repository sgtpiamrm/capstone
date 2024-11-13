<?php
// Defining the developer's default data (used for a developer account or initial user setup)
$dev_data = array(
    'id' => '-1',  // Unique identifier for the developer
    'firstname' => 'Developer',  // Developer's first name
    'lastname' => '',  // Developer's last name (empty in this case)
    'username' => 'dev_oretnom',  // Developer's username
    'password' => '5da283a2d990e8d8512cf967df5bc0d0',  // Developer's hashed password (for security)
    'last_login' => '',  // Last login timestamp (empty initially)
    'date_updated' => '',  // Date when the account was last updated (empty initially)
    'date_added' => ''  // Date when the account was created (empty initially)
);

// Defining constants to be used throughout the application if they are not already defined

// Define the base URL of the application (used for constructing URLs)
if (!defined('base_url'))
    define('base_url', 'http://localhost/capstone/');

// Define the base application directory (absolute path of the project root folder)
if (!defined('base_app'))
    define('base_app', str_replace('\\', '/', __DIR__) . '/');  // Convert backslashes to forward slashes for compatibility

// Define a default developer data constant if it doesn't exist (used for initial user data)
if (!defined('dev_data'))
    define('dev_data', $dev_data);

// Database connection settings (ensure they are defined for database access)

// Define the database server address (localhost in this case)
if (!defined('DB_SERVER'))
    define('DB_SERVER', "localhost");

// Define the database username (default root for local development)
if (!defined('DB_USERNAME'))
    define('DB_USERNAME', "root");

// Define the database password (empty for local development)
if (!defined('DB_PASSWORD'))
    define('DB_PASSWORD', "");

// Define the database name (name of the database to be used)
if (!defined('DB_NAME'))
    define('DB_NAME', "capstone_neuscholar");

?>