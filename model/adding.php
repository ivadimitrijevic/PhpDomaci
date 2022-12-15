<?php
require '../dbBroker.php';

session_start();

if (isset($_POST['action'])) {
    if ($_POST['action'] == "add") {
        submitData();
    }
}

function submitData()
{
    global $conn;

    $ime = $_POST['ime'];
    echo $ime;
    $prezime = $_POST['prezime'];
    $godine_rada = $_POST['godine_rada'];
    $planina = $_POST['planina'];

    if (empty($ime) || empty($prezime) || empty($godine_rada) || empty($planina)) {
        echo "Sva polja moraju biti popunjena!";
        exit;
    }

    $query = "INSERT INTO instruktor(ime,prezime,godina_rada,planina_id) VALUES('" . $ime . "','" . $prezime . "', '" . $godine_rada . "','" . $planina . "')";
    mysqli_query($conn, $query);
    echo "Dodavanje uspesno!";
}
