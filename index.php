<?php

require 'dbBroker.php';
require 'model/korisnik.php';

session_start();

if (isset($_POST['korisnicko_ime']) && isset($_POST['sifra'])) {
    $uname = $_POST['korisnicko_ime'];
    $upass = $_POST['sifra'];
    $user_id = 1;

    $korisnik = new Korisnik($user_id, $uname, $upass);
    $odg = Korisnik::logInUser($korisnik, $conn);

    $row = $odg->fetch_assoc();

    if ($odg->num_rows > 0) {
        echo `
        <script>
        console.log("Uspesno ste se ulogovali");
        </script>
        `;
        $_SESSION['user_id'] = $korisnik->id;
        header('Location: home.php');
        exit();
    } else {
        echo `
        <script>
        console.log("Niste se ulogovali");
        </script>
        `;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Skijaška sezona</title>

</head>

<body>
    <div class="login-form">
        <div class="main-div">
            <form method="POST" action="index.php">
                <div class="container">
                    <label class="korisnicko_ime">Korisnik</label>
                    <input type="text" name="korisnicko_ime" class="form-control" required>
                    <br><br><br>
                    <label for="sifra">Lozinka</label>
                    <input type="sifra" name="sifra" class="form-control" required>
                    <br><br><br>
                    <button type="submit" class="btn btn-primary" name="submit">Prijavi se</button>
                </div>

            </form>
        </div>


    </div>
</body>

</html>