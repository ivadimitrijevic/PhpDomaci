<?php

require 'dbBroker.php';
require 'model/planina.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$rezultat = Planina::getAll($conn);
if (!$rezultat) {
    echo 'Nastala je greska prilikom preuzimanja podataka!';
    die();
}
if ($rezultat->num_rows == 0) {
    echo 'Nema planina!';
    die();
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <link rel="shortcut icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <title>Planine</title>

    </head>

    <body>


        <div class="jumbotron" style="color: black;">
            <h1>Skijalista Srbije</h1>
        </div>
        <div class="panel-body">
            <table id="myTable" class="table table-hover table-striped" style="color: lavander; background-color: rgb(128, 112, 185);">
                <thead class="thead">
                    <tr>
                        <th scope="col">Naziv</th>
                        <th scope="col">Broj staza</th>
                        <th scope="col">Pocetak sezone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($red = $rezultat->fetch_array()) { ?>
                        <tr>
                            <td><?php echo  $red['naziv']; ?></td>
                            <td><?php echo $red['broj_staza']; ?></td>
                            <td><?php echo $red['pocetak_sezone']; ?></td>
                        </tr>
                <?php }
                }
                ?>
                </tbody>
            </table>
            <div>
                <p><a href="Instruktori.php">Pogledaj instruktore</a></p>
            </div>

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>



    </body>

    </html>