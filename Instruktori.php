<?php

require 'dbBroker.php';
require 'model/planina.php';
require 'model/instruktor.php';

session_start();
$rezultat = Instruktor::getAll($conn);

if (!$rezultat) {
    echo 'Nastala je greska prilikom preuzimanja podataka!';
    die();
}
if ($rezultat->num_rows == 0) {
    echo 'Nema instruktora!';
    die();
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta charset="UTF-8">
        <link rel="shortcut icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/instruktori.css">
        <title>Instruktori</title>

        <script>
            $(document).ready(function() {
                $("#search").on("keyup",
                    function() {
                        var value = $(this).val().toLowerCase();
                        $("#myTable tr").filter(function() {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });

                    });
            });
        </script>

        <script>
            function sortTable() {
                var table, rows, switching, i, x, y, shouldSwitch;
                table = document.getElementById("myTable");
                switching = true;

                while (switching) {
                    switching = false;
                    rows = table.rows;
                    for (i = 1; i < (rows.length - 1); i++) {
                        shouldSwitch = false;
                        x = rows[i].getElementsByTagName("td")[2];
                        y = rows[i + 1].getElementsByTagName("td")[2];
                        if (Number(x.innerHTML) < Number(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                    if (shouldSwitch) {
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                    }
                }
            }
        </script>


    </head>

    <body>
        <div class="jumbotron" style="color: black;">
            <h1>Instruktori Srbije</h1>
        </div>
        <div class="outer">
            <input id="search" type="text" style="margin-right: 200px" class="inner" placeholder="Pretrazi...">
            <button onclick="sortTable()" style="margin-right: 200px" class="inner">Sortiraj po iskustvu</button>
            <a class="btn inner" name="btn-add" id="btn-add" href="add.php">Dodaj novog instruktora</a>
        </div>
        <div class="panel-body">
            <table id="myTable" class="table table-hover table-striped" style="color: lavander; background-color: rgb(128, 112, 185);">
                <thead class="thead">
                    <tr>
                        <th scope="col">Ime</th>
                        <th scope="col">Prezime</th>
                        <th scope="col">Godina rada</th>
                        <th scope="col">Planina</th>
                        <th scope="col">Operacije</th>
                    </tr>
                </thead>
                <tbody id="myBody">
                    <form name="myForm" method="post">
                        <?php while ($red = $rezultat->fetch_array()) { ?>
                            <tr>
                                <td><?php echo  $red['ime']; ?></td>
                                <td><?php echo $red['prezime']; ?></td>
                                <td><?php echo $red['godina_rada']; ?></td>
                                <td><?php echo (Planina::getById($red['planina_id'], $conn))['naziv'] ?></td>
                                <td><a class="btn" href='modify.php?id=<?php echo $red[0] ?>' style="border-color:yellow; color:yellow">Izmeni</a>
                                    <a class="btn" href='model/delete.php?id="<?php echo $red[0] ?>"' style="border-color:red; color:red">Izbrisi</a>
                                </td>
                            </tr>
                    <?php }
                    }
                    ?>
                </tbody>
            </table>

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    </body>

    </html>