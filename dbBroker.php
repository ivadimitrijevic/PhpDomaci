<?php
$host = 'localhost';
$database = 'iteh';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_errno) {
    exit(
        "Neuspesna konekcija: $conn->connect_error err kod $con->connect_errno"
    );
}
