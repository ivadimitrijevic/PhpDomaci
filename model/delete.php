<?php
require '../dbBroker.php';
require 'instruktor.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    Instruktor::deleteById($id, $conn);
} else {
    die();
}
