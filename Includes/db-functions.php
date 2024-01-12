<?php
require_once '../config.php';

$serverName = Config::SQL_SERVERNAME;
$database = Config::SQL_DATABASE;
$username = Config::SQL_USERNAME;
$password = Config::SQL_PASSWORD;

function db_connect() {
    global $serverName, $database, $username, $password;

    $connectionOptions = array(
        "Database" => $database,
        "Uid" => $username,
        "PWD" => $password
    );

    // Establish the database connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn) {
        // Connection established successfully
        return $conn;
    } else {
        // Connection failed
        echo "Connection could not be established.<br />";
        die(print_r(sqlsrv_errors(), true));
    }
}

?>
