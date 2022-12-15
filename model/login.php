<?php
include '../dbBroker.php';
session_start();


if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'register':
            register();
            break;
        case 'login':
            login();
            break;
        default:
            break;
    }
}

function register()
{
    global $conn;

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "Sva polja moraju biti popunjena!";
        exit;
    }

    $user = mysqli_query($conn, "SELECT * FROM korisnik WHERE korisnicko_ime='" . $username . "'");
    if (mysqli_num_rows($user) > 0) {
        echo "Korisnicko ime je vec zauzeto!";
        exit;
    }

    $query = "INSERT INTO korisnik(korisnicko_ime, sifra) VALUES('" . $username . "','" . $password . "')";
    mysqli_query($conn, $query);
    echo "Registracija uspesna!";
}

function login()
{
    global $conn;

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = mysqli_query($conn, "SELECT * FROM korisnik WHERE korisnicko_ime = '" . $username . "'");

    if (mysqli_num_rows($user) > 0) {
        $row = mysqli_fetch_assoc($user);

        if ($password == $row["sifra"]) {
            echo "Prijava uspesna!";
            $_SESSION['login'] = true;
            $_SESSION['id'] = $row['id'];
        } else {
            echo "Netacna lozinka!";
            exit;
        }
    } else {
        echo "Korisnik nije prijavljen!";
        exit;
    }
}
