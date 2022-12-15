<?php
require "../dbBroker.php";
require "instruktor.php";

if (isset($_GET['id']) && isset($_POST['submit'])) {
    $id = $_GET['id'];
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $godine_rada = intval($_POST['godineRada']);
    $planina = intval($_POST['combo']);
    $query = "UPDATE instruktor SET ime='" . $ime . "', prezime='" . $prezime . "', godina_rada='" . $godine_rada . "', planina_id='" . $planina . "' WHERE id='" . $id . "'";
    if ($conn->query($query) === TRUE) {
        echo "Azuriranje je uspelo";
    } else {
        echo "Azuriranje nije uspelo";
    }
} else {
    echo "Nije pronadjen id";
}
