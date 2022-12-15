<?php

require 'dbBroker.php';
require 'model/instruktor.php';

if (!isset($_GET['id'])) {
    die("Desila se greska");
} else {
    $id = $_GET['id'];
    $i = Instruktor::getById($id, $conn);
    $instruktor = $i->fetch_assoc();
?>

    <!DOCTYPE html>

    <head>
        <link rel="stylesheet" type="text/css" href="css/izmena.css">
    </head>

    <body>
        <h1>Izmena podataka korisnika</h1>
        <form action='model/update.php?id=<?php echo $id ?>' method="post">
            Ime: <input type="text" name="ime" class="form-control" value="<?= $instruktor["ime"] ?>" /><br>
            Prezime: <input type="text" name="prezime" class="form-control" value="<?= $instruktor["prezime"] ?>" /><br>
            Godine rada: <input type="text" name="godineRada" class="form-control" value="<?= $instruktor["godina_rada"] ?>" /><br>
            Planina: <select id="combo" name="combo">
                <option value="1">Kopaonik</option>
                <option value="2">Zlatibor</option>
                <option value="3">Stara planina</option>
                <option value="4">Brezovica</option>
            </select><br>
            <input type="submit" name="submit" value="Azuriraj" class="btn btn-primary btn-block" />
        </form>
    </body>

    </html>
<?php
}
?>