<?php

// set database host
define ("DB_HOST", "localhost");
// set database user
define ("DB_USER", "root"); 
// set database password 
define ("DB_PASS",""); 
// set database name
define ("DB_NAME","ass2_php_api"); 

$db_conn = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);
if ($db_conn->connect_error) {
    die("Connection failed: " . $db_conn->connect_error);
}

?>
